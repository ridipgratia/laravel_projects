<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mymethods\CheckIsNew;
use Exception;
use Illuminate\Http\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserInfoController extends Controller
{
    public function user_info_index()
    {
        $user_info = DB::table('all_employe_details as all_emp_de')
            ->where('all_emp_de.id', Auth::user()->e_id)
            ->select(
                'all_emp_de.emp_code',
                'all_emp_de.employe_name',
                'all_emp_de.phone',
                'all_emp_de.email',
                'all_emp_de.employe_profile',
                'deg.designation_name'
            )
            ->join('designations as deg', 'deg.id', '=', 'all_emp_de.designation_id')
            ->get();
        return view('user_info', ['user_info' => $user_info]);
    }
    public function user_info_change_pass(Request $request)
    {
        if ($request->ajax()) {
            $old_password = $request->user_old_pass;
            $new_password = $request->user_new_pass;
            $status = null;
            $message = null;
            if ($old_password === null || $new_password === null) {
                $status = 400;
                $message = "Fill Old And New Password";
            } else {
                $hash_password = DB::table('all_employe_login')
                    ->where('e_id', Auth::user()->e_id)
                    ->select('password')
                    ->get();
                $check_pass = false;
                if (Hash::check($old_password, $hash_password[0]->password)) {
                    $check_pass = true;
                }
                if ($check_pass) {
                    date_default_timezone_set('Asia/Kolkata');
                    $date_1 = date('Y-m-d');
                    $dt = new DateTime();
                    $time = $dt->format('H:i');
                    $message = $time;
                    $secret_str = "abcdefghijlmnopqrstuvwxyz";
                    $secret_arr = str_split($secret_str);
                    $secret_key = "";
                    for ($i = 0; $i < 20; $i++) {
                        $rand_num = rand(0, count($secret_arr) - 1);
                        $secret_key = $secret_key . $secret_arr[$rand_num];
                    }
                    $secret_key = $secret_key . "$" . (string)Auth::user()->e_id;
                    $today = date('Y-m-d');
                    $time = date('H:i');
                    $temp_password = Hash::make($new_password);
                    if (CheckIsNew::checkChangePasswordSecret()) {
                        $is_valid = CheckIsNew::checkIsValidPasswordChange();
                        if ($is_valid) {
                            $status = 200;
                            $message = "Already Sent Chgange Password Mail ";
                        } else {
                            $emp_details = DB::table('all_employe_login')->where('e_id', Auth::user()->e_id)->select('email')->get();
                            // Use This Email In Mail Service 
                            $user_data = array('secret_key' => $secret_key);
                            $check_succ = false;
                            try {
                                CheckIsNew::SendMails('emails.email_1', 'memorytemp5@gmail.com', $user_data);
                                $check_succ = true;
                            } catch (Exception $err) {
                                $check_succ = false;
                            }
                            if ($check_succ) {
                                try {
                                    DB::table('password_change')->where('e_id', Auth::user()->e_id)->update(['secret_key' => $secret_key, 'recive_date' => $today, 'recive_time' => $time, 'temp_password' => $temp_password, 'apply' => null]);
                                    $check_succ = true;
                                } catch (Exception $err) {
                                    $check_succ = false;
                                }
                                if ($check_succ) {
                                    $status = 200;
                                    $message = "Confirmation Link Sent <br> Please Check Your Mail";
                                } else {
                                    $status = 400;
                                    $message = "Please Try Again Later ";
                                }
                            } else {
                                $status = 400;
                                $message = "Please Try Again Later ";
                            }
                        }
                    } else {
                        try {
                            $emp_details = DB::table('all_employe_login')->where('e_id', Auth::user()->e_id)->select('email')->get();
                            // Use This Email In Mail Service 
                            $user_data = array('secret_key' => $secret_key);
                            $check_succ = false;
                            try {
                                CheckIsNew::SendMails('emails.email_1', 'memorytemp5@gmail.com', $user_data);
                                $check_succ = true;
                            } catch (Exception $err) {
                                $check_succ = false;
                            }
                            if ($check_succ) {
                                try {
                                    DB::table('password_change')->insert(['e_id' => Auth::user()->e_id, 'secret_key' => $secret_key, 'recive_date' => $today, 'recive_time' => $time, 'temp_password' => $temp_password]);
                                    $check_succ = true;
                                } catch (Exception $err) {
                                    $check_succ = false;
                                }
                                if ($check_succ) {
                                    $status = 200;
                                    $message = "Confirmation Link Sent <br> Please Check Your Mail";
                                } else {
                                    $status = 400;
                                    $message = "Please try Again Later ";
                                }
                            } else {
                                $status = 400;
                                $message = "Please try Again Later ";
                            }
                        } catch (Exception $err) {
                            $status = 400;
                            $message = "Please  Try Again Later ";
                        }
                    }
                } else {
                    $status = 400;
                    $message = "Old Password Not Macthed !";
                }
            }
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            return redirect('/user_info');
        }
    }
    public function user_info_change_pass_confirmation($secret_key)
    {
        $load_secret_key = $secret_key;
        $status = null;
        $message = null;
        if (CheckIsNew::checkChangePasswordSecret()) {
            if (CheckIsNew::checkIsValidPasswordChange()) {
                $get_secret_data = DB::table('password_change')->where('e_id', Auth::user()->e_id)->select('secret_key', 'temp_password')->get();
                if ($secret_key === $get_secret_data[0]->secret_key) {
                    $check_succ = false;
                    try {
                        DB::table('password_change')->where('e_id', Auth::user()->e_id)->update(['apply' => 1]);
                        $check_succ = true;
                    } catch (Exception $err) {
                        $check_succ = false;
                    }
                    if ($check_succ) {
                        try {
                            DB::table('all_employe_login')->where('e_id', Auth::user()->e_id)->update(['password' => $get_secret_data[0]->temp_password]);
                            $check_succ = true;
                        } catch (Exception $err) {
                            $check_succ = false;
                        }
                        if ($check_succ) {
                            $status = "Verified";
                            $message = "Your Request Is Verified ";
                        } else {
                            $status = "Not Verified ";
                            $message = "Please Try Again Later";
                        }
                    } else {
                        $status = "Not Verified ";
                        $message = "Please Try Again Later";
                    }
                } else {
                    $status = "Not Verified ";
                    $message = "Confirmation Key Is Not Valid !";
                }
            } else {
                $status = "Not Verified ";
                $message = "Confirmation Link Is Expire  !";
            }
        } else {
            $status = "Not Verified ";
            $message = "No ConfirmationKey Availbale !";
        }
        return view('user_info.verify_change_password', ['status' => $status, 'message' => $message]);
    }
    public function change_user_basic_update(Request $request)
    {
        $status = null;
        $message = null;
        if ($request->ajax()) {
            $user_name = $request->user_name;
            $user_email = $request->user_email;
            $user_phone = $request->user_phone;
            if ($user_name == null || $user_email == null || $user_phone == null) {
                $status = 400;
                $message = "You Can't Empty Fields";
            } else {
                DB::table('all_employe_details')->where('id', Auth::user()->e_id)->update(['employe_name' => $user_name, 'phone' => $user_phone, 'email' => $user_email]);
                DB::table('all_employe_login')->where('e_id', Auth::user()->e_id)->update(['email' => $user_email]);
                $status = 200;
                $message = "Employe Details Are Updated ";
            }
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            return redirect('/user_info');
        }
    }
    public function update_employe_profile_method(Request $request)
    {
        $status = null;
        $message = null;
        if ($request->ajax()) {
            $employe_profile = $request->file('employe_profile');
            $check = false;
            if ($request->hasFile('employe_profile')) {
                $extension = ['jpeg', 'png', 'jpg'];
                if (in_array($employe_profile->getClientOriginalExtension(), $extension)) {
                    $check = true;
                }
            } else {
                $check = false;
            }
            if ($check) {
                try {
                    $profile_location = $employe_profile->store('public/images/' . strval(Auth::user()->e_id) . "/profile");
                    $check = true;
                } catch (Exception $e) {
                    $check = false;
                }
                if ($check) {
                    DB::table('all_employe_details')->where('id', Auth::user()->e_id)->update(['employe_profile' => $profile_location]);
                    $status = 200;
                    $message = "Profile Image Updated !";
                } else {
                    $status = 400;
                    $message = "Problem With Image ! Try Again ";
                }
            } else {
                $status = 400;
                $message = "Select Profile Image ";
            }
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            return redirect('/user_info');
        }
    }
    public function show_employe_profile_method($profile_url)
    {
        $imgURl = Storage::url($_GET[$profile_url]);
        // $_FILES = File::get($imgURl);
        $res = Response::make($imgURl, 200);
        $res->header("Content-type",);
        return $res;
    }
}
