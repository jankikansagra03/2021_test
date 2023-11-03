<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Registration;

class LoginController extends Controller
{
    //
    public function login_authentication(Request $request)
    {
        $rules = [
            'em' => 'required|email',
            'pwd' => 'required'
        ];
        $errors = [
            'em.required' => 'Email address can not be empty',
            'em.email' => 'Enter a valid email address',
            'pwd.required' => 'Password field cannot be empty'
        ];
        $validator = Validator::make($request->all(), $rules, $errors);
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator);
        } else {
            $count = Registration::where('email', $request->em)->where('password', $request->pwd)->count();
            if ($count == 1) {
                $result = Registration::where('email', $request->em)->first();
                if ($result->status == 'Inactive') {
                    session()->flash('error', 'Your account is not activated');
                    return redirect('login');
                } else if ($result->status == 'Deleted') {
                    session()->flash('error', 'Your account is Deleted kindly contact admin');
                    return redirect('Reactivate_deleted_acount');
                } else {
                    session()->put('user', $result->email);
                    session()->put('password', $result->password);
                    if ($result->role == "Normal") {
                        echo "User";
                        return redirect('user_dashboard');
                    } else {
                        echo "Admin";
                        return redirect('admin_dashboard');
                    }
                }
            } else {
                session()->flash('error', 'Invalid email or password');
                return redirect('login');
            }
        }
    }

    public function user_dashboard()
    {
        return redirect('user_dashboard');
    }
    public function admin_dashboard()
    {
        return redirect('admin_dashboard');
    }
    public function logout()
    {
        session()->forget('user');
        session()->forget('password');
        session()->flash('Success', 'Your account was logged out successfully');
        return redirect('login');
    }
}
