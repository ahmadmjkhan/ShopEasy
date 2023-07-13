<?php

namespace App\Http\Controllers\Backend\AdminOperations\AdminAuthenticationSystem;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthenticationController extends Controller
{
    public function login()
    {

        return view('backend.admin.admin-authentication.admin-login-page');
    }

    public function register()
    {
        return view('backend.admin.admin-authentication.admin-register-page');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            $custom_message = [
                'name.required' => 'Name is Required',
                'conpassword.same' => 'Password and Confirm Password do not Matched!',
                'email.unique' => 'Email is already Exists',
            ];

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'conpassword' => 'required|same:password',


            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $admin = new Admin();
                $admin->name = $request->name;
                $admin->type = $request->type;
                $admin->email = $request->email;
                // $admin->status = $request->status == TRUE ? '1' : '0';
                $admin->status = 1;
                $admin->password = Hash::make($request->password);
                $submit = $admin->save();

                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => 'Registration Successful : Please Wait to Redirect on Login Page',
                        "redirect_url" => route('admin.login'),
                    ]);
                }
                // return redirect()->back()->with('error')
                // return redirect()->route('admin.login');
            }
        }
    }


    public function check(Request $request)
    {
        if ($request->isMethod('post')) {

            $custom_message = [
                'email.exists' => 'Email is not Exists in our Record',

            ];

            $validator = Validator::make($request->all(), [

                'email' => 'required|exists:admins,email',
                'password' => 'required',


            ], $custom_message);

            if ($validator->fails()) {

                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $creds = $request->only('email', 'password');
                // dd($creds);

                if (Auth::guard('admin')->attempt($creds)) {
                    if (Auth::guard('admin')->user()->status == '0') {
                        return response()->json([
                            'status' => '2',
                            'message' => 'Your Account is not Active',
                            "redirect_url" => route('admin.login'),
                        ]);
                    } else {
                        return response()->json([
                            'status' => '1',
                            'message' => 'Login Successful : Please Wait to Redirect on Dashboard',
                            "redirect_url" => route('admin.dashboard'),
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => '2',
                        'message' => 'Invalid Email or Password',
                        "redirect_url" => route('admin.login'),
                    ]);
                }
            }
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
