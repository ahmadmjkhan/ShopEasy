<?php

namespace App\Http\Controllers\Backend\AdminOperations\AdminController;

use App\Models\User;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SellerBankDetails;
use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\SellerBussinessDetails;

class AdminController extends Controller
{
    public function dashboard()
    {
      $all_section = Section::get()->count();
      $all_categories = Category::get()->count();
      $all_products = Product::get()->count();
      $all_brands = Brand::get()->count();
      $all_sellers = Seller::get()->count();
      $all_users = User::get()->count();
      $all_orders = Order::get()->count();
  
      return view('backend.admin.admin-dashboard')->with(compact(['all_section', 'all_categories', 'all_products', 'all_brands', 'all_sellers', 'all_users', 'all_orders']));
    }


    
  
  
    public function allSellers()
    {
  
      $all_sellers = Seller::all();
      return view('backend.admin.all-sellers.all-seller-index')->with(compact('all_sellers'));
    }
  
    public function allUsers()
    {
      $all_users = User::all();
      return view('backend.admin.all-users.all-user-index')->with(compact('all_users'));
    }
  
  
    public function update_sellers_status(Request $request)
    {
  
      // if ($request->ajax()) {
      //   $data = $request->all();
      //   $update = Seller::where('id', $data['user_id'])->update(['status' => $data['status']]);
  
      //   if ($update) {
      //     return response()->json([
      //       'status' => '1',
      //       'message' => "Status Changed Successfully",
      //     ]);
      //   }
      // }
  
      if ($request->ajax()) {
        $data = $request->all();
  
        if ($data['status'] == 'Active') {
          $status = 0;
        } else {
          $status = 1;
        }
  
  
  
        Seller::where('id', $data['seller_id'])->update(['status' => $status]);
        // $sellerDetails = Seller::where('id',$data['seller_id'])->first()->toArray();
  
        // if($status == 1){
        //   //Send Approval Email //
        //   $email = $sellerDetails['email'];
        //   $messageData = [
        //       'email' => $sellerDetails['email'],
        //       'name' =>$sellerDetails['name'],
        //       'phone' => $sellerDetails['phone']
        //   ];
  
        //   Mail::send('emails.seller_approved', $messageData, function ($message) use ($email) {
        //       $message->to($email)->subject('Your Seller Account is Approved');
        //   });
        // }
        return response()->json(['status' => $status, 'seller_id' => $data['seller_id']]);
      }
    }
  
