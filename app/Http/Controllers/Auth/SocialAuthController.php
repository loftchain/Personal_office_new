<?php

namespace App\Http\Controllers\Auth;

use App\User;
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
        $authUser = $this->firstOrCreateUser($user);
        Auth::login($authUser, true);

        return redirect()->route('home');
    }

    protected function firstOrCreateUser($user)
    {
        $authUser = User::where('email', $user->email)->firstOrCreate([
            'name' => $user->name,
            'email' => $user->email,
        ]);

        return $authUser;
    }
}
