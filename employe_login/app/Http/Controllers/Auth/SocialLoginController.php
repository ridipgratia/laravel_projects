<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\all_employe_login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;



class SocialLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $google_user = Socialite::driver('google')->user();
        if ($google_user->email) {
            $employe = DB::table('all_employe_login')->where('email', $google_user->email)->get();
            if (count($employe) == 0) {
                return redirect('/');
                // dd('Employe Email Not Registered');
            } else {
                $user = all_employe_login::where('email', $google_user->email)->first();
                Auth::login($user);
                return redirect('/home');
            }
        } else {
            return redirect('/');
            // dd("No Email Found");
        }
    }
}
