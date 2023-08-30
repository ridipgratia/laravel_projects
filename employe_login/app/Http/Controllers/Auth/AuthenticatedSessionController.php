<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use League\MimeTypeDetection\ExtensionToMimeTypeMap;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        date_default_timezone_set('Asia/Kolkata');
        $year = date('Y');
        // $year = "2024";
        $leave_allocation = DB::table('leave_allocation')->where('e_id', Auth::user()->e_id)
            ->where('year', $year)
            ->where('leave_id', 1)
            ->get();
        if (count($leave_allocation) != 0) {
            $current_month = date('m');
            // $current_month = 12;
            $check_update = false;
            $update_leave_balance = $leave_allocation[0]->leave_balance;
            if ($current_month > $leave_allocation[0]->last_update_month) {
                for ($i = $leave_allocation[0]->last_update_month; $i < $current_month; $i++) {
                    $update_leave_balance = $update_leave_balance + 1;
                }
                $check_update = true;
            }
            if ($check_update) {
                DB::table('leave_allocation')
                    ->where('e_id', Auth::user()->e_id)
                    ->where('year', $year)
                    ->where('leave_id', 1)
                    ->update(['leave_balance' => $update_leave_balance, 'last_update_month' => $current_month]);
            }
        } else {
            $current_month_1 = (int) date('m');
            $new_year = date('Y');
            // $new_year = "2024";

            // If You Update Leave Balance Then Write This Code 


            // DB::table('leave_allocation')
            //     ->where('e_id', Auth::user()->e_id)
            //     ->where('leave_id', 1)
            //     ->update(['year' => $new_year, 'leave_allocation' => 12, 'leave_balance' => $current_month_1, 'last_update_month' => $current_month_1]);
            // DB::table('leave_allocation')
            //     ->where('e_id', Auth::user()->e_id)
            //     ->where('leave_id', 2)
            //     ->update(['year' => $new_year, 'leave_allocation' => 7, 'leave_balance' => 7]);

            // If You Insert Then Write This code 

            DB::table('leave_allocation')
                ->insert(['e_id' => Auth::user()->e_id, 'leave_id' => 1, 'year' => $new_year, 'leave_allocation' => 12, 'leave_balance' => $current_month_1, 'last_update_month' => $current_month_1]);
            DB::table('leave_allocation')
                ->insert(['e_id' => Auth::user()->e_id, 'leave_id' => 2, 'year' => $new_year, 'leave_allocation' => 7, 'leave_balance' => 7]);
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
