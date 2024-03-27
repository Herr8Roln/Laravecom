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
public function googlepage()
{
return Socialite::driver('google')->redirect();
}
public function googlecallback()
{
    try {
        $user = Socialite::driver('google')->user();
        $finduser = User::where('google_id', $user->id)->first();

        if ($finduser) {
            Auth::login($finduser);
            return redirect()->intended("dashboard");
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email, // Corrected the assignment operator here
                'google_id' => $user->id,
                'password' => encrypt('123456dummy'),
                //Carbon is a popular PHP library used for working with dates and times. It provides an elegant and convenient API for manipulating dates

            ]);

            Auth::login($newUser);
            return redirect()->intended("dashboard");
        }
    } catch (Exception $e) {
        dd($e->getMessage());
    }
}
}
