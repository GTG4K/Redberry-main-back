<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            $user->update([
                'github_token' => $googleUser->token,
                'github_refresh_token' => $googleUser->refreshToken,
            ]);
        } else {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'profile_picture' => $googleUser->getAvatar(),
                'google_id' => $googleUser->id,
                'provider_token' => $googleUser->token,
            ]);
        }

        Auth::login($user);
        return redirect()->to(env('FRONTEND_URL'));
    }
}
