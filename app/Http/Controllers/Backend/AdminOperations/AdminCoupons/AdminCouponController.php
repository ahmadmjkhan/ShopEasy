<?php

namespace App\Http\Controllers\Backend\AdminOperations\AdminCoupons;

use App\Models\User;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\AdminRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminCouponController extends Controller
{
    public function coupon_index()
    {

        if (Auth::guard('admin')->check()) {
            $allcoupons = Coupon::with('seller_coupon')->get();
            // dd($allcoupons);

            $couponModuleCount = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'coupons'])->count();
        if(Auth::guard('admin')->user()->type=='SuperAdmin'){
            $couponModule['view_access'] =1;
            $couponModule['edit_access'] =1;
            $couponModule['full_access'] =1;
        }elseif($couponModuleCount==0){
               $message = "This feature is Restricted For You";
               return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $couponModule = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'coupons'])->first()->toArray();
        }
            return view('backend.admin.coupons.coupon-index')->with(compact(['allcoupons','couponModule']));
        } else {
            redirect()->route('admin.login');
        }





        // redirect()->route('admin.login');

    }

    public function updatecouponstatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();


            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Coupon::where('id', $data['coupon_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'coupon_id' => $data['coupon_id']]);
        }
    }

    public function Add_Edit_Coupons(Request $request, $id = null)
    {
        if ($id == '') {
            $title = 'Add Coupon';
            $message = "Coupon Added Successfully";
            $coupon = new Coupon();
            $selcats = array();
            $selbrands  = array();
            $selusers = array();

            $getcategories = array();
        } else {
            $title = "Edit Coupon";

            $coupon = Coupon::find($id);
            $selcats = explode(',', $coupon['categories']);
            $selbrands  = explode(',', $coupon['brands']);
            $selusers = explode(',', $coupon['users']);
            // $getcategories = Category::with('subcategories')->where(['parent_id' =>0, 'section_id' => $category->section_id])->get();

            $message = "Coupon Updated Successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            $validator = Validator::make($request->all(), [
                'categories' => 'required',
                'brands' => 'required',
                'users' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {

                if (isset($request->users)) {
                    $users = implode(",", $request->users);
                } else {
                    $users = "";
                }
                if (isset($request->categories)) {
                    $categories = implode(",", $request->categories);
                } else {
                    $categories = "";
                }
                if (isset($request->brands)) {
                    $brands = implode(",", $request->brands);
                } else {
                    $brands = "";
                }
                if ($request->coupon_option == "Manual") {
                    $coupon_code = $request->coupon_code;
                } else {
                    $coupon_code = Str::random(8);
                }
                // echo "<pre>";print_r($data);die;

                if (Auth::guard('admin')->check()) {

                    $vendorId = Auth::guard('admin')->user()->id;
                }






                // $coupon->seller_id = $vendorId;
                $coupon->admin_id = $vendorId;
                $coupon->coupon_option = $request->coupon_option;
                $coupon->coupon_code = $coupon_code;
                $coupon->categories = $categories;
                $coupon->users = $users;
                $coupon->brands = $brands;
                $coupon->coupon_type = $request->coupon_type;
                $coupon->amount_type = $request->amount_type;
                $coupon->amount = $request->amount;
                $coupon->expiry_date = $request->expiry_date;
                $coupon->status = $request->status == TRUE ? '1' : '0';
                $submit = $coupon->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => $message,
                        "redirect_url" => route('admin.coupon_index'),
                    ]);
                }
            }
        }






        $categories = Section::with('categories')->get();
        $brands = Brand::where('status', 1)->get();
        $users = User::select('email')->where('status', 1)->get();
        return view('backend.admin.coupons.add-edit-coupon')->with(compact(['title', 'coupon', 'categories', 'brands', 'users', 'selcats', 'selbrands', 'selusers']));
    }

    public function delete_coupons($id)
    {

        $coupons = Coupon::find($id);



        $submit = $coupons->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Coupon Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }

    public function deleteallcoupons(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $ids = $data['ids'];
        $coupon = explode(",", $ids);


        foreach ($coupon as $id) {
            $coupons = Coupon::find($id);
            // echo "<pre>";print_r($cat);die;

            if ($coupons) {
                $coupons->delete();
              
            }
        }
        return response()->json([
            'status' => '1',
            'message' => 'Coupon Deleted Successfully',
            "redirect_url" => route('admin.coupon_index'),
        ]);
    }
}