    public function viewSellerDetails($id)
    {
      $sellerPersonalDetails = Seller::where('id', $id)->first();
      $sellerBankDetails = SellerBankDetails::where('seller_id', $id)->first();
      $sellerBussinessDetails = SellerBussinessDetails::where('seller_id', $id)->first();
  
      return view('backend.admin.all-sellers.view-seller-details')->with(compact(['sellerPersonalDetails', 'sellerBankDetails', 'sellerBussinessDetails']));
    }
  
  
    public function update_sellers_comisions(Request $request)
    {
      if ($request->isMethod('post')) {
        $data = $request->all();
  
        Seller::where('id', $data['seller_id'])->update(['comissions' => $data['comissions']]);
        return redirect()->back()->with('success_message', 'Seller Comission Updated Successfully');
      }
    }
    public function update_users_status(Request $request)
    {
  
      // if ($request->ajax()) {
      //   $data = $request->all();
      //   $update = Seller::where('id', $data['user_id'])->update(['status' => $data['status']]);
  
      //   if ($update) {
      //     return response()->json([
      //       'status' => '1',
      //       'message' => "Status Changed Successfully",
      //     ]);
      //   }
      // }
  
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
  
  
    public function delete_seller($id)
    {
  
      $seller = Seller::find($id);
  
      // if ($banner->banner_image) {
      //     $path = 'uploads/images/banners/' . $banner->banner_image;
  
      //     if (File::exists($path)) {
      //         File::delete($path);
      //     }
      // }
  
      $submit = $seller->delete();
      if ($submit) {
        return response()->json([
          'status' => '1',
          'message' => 'Seller Deleted Successfully',
        ]);
      } else {
        return response()->json([
          'status' => '0',
          'message' => 'Problem Occurs',
        ]);
      }
    }
  
    public function deleteAllSellers(Request $request)
    {
      $data = $request->all();
      // echo "<pre>";print_r($data);die;
      $ids = $data['ids'];
      $seller = explode(",", $ids);
  
  
      foreach ($seller as $id) {
        $sellers = Seller::find($id);
        // echo "<pre>";print_r($cat);die;
  
        if ($sellers) {
          $sellers->delete();
  
          if ($sellers->seller_image) {
            $path = 'uploads/seller/seller_avatar/' . $sellers->seller_image;
  
            if (File::exists($path)) {
              File::delete($path);
            }
          }
        }
      }
      return response()->json([
        'status' => '1',
        'message' => 'Sellers Deleted Successfully',
        "redirect_url" => route('admin.all-sellers'),
      ]);
    }
  
    public function delete_user($id)
    {
  
      $user = User::find($id);
  
      // if ($banner->banner_image) {
      //     $path = 'uploads/images/banners/' . $banner->banner_image;
  
      //     if (File::exists($path)) {
      //         File::delete($path);
      //     }
      // }
  
      $submit = $user->delete();
      if ($submit) {
        return response()->json([
          'status' => '1',
          'message' => 'User Deleted Successfully',
        ]);
      } else {
        return response()->json([
          'status' => '0',
          'message' => 'Problem Occurs',
        ]);
      }
    }
  
  
    public function deleteAllUsers(Request $request)
    {
      $data = $request->all();
      // echo "<pre>";print_r($data);die;
      $ids = $data['ids'];
      $user = explode(",", $ids);
  
  
      foreach ($user as $id) {
        $users = User::find($id);
        // echo "<pre>";print_r($cat);die;
  
        if ($users) {
          $users->delete();
  
          if ($users->user_avatar) {
            $path = 'uploads/user_avatar/' . $users->user_avatar;
  
            if (File::exists($path)) {
              File::delete($path);
            }
          }
        }
      }
      return response()->json([
        'status' => '1',
        'message' => 'User Deleted Successfully',
        "redirect_url" => route('admin.all-users'),
      ]);
    }
  
  
  
    public function approve_seller($id)
    {
  
      $submit = Seller::where('id', $id)->update(['status' => '1']);
  
      $sellerDetails = Seller::where('id', $id)->first()->toArray();
  
  
  
      if ($submit) {
  
  
        $email = $sellerDetails['email'];
        $messageData = [
          'email' => $sellerDetails['email'],
          'name' => $sellerDetails['name'],
          'phone' => $sellerDetails['phone']
        ];
  
        Mail::send('email-pages.seller_approved', $messageData, function ($message) use ($email) {
          $message->to($email)->subject('Your Seller Account is Approved');
        });
  
        return response()->json([
          'status' => '1',
          'message' => 'Approved Successfully Successfully',
        ]);
      } else {
        return response()->json([
          'status' => '0',
          'message' => 'Problem Occurs',
        ]);
      }
    }

    public function updateAdminRole(Request $request,$id=null){
         
      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;

        unset($data['_token']);

        AdminRole::where('admin_id',$id)->delete();

        foreach($data as $key => $value){
          if(isset($value['view'])){
            $view = $value['view'];
          }else{
            $view = 0;
          }

          if(isset($value['edit'])){
            $edit = $value['edit'];
          }else{
            $edit = 0;
          }

          if(isset($value['full'])){
            $full = $value['full'];
          }else{
            $full = 0;
          }

          AdminRole::where('admin_id',$id)->insert(['admin_id'=>$id,'module'=>$key,'view_access'=>$view,'edit_access'=>$edit,'full_access'=>$full]);
        }

        $message = "Roles Updated Successfully";
        return redirect()->back()->with('success_message',$message);
      }
      $adminDetails = Admin::where('id',$id)->first()->toArray();
      $adminRoles = AdminRole::where('admin_id',$id)->get()->toArray();
      $title = "Update ".$adminDetails['name']." (".$adminDetails['type'].") Roles/Permission";
      return view('backend.admin.all-admins.update-role-permission')->with(compact(['adminDetails','title','adminRoles']));
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
            "redirect_url" => route('admin.all_admins'),
          ]);
        }
      }
  
  
      return view('backend.admin.all-admins.update-all-admin-details', compact('all_admin', 'title'));
    }
  
    public function admins()
    {
      
      // echo $type; die;
      // $admins = Admin::query();
    
  
      // if (!empty($type)) {
      //   $admins = $admins->where('type', $type);
        
      //   $title = ucfirst($type) . "s";
        
      // } else {
  
      //   $title = "All Admins/SubAdmins";
      // }
  
  
      if(Auth::guard('admin')->user()->type=="SubAdmin"){
        return redirect()->back()->with('error_message','This Feature is restricted for You');
      }
      // $admins = $admins->get();
      // echo "<pre>";print_r($admins);die;
      $all_admins = Admin::get();
      return view('backend.admin.all-admins.all-admin-index')->with(compact(['all_admins']));
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
}
