<?php

namespace App\Http\Controllers\Auth;

use App\Models\Investor;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        $authUser = $this->firstOrCreateUser($user, $provider);

        if (!$authUser) {
            return redirect()->route('login')->with('messages', 'User with such email already exists.');
        }

        Auth::login($authUser, true);

        return redirect()->route('home.index');
    }

    protected function firstOrCreateUser($user, $provider)
    {
        $referred_by = Investor::where('token', Cookie::get('referral'))->first();
        $isInvestor = Investor::where([['email', $user->email], ['provider', $provider], ['provider_id', $user->id]])->first();

        try {
            $authUser = Investor::firstOrCreate(['provider' => $provider, 'provider_id' => $user->id] ,[
                'name' => $user->name,
                'email' => $user->email,
                'token' => str_random(15),
                'provider' => $provider,
                'provider_id' => $user->id,
                'referred_by'   => $referred_by->id ?? null
            ]);

            if (!$isInvestor) {
                $this->discordHook($authUser, $provider);
            }

        } catch (QueryException $e) {
            return false;
        }

        return $authUser;
    }

    protected function discordHook($user, $provider)
    {
        date_default_timezone_set('Europe/Moscow');

        $send_obg = [
            'user_id' => '**investor_id: **' . $user['id'],
            'email' => '**email: **' . $user['email'],
            'name' => '**name: **' . $user['name'],
            'type_of_entrance' => '**type of entrance: **' . $provider ,
            'ip' => '**ip: **' . $_SERVER['REMOTE_ADDR'],
            'user_agent' => '**user_agent: **' . $_SERVER['HTTP_USER_AGENT'],
            '**-----------------------------------------------------------------------------------------------------------**',
        ];

        if (env('APP_ENV') !== 'local') {
            $str = implode("\n", $send_obg);
            $client = new Client();
            try {
                $client->request('POST', 'https://discordapp.com/api/webhooks/515508451594731542/_tRHVIzca4N_6g4lHBieI-y8kEDousLefmGK-zXvwVVHUQUQHBckWwtEz0qmuFWuF4yf', [
                    'json' => [
                        'content' => $str,
                    ]
                ]);
            } catch (GuzzleException $e) {

            }
        }
    }
}
