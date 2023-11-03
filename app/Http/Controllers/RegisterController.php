<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\DeleteToken;
use Carbon\Carbon;
use Exception;


class RegisterController extends Controller
{
    public function register_fetch(Request $req)
    {

        $req->validate(
            [
                'fn' => 'required|min:3|max:20|regex:/^[\pL\s\-]+$/u',
                'em' => 'required|email|unique:registration,email',
                'pwd' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/|confirmed',
                'pwd_confirmation' => 'required',
                'mobile' => 'required|digits:10|numeric',
                'pic' => 'required|max:25000|mimes:jpeg,bmp,png,jpg'
            ],
            [
                'fn.required' => 'Full name cannot be empty',
                'fn.min' => 'Full name must contain minimum 3 characters',
                'fn.max' => 'Full name must contain maximum of 30 characters',
                'fn.regex' => 'Full name must contain only letters and spaces',
                'em.required' => 'Email address canniot be empty',
                'em.email' => 'invalid email address',
                'em.unique' => 'Email is already regsitered',
                'pwd.required' => 'Password field cannot be empty',
                'pwd.regex' => 'Password must contain one small letter one capital letter, one number and one special symbol',
                'pwd.confirmed' => 'Password and Confirm Password must match',
                'pwd_confirmation.required' => 'Confirm Password must not be empty',
                'mobile.required' => 'Mobile number cannot be empty',
                'mobile.digits' => 'Mobile number must conatin only 10 digits',
                'mobile.numeric' => 'Mobile number must contain digits only',
                'pic.required' => 'Please select a file to uplaod',
                'pic.max' => 'Select a file of max 25 KB',
                'pic.mimes' => 'Select jpg or png or bmp file to uplaod'
            ]
        );

        $registration = new Registration();

        $registration->fullname = $req->fn;
        $registration->email = $req->em;
        $original_name = uniqid() . $req->file('pic')->getClientOriginalName();
        $req->pic->move('Images/profile_pictures', $original_name);
        $registration->pic = $original_name;
        $registration->password = $req->pwd;
        $registration->mobile = $req->mobile;
        if ($registration->save()) {
            $data = array('name' => $req->fn, 'email' => $req->em);

            Mail::send(['text' => 'create_account_mail'], ["data1" => $data], function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject('Account Activation Link');
                $message->from('janki.kansagra@rku.ac.in', 'Janki Kansagra');
            });
            $req->session()->flash('succ', 'Activation mail sent to your registered email address');
        } else {
            $req->session()->flash('error', 'Error in saving data. Please try again.');
        }
        return redirect('register')->with('status', 'Task was successful!');
    }

    public function verify_email($email, Request $req)
    {

        $result = Registration::whereEmail($email)->first();
        if (empty($result)) {
            $req->session()->flash('error', 'Your account is not registered. kindly register here.');
            return redirect('register');
        } else {
            if ($result->status == 'Active') {
                $req->session()->flash('succ', 'Your account is already activated kindly login');
            } else {
                $update = Registration::where('email', $email)->update(array('status' => 'Active'));
                if ($update) {
                    $req->session()->flash('succ', 'Your account is activated successfully. kindly login');
                } else {
                    $req->session()->flash('error', 'Account activation failed please try after sometime.');
                }
            }
            return redirect('login')->with('status', 'Task was successful!');
        }
    }

    public function forget_password_form_submit(Request $req)
    {
        date_default_timezone_set("Asia/Kolkata");
        $current_time = Carbon::now();
        DeleteToken::where('expiry_time', '<', $current_time)->delete();
        $rules = ['em' => 'required|email'];
        $errors = [
            'em.required' => 'Email addrss is a required field',
            'em.email' => 'Enter a valid email address'
        ];
        $req->validate($rules, $errors);
        $em = $req->em;
        $data = Registration::where('email', $em)->first();
        if ($data) {
            $data1 = DeleteToken::where('email', $em)->first();
            if ($data1) {
                session()->flash('warning', 'A Password reset link is already sent to your mail please check. New link will be generated after old link expires');
            } else {
                date_default_timezone_set("Asia/Kolkata");
                $s_time = date("Y-m-d G:i:s");

                $token = hash('sha512', $s_time);
                $otp = mt_rand(100000, 999999);
                $data2 = array('name' => $data->fn, 'email' => $em, 'token' => $token, 'otp' => $otp);
                try {
                    Mail::send(['text' => 'mail_forget_pwd'], ["data3" => $data2], function ($message) use ($data2) {
                        $message->to($data2['email'], $data2['name'])->subject('Account Activation Link');
                        $message->from('janki.kansagra@rku.ac.in', 'Janki Kansagra');
                    });
                } catch (Exception $ex) {
                    session()->flash('error', 'We encountered some error in sending the password reset token');
                    return redirect('forget_password_form');
                }
                $expiry_time = Carbon::now()->addMinutes(30);
                $token_ins = new DeleteToken();
                $token_ins->email = $em;
                $token_ins->otp = $otp;
                $token_ins->token = $token;
                $token_ins->expiry_time = $expiry_time;
                if ($token_ins->save()) {
                    session()->flash('success', 'Password reset tokens sent to your registered email address');
                }
            }
        } else {
            session()->flash('error', 'Sorry the email address you entered is not registered.');
        }
        return redirect('forget_password_form');
    }

    public function verify_forget_pwd_otp($email, $token)
    {
        date_default_timezone_set("Asia/Kolkata");
        session()->put('forget_pwd_email', $email);
        session()->put('forget_pwd_token', $token);
        $current_time = Carbon::now();
        DeleteToken::where('expiry_time', '<', $current_time)->delete();
        $data1 = DeleteToken::where('email', $email)->first();
        if ($data1) {
            return view('verify_otp_forget_pwd');
        } else {
            session()->flash('error', 'Password reset token expired. Please Generate the link again by submitting the form');
            return redirect('forget_password_form');
        }
    }

    public function verify_otp_forget_password_action(Request $req)
    {

        $req->validate(['otp' => 'required|size:6'], ['otp.required' => 'OTP cannot be empty', 'otp.size' => 'OTP must have 6 digits only']);
        $otp = $req->otp;
        if (session('forget_pwd_token') && session('forget_pwd_email')) {
            $email = session()->get('forget_pwd_email');
            $token = session()->get('forget_pwd_token');
        }
        $data = DeleteToken::where('email', $email)->where('token', $token)->first();
        if ($data) {
            if ($data->otp == $otp) {
                return view('reset_pwd');
            } else {
                session()->flash('error', 'Incorrect OTP');
                return view('verify_otp_forget_pwd');
            }
        } else {
            session()->flash('error', 'Password reset token expired. Please Generate the link again by submitting the form');
            return redirect('forget_password_form');
        }
    }

    public function reset_pwd_action(Request $req)
    {
        $rules = [
            'npwd' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/|confirmed',
            'npwd_confirmation' => 'required',
        ];
        $errors = [
            'npwd.required' => 'Password field cannot be empty',
            'npwd.regex' => 'Password must contain one small letter one capital letter, one number and one special symbol',
            'npwd.confirmed' => 'Password and Confirm Password must match',
            'npwd_confirmation.required' => 'Confirm Password must not be empty'
        ];
        $req->validate($rules, $errors);
        if (session('forget_pwd_token') && session('forget_pwd_email')) {
            $email = session()->get('forget_pwd_email');
            $token = session()->get('forget_pwd_token');
        }
        date_default_timezone_set("Asia/Kolkata");
        $current_time = Carbon::now();
        DeleteToken::where('expiry_time', '<', $current_time)->delete();
        $data = DeleteToken::where('email', $email)->where('token', $token)->first();
        if ($data) {
            $data1 = Registration::where('email', $email)->update(array('password' => $req->npwd));
            if ($data1) {
                DeleteToken::where('email', $email)->delete();
                session()->flash('succ', 'Password changed successfully');
                return redirect('login');
            }
        } else {
            session()->flash('error', 'Password reset token expired. Please Generate the link again by submitting the form');
            return redirect('forget_password_form');
        }
    }
}
