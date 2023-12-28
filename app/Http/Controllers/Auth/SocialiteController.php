<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            // reidirect back and send error message
            return redirect()->route('login')->with('error', $e->getMessage());
        }
        // find or create user and send params user get from socialite and provider
        $auth_user = $this->findOrCreateUser($user, $provider);

        // login user
        auth()->login($auth_user, true);

        // redirect to dashboard
        return redirect()->route('dashboard');
    }

    public function findOrCreateUser($social_user, $provider)
    {
        // get social account
        $social_account = SocialAccount::where('provider_id', $social_user->getId())
            ->where('provider_name', $provider)
            ->first();

        // if social account exist, return user
        if ($social_account) {
            return $social_account->user;
        } else {
            // if social account not exist, create new user
            $user = User::create([
                'name' => $social_user->getName(),
                'email' => $social_user->getEmail(),
                'email_verified_at' => now(),
                // no password needed
            ]);


            // create new social account
            $user->socialAccounts()->create([
                'provider_id' => $social_user->getId(),
                'provider_name' => $provider,
            ]);
            // return user
            return $user;
        }
    }
}
