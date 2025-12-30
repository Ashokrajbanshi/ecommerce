<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }



     public function google_callback()
        {
            try {
                $googleUser = Socialite::driver('google')->user();
            } catch (Exception $e) {
                return redirect()->route('home')->with('error', 'Google login failed.');
            }

            // 1️⃣ Find user by provider
            $user = User::where('provider', 'google')
                        ->where('provider_id', $googleUser->getId())
                        ->first();

            // 2️⃣ If not found, match by email
            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();

                // Link existing account to Google
                if ($user) {
                    $user->update([
                        'provider' => 'google',
                        'provider_id' => $googleUser->getId(),
                        'email_verified_at' => now(),
            ]);
        }
    }

    // 3️⃣ Create new user if still not found
    if (!$user) {
        $user = User::create([
            'name'              => $googleUser->getName() ?? 'User',
            'email'             => $googleUser->getEmail(),
            'provider'          => 'google',
            'provider_id'       => $googleUser->getId(),
            'password'          => null,
            'email_verified_at' => now(),
        ]);
    }

    // 4️⃣ Login user
    Auth::login($user, true);

    return redirect()->intended(route('home'));
}



public function login(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 2️⃣ Block Google users from password login
    $user = User::where('email', $request->email)->first();

    if ($user && $user->provider === 'google' && $user->password === null) {
        return back()->withErrors([
            'email' => 'This account uses Google login. Please sign in with Google.'
        ]);
    }

    // 3️⃣ Normal email/password login
    if (Auth::attempt(
        ['email' => $request->email, 'password' => $request->password],
        $request->boolean('remember')
    )) {
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    // 4️⃣ Wrong credentials
    return back()->withErrors([
        'email' => 'These credentials do not match our records.',
    ]);
}



}

