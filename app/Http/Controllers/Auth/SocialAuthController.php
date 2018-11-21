<?php

namespace App\Http\Controllers\Auth;

use App\Models\Investor;
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
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();

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

        try {
            $authUser = Investor::where([['provider', $provider], ['provider_id', $user->id]])->firstOrCreate([
                'name' => $user->name,
                'email' => $user->email,
                'token' => str_random(15),
                'provider' => $provider,
                'provider_id' => $user->id,
                'referred_by'   => $referred_by->id ?? null
            ]);
        } catch (QueryException $e) {
            return false;
        }

        return $authUser;
    }
}
