<?php

namespace App\Http\Controllers\Backend\SellerOperations\SellerAuthenticationSystem;

use App\Models\Seller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SellerBankDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SellerAuthenticationController extends Controller
{
    public function login()
    {
        return view('backend.seller.seller-authentication.seller-login');
    }

    public function register()
    {
        return view('backend.seller.seller-authentication.seller-register');
    }

    public function store(Request $request)
    {
        // $data = $request->all();
        // echo "<pre>"; print_r($data);die;
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


            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $seller = new Seller();
                $seller->name = $request->name;
                $seller->email = $request->email;
                $seller->status = 0;
                $seller->password = Hash::make($request->password);
                $submit = $seller->save();

                //Send Confirmation Email //
                $email = $request->email;
                $messageData = [
                    'email' => $request->email,
                    'name' => $request->name,
                    'code' => base64_encode($request->email)
                ];

                Mail::send('email-pages.seller_confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm Your Seller Account');
                });

                $message = "Thanks for registering as Seller  Please Confirm Your Email to Activate";

                return response()->json([
                    'status' => '1',
                    'message' => $message,

                ]);
                // if ($submit) {
                //     return response()->json([
                //         'status' => '1',
                //         'message' => 'Registration Successful : Please Wait to Redirect on Login Page',
                //         "redirect_url" => route('seller.login'),
                //     ]);
                // }
                // return redirect()->back()->with('error')

            }
        }
    }


    public function UpdateSellerPassword(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            // echo "<pre>";print_r($data);die;

            if (Hash::check($data['current_password'], Auth::guard('seller')->user()->password)) {

                if ($data['confirm_password'] == $data['new_password']) {

                    $submit = Seller::where('id', Auth::guard('seller')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    if ($submit) {
                        return response()->json([
                            'status' => '1',
                            'message' => 'Password Changed Successfully : Please Wait to Redirect on Seller Dashboard',
                            "redirect_url" => route('seller.dashboard'),
                        ]);
                    }
                    // return redirect()->back()->with('success_message','Password Changed Successfully');
                } else {
                    // return redirect()->back()->with('error_message','Password Not Match');
                    return response()->json([
                        'status' => '0',
                        'message' => 'Password Do not Matched',


                    ]);
                }
            } else {
                return response()->json([
                    'status' => '2',
                    'message' => 'Invalid Current Password !',


                ]);
            }
        }

        $sellerdetail = Seller::where('email', Auth::guard('seller')->user()->email)->first()->toArray();
        return view('backend.seller.seller-authentication.seller-change-password')->with(compact('sellerdetail'));
    }


    public function sellerForgotPassword(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            $custom_message = [
                'email.exists' => 'Email is not Exists in our Record',

            ];

            $validator = Validator::make($request->all(), [

                'email' => 'required|email|exists:sellers',

            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {

                // generate new Password//
                $new_password = Str::random(16);
                //update new Password  //
                Seller::where('email', $data['email'])->update(['password' => Hash::make($new_password)]);

                //get user details//
                $sellerDetails = Seller::where('email', $data['email'])->first()->toArray();

                //send email to user //
                $email = $data['email'];
                $messageData = ['name' => $sellerDetails['name'], 'email' => $email, 'password' => $new_password];
                Mail::send('email-pages.user_forgot_password', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('New Password - e-commerce');
                });

                // show success message//
                // return redirect()->back()->with('success_message','New Password Sent to Your registered email');
                return response()->json(['status' => '1', 'message' => 'New Password Sent to Your registered email.']);
            }
        }
        return view('backend.seller.seller-authentication.seller-forgot-password');
    }


    public function confirmSellerAccount($email)
    {
        $email = base64_decode($email);

        //Check Vendor Email Exists //
        $sellerCount = Seller::where('email', $email)->count();
        if ($sellerCount > 0) {
            //Vendor Email is Already Activated or not//
            $sellerDetails = Seller::where('email', $email)->first();
            if ($sellerDetails->confirm == "Yes") {
                $message = "Your Seller Account is Already Confirmed. You can login";
                return redirect()->route('seller.login')->with('success_message', $message);
            } else {
                //Update Confirm column to Yes to activate account //
                Seller::where('email', $email)->update(['confirm' => 'Yes']);

                //Send Register Email //

                $messageData = [
                    'email' => $email,
                    'name' => $sellerDetails->name,
                    'phone' => $sellerDetails->phone
                ];

                Mail::send('email-pages.seller_confirmed', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Your Vendor Account is Confimred');
                });

                //Redirect To login page with Success Message//
                $message = "Your Seller Email Account is Confirmed. Login to Fill Your Personal and All Details to Approve your Seller Account to Add Products";
                return redirect()->route('seller.login')->with('success_message', $message);
            }
        } else {
            abort(404);
        }
    }


    public function check(Request $request)
    {
        if ($request->isMethod('post')) {

            // $data = $request->all();
            $custom_message = [
                'email.exists' => 'Email is not Exists in our Record',

            ];

            $validator = Validator::make($request->all(), [

                'email' => 'required|exists:sellers,email',
                'password' => 'required',


            ], $custom_message);

            if ($validator->fails()) {
                // return redirect()->back()->with('error_message', 'Validation Errros');
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $creds = $request->only('email', 'password');
                // dd($creds);


                if (Auth::guard('seller')->attempt($creds)) {

                    if (Auth::guard('seller')->user()->confirm == "No") {
                        return response()->json([
                            'status' => '1',
                            'message' => 'Your Email is not Confirm',
                            "redirect_url" => route('seller.login'),
                        ]);
                    } else if (Auth::guard('seller')->user()->status == "0") {

                        $personalDetails = SellerBankDetails::where('seller_id', Auth::guard('seller')->user()->id)->first();
                        // dd($personalDetails);

                        if (empty($personalDetails->seller_id)) {
                            return response()->json([
                                'status' => '2',
                                'message' => 'Your Account is not Approve Please fill your Details To approve',
                                "redirect_url" => route('seller.all-personal-details'),
                            ]);
                        } else {
                            return response()->json([
                                'status' => '2',
                                'message' => 'You Submitted Your Details Please wait for review',
                                "redirect_url" => route('seller.login'),
                            ]);
                        }
                    }



                    // return redirect()->back()->with('success_message','Your email is not confimrned');
                    return response()->json([
                        'status' => '3',
                        'message' => 'Login SuccessFul! Please Wait to redirect on Dashboard',
                        "redirect_url" => route('seller.dashboard'),
                    ]);
                } else {
                    return response()->json([
                        'status' => '4',
                        'message' => 'Invalid Email or Password',
                        "redirect_url" => route('seller.login'),
                    ]);
                }
            }
        }
    }

    public function logout()
    {
        Auth::guard('seller')->logout();

        return redirect()->route('seller.login');
    }
}
