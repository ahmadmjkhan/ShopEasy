<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_index');
    }

    public function login_index()
    {
        return view('admin.authentication.login');
    }

    public function register_index()
    {
        return view('admin.authentication.register');
    }

    public function update_users_status(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            User::where('id', $data['user_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'user_id' => $data['user_id']]);
        }
    }

    public function update_sellers_status(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Seller::where('id', $data['seller_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'seller_id' => $data['seller_id']]);
        }
    }

    public function update_all_admins_status(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Admin::where('id', $data['admin_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'admin_id' => $data['admin_id']]);
        }
    }

    public function UpdateAdminDetails(Request $request)
    {



        if ($request->isMethod('post')) {
            $data = $request->all();
            //    echo print_r($data);die;

            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['name'], 'email' => $data['email']]);
            return redirect()->back()->with('success_message', 'Detail Changed Successfully');
        }

        $admindetail = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.authentication.update-admin-details', compact('admindetail'));
    }

    public function add_edit_All_Admin_Details(Request $request, $id = null)
    {

        if ($id == '') {
            $title = "Add Admins/Subadmins";
            $all_admin = new Admin();
            $message = "Admins Added Successfully";
        } else {
            $title = "Edit Admin/Subadmins";
            $all_admin = Admin::find($id);
            $message = "Admins Updated Successfully";
        }

        if ($request->isMethod('post')) {
            $all_admin->email = $request->email;
                $all_admin->type = $request->type;
                $all_admin->name = $request->name;
                $all_admin->status = 1;
                
                $all_admin->password = Hash::make($request->password);
               
                
               
                $submit = $all_admin->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => $message,
                        "redirect_url"=>route('admin.home'),
                    ]);
                }

            }
            
       
        return view('admin.authentication.update-all-admin-details', compact('all_admin','title'));
    }


    public function UpdateAdminPassword(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            // echo "<pre>";print_r($data);die;

            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {

                if ($data['confirm_password'] == $data['new_password']) {

                    $submit = Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    if ($submit) {
                        return response()->json([
                            'status' => '1',
                            'message' => 'Password Changed Successfully : Please Wait to Redirect on Admin Dashboard',
                            "redirect_url" => route('admin.home'),
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

        $admindetail = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.authentication.update-admin-password', compact('admindetail'));
    }

    public function create(Request $request)
    {

        if ($request->isMethod('post')) {

            $custom_message = [
                'name.required' => 'Name is Required',
                'conpassword.same' => 'Password and Confirm Password do not Matched!',
                'email.unique' => 'Email is already Exists',
            ];

            $validator = Validator::make($request->all(), [
                'name' => 'required',

                'email' => 'required|unique:admins',
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
                $admin->email = $request->email;
                $admin->type = $request->type;
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
                    return response()->json([
                        'status' => '1',
                        'message' => 'Login Successful : Please Wait to Redirect on Dashboard',
                        "redirect_url" => route('admin.home'),
                    ]);
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


    public function ForgotPasswordCreate()
    {
        return view('admin.authentication.forgot-password');
    }


    public function Seller_details(){
        $allsellers = Seller::all();
        // dd($allsellers);
        return view('admin.all-sellers.all-sellers-index')->with(compact('allsellers'));
    }

    public function User_details(){
        $allusers = User::all();
        // dd($allsellers);
        return view('admin.all-users.all-users-index')->with(compact('allusers'));
    }

    public function admins($type = null)
    {

        $admins = Admin::query();


        if (!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type) . "s";
        } else {

            $title = "All Admins/SubAdmins/Vendors";
        }

        $admins = $admins->get();


        return view('admin.all-admins.all-admin-index')->with(compact(['admins', 'title']));
    }


    public function delete_admins($id)
    {

        $admin = Admin::find($id);

        // if ($banner->banner_image) {
        //     $path = 'uploads/images/banners/' . $banner->banner_image;

        //     if (File::exists($path)) {
        //         File::delete($path);
        //     }
        // }

        $submit = $admin->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Admin Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
