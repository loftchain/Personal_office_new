<?php

namespace App\Http\Controllers\Auth;

use App\Models\Investor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

        if (Investor::where('email', $user->email)->first()) {
            return redirect()->route('login')->with('messages', 'User with such email already exists.');
        }

        $authUser = $this->firstOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        return redirect()->route('home.index');
    }

    protected function firstOrCreateUser($user, $provider)
    {
        $authUser = Investor::where([['provider', $provider], ['provider_id', $user->id]])->firstOrCreate([
            'name' => $user->name,
            'email' => $user->email,
            'token' => str_random(15),
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);

        return $authUser;
    }
}
