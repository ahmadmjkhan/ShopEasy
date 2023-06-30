<?php

namespace App\Http\Controllers\Frontend\UserOperations;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function productlisting(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();
            echo "<pre>";print_r($data);die;


            $url = $data['url'];



            $_GET['sort'] = $data['sort'];

            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);

                $categoryProducts = Product::with('brands')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);




                // $productFilters = ProductsFilter::productFilters();
                // foreach($productFilters as $filter){
                //     if(isset($filter->filter_column)&& isset($data[$filter->filter_column]) && !empty($filter->filter_column) && !empty($data[$filter->filter_column])){
                //         $test = $categoryProducts->whereIn($filter->filter_column,$data[$filter->filter_column]);
                //         echo"<pre>";print_r($test);die;
                //     }
                // }

                // if(isset($data['size']) && !empty($data['size'])){
                //     $productIds = ProductsAttributes::select('product_id')->whereIn('size',$data['size'])->pluck('product_id');
                //     $categoryProducts->whereIn('products.id',$productIds);
                // }



                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == "product-latest") {
                        $categoryProducts->orderBy('products.id', 'Desc');
                    } else if ($_GET['sort'] == "price-lowest") {
                        $categoryProducts->orderBy('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == "price-highest") {
                        $categoryProducts->orderBy('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == "name_a_z") {
                        $categoryProducts->orderBy('products.product_name', 'Asc');
                    } else if ($_GET['sort'] == "name_z_a") {
                        $categoryProducts->orderBy('products.product_price', 'Desc');
                    }
                }

                $categoryProducts = $categoryProducts->paginate(6);

                return view('frontend.product-pages.ajax-product-listing')->with(compact(['categoryProducts', 'categoryDetails']));
            }
        } else {

            $url = Route::getFacadeRoot()->current()->uri();



            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();

            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brands')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->paginate(6);


                return view('frontend.product-pages.product-listing')->with(compact(['categoryProducts', 'categoryDetails', 'url']));
            }
        }
    }




    public function UserRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            // $data = $request->all();
            // echo "<pre>";print_r($data);

            $custom_message = [
                'name.required' => 'Name is Required',
                'conpassword.same' => 'Password and Confirm Password do not Matched!',

            ];

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
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
                $user = new User();
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $submit = $user->save();

                // Register the user only when confirm his email account//

                $email = $request->email;
                $messageData = ['name' => $request->name, 'email' => $email, 'code' => base64_encode($email)];
                Mail::send('email-pages.confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm Your Account');
                });

                // Redirect back user with success message //

                $redirectTo = url('user/register');
                return response()->json(['url' => $redirectTo, 'message' => 'Please Confirm Your email to activate your Account']);

                // Activate the user  without sending any confirmation email //

                // //Send Register Email //
                // $email = $request->email;
                // $messageData = ['name'=>$request->name,'phone'=>$request->phone,'email'=>$request->email];
                // Mail::send('emails.register',$messageData,function($message)use($email){
                //    $message->to($email)->subject('welcome to e-commerce');
                // });
                // if ($submit) {
                //     return response()->json([
                //         'status' => '1',
                //         'message' => 'Registration Successful : Please Login to Get Access',
                //         "redirect_url" => route('user.home'),
                //     ]);
                // }
            }
        }
        return view('frontend.authentication.user-register-page');
    }


    public function check(Request $request)
    {
        if ($request->isMethod('post')) {

            $custom_message = [
                'email.exists' => 'Email is not Exists in our Record',

            ];

            $validator = Validator::make($request->all(), [

                'email' => 'required|email|exists:users',
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

                if (Auth::guard('web')->attempt($creds)) {

                    if (Auth::user()->status == 0) {
                        Auth::logout();
                        return response()->json(['status' => 'inactive', 'message' => 'Your Email is not Verified! please Verified to Login']);
                    }

                    // update user cart with userid//

                    // if (!empty(Session::get('session_id'))) {
                    //     $user_id = Auth::user()->id;
                    //     $session_id = Session::get('session_id');
                    //     Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                    // }
                    return response()->json([
                        'status' => '1',
                        'message' => 'Login Successful : Please Wait to Redirect on Dashboard',
                        "redirect_url" => route('user.home'),
                    ]);
                } else {
                    return response()->json([
                        'status' => '2',
                        'message' => 'Invalid Email or Password',

                    ]);
                }
            }
        }
    }


    public function confirm_account($code)
    {

        $email = base64_decode($code);
        $userCount = User::where('email', $email)->count();
        if ($userCount > 0) {
            $userDetails = User::where('email', $email)->first();
            if ($userDetails->status == 1) {
                // Redirect to user login page //
                return redirect('user/register')->with('error_message', 'Your Account is ALready Activated,You can login Now');
            } else {
                User::where('email', $email)->update(['status' => 1]);
                //Send Register Email //

                $messageData = ['name' => $userDetails->name, 'phone' => $userDetails->phone, 'email' => $email];
                Mail::send('email-pages.register', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('welcome to e-commerce');
                });
                // Redirect to user login page //
                return redirect('/')->with('success_message', 'Your Account is Activated,You can login Now');
            }
        } else {
            abort(404);
        }
    }

    public function forgot_password(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $custom_message = [
                'email.exists' => 'Email is not Exists in our Record',

            ];

            $validator = Validator::make($request->all(), [

                'email' => 'required|email|exists:users',

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
                User::where('email', $data['email'])->update(['password' => Hash::make($new_password)]);

                //get user details//
                $userDetails = User::where('email', $data['email'])->first()->toArray();

                //send email to user //
                $email = $data['email'];
                $messageData = ['name' => $userDetails['name'], 'email' => $email, 'password' => $new_password];
                Mail::send('email-pages.user_forgot_password', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('New Password - e-commerce');
                });

                // show success message//
                return response()->json(['status' => '1', 'message' => 'New Password Sent to Your registered email.']);
            }
        }
    }


    public function userMyAccount(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $custom_message = [
                'name.required' => 'Name is Required',


            ];

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'city' => 'required',
                'state' => 'required',
                'address' => 'required',
                'country' => 'required|string',
                'phone' => 'required|numeric|',
                'pincode' => 'required'

            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                // Update user details //

                if ($request->hasfile('user_avatar')) {
                    $userImage = User::where('id', Auth::guard('web')->user()->id)->select('user_avatar')->first();

                    $path = 'uploads/user_avatar/' . $userImage->user_avatar;
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $file = $request->file('user_avatar');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/user_avatar/', $filename);
                    // $request->address_proof_image = $filename;
                } elseif (!empty($data['user_avatar'])) {
                    $filename = $data['user_avatar'];
                } else {
                    $filename = "";
                }

                User::where('id', Auth::user()->id)->update(['name' => $data['name'], 'phone' => $data['phone'], 'city' => $data['city'], 'state' => $data['state'], 'country' => $data['country'], 'pincode' => $data['pincode'], 'address' => $data['address'], 'user_avatar' => $filename]);

                return response()->json(['status' => '1', 'message' => 'Your contact details Updated Successfully']);
            }
        } else {
            $userDetails = User::where('id', Auth::guard('web')->user()->id)->first();
            return view('frontend.authentication.user-my-account-page')->with(compact('userDetails'));
        }
    }

    public function updateUserPassword(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $custom_message = [
                'current_password.required' => 'Current Password is Required',


            ];

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password',

            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $current_password  = $data['current_password'];
                $checkPassword = User::where('id', Auth::user()->id)->first();

                if (Hash::check($current_password, $checkPassword->password)) {
                    // Update user current Pasword//
                    $user = User::find(Auth::user()->id);
                    $user->password = Hash::make($data['new_password']);
                    $user->save();

                    return response()->json(['status' => '1', 'message' => 'Password Changed Successfully']);
                } else {
                    return response()->json(['type' => 'incorrect', 'message' => 'Your Current Password is Incorrect']);
                }
            }
        } else {
            return view('frontend.authentication.user-my-account-page');
        }
    }



    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect()->route('index');
        }
    }
}
