<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
class GoogleController extends Controller
{
    // Method to redirect the user to Google OAuth page
    public function googlepage()
    {
        return Socialite::driver('google')->redirect(); // Redirect the user to Google OAuth page
    }

    // Method to handle the callback from Google OAuth
    public function googlecallback()
    {
        try {
            // Retrieve user data from Google OAuth callback
            $user = Socialite::driver('google')->user();

            // Check if the user already exists in the database based on Google ID
            $finduser = User::where('google_id', $user->id)->first();

            // If user exists, log them in
            if ($finduser) {
                Auth::login($finduser); // Log in the user
                return redirect()->intended("/"); // Redirect to the intended page after login
            } else {
                // If user doesn't exist, create a new user with Google data
                $newUser = User::create([
                    'name' => $user->name, // Set user's name from Google data
                    'email' => $user->email, // Set user's email from Google data
                    'google_id' => $user->id, // Set user's Google ID
                    'password' => encrypt('123456dummy'), // Set a dummy password for the user (this is just for demonstration purposes)
                ]);

                Auth::login($newUser); // Log in the new user
                return redirect()->intended("/"); // Redirect to the intended page after login
            }
        } catch (Exception $e) {
            dd($e->getMessage()); // If an exception occurs, display the error message
        }
    }
}
