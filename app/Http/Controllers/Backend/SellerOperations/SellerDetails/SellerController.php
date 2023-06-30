<?php

namespace App\Http\Controllers\Backend\SellerOperations\SellerDetails;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\SellerBankDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\SellerBussinessDetails;

class SellerController extends Controller
{

  public function dashboard()
  {



    return view('backend.seller.seller-dashboard');
  }
  public function PersonalDetails(Request $request)
  {

    // if ($request->isMethod('post')) {
    //   // $data =  $request->all();
    //   // echo "<pre>";
    //   // print_r($data);
    //   // die;


    //   $custom_message = [
    //     'address.required' => 'Address is Required',


    //   ];

    //   $validator = Validator::make($request->all(), [
    //     'address' => 'required'


    //   ], $custom_message);

    //   if ($validator->fails()) {
    //     return response()->json([
    //       'status' => '0',
    //       'error' => $validator->errors()->toArray()
    //     ]);
    //   } else {




    //     $seller = new Seller();
    //     $seller->address = $request->address;
    //     $seller->city = $request->city;
    //     $seller->state = $request->state;
    //     $seller->gender = $request->gender;
    //     $seller->country = $request->country;
    //     $seller->pincode = $request->pincode;
    //     $seller->phone = $request->phone;

    //     if ($request->hasfile('seller_image')) {
    //       $path = 'uploads/seller/seller_avatar/' . $seller->seller_image;
    //       if (File::exists($path)) {
    //         File::delete($path);
    //       }
    //       $file = $request->file('seller_image');
    //       $extension = $file->getClientOriginalExtension();
    //       $filename = time() . '.' . $extension;
    //       $file->move('uploads/seller/seller_avatar/', $filename);
    //       $seller->seller_image = $filename;
    //     }



    //     $submit = $seller->save();

    //     if ($submit) {
    //       return response()->json([
    //         'status' => '1',
    //         'message' => 'Personal Details Added Successfully! Please wait to Fill Bank Details',
    //         'redirect_url' => route('seller.all-bank-details')
    //       ]);
    //     }
    //   }
    // }
    // return view('seller.all-details.personal-details');



    // if ($request->isMethod('post')) {
    //   $data = $request->all();
    //   //    echo print_r($data);die;

    //   if ($request->hasfile('seller_image')) {
    //     $path = 'uploads/seller/seller_avatar/' . $seller->seller_image;
    //     if (File::exists($path)) {
    //       File::delete($path);
    //     }
    //     $file = $request->file('seller_image');
    //     $extension = $file->getClientOriginalExtension();
    //     $filename = time() . '.' . $extension;
    //     $file->move('uploads/seller/seller_avatar/', $filename);
    //     $seller->seller_image = $filename;
    //   }

    if ($request->isMethod('post')) {
      $data  = $request->all();

      if ($request->hasfile('seller_image')) {
        $sellerImage = Seller::where('id', Auth::guard('seller')->user()->id)->select('seller_image')->first();

        $path = 'uploads/seller/seller_avatar/' . $sellerImage->seller_image;
        if (File::exists($path)) {
          File::delete($path);
        }

        $file = $request->file('seller_image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('uploads/seller/seller_avatar/', $filename);
        // $request->address_proof_image = $filename;
      } elseif (!empty($data['seller_image'])) {
        $filename = $data['seller_image'];
      } else {
        $filename = "";
      }





      $submit = Seller::where('id', Auth::guard('seller')->user()->id)->update(['gender' => $data['gender'], 'name' => $data['name'], 'address' => $data['address'], 'city' => $data['city'], 'state' => $data['state'], 'country' => $data['country'], 'pincode' => $data['pincode'], 'phone' => $data['phone'], 'seller_image' => $filename]);
      // return redirect()->back()->with('success_message', 'Detail Changed Successfully');

      if ($submit) {
        return response()->json([
          'status' => '1',
          'message' => 'Personal Details Added Successfully! Please wait to Fill Bank Details',
          'redirect_url' => route('seller.all-bank-details')
        ]);
      }
    }

    $sellerdetail = Seller::where('email', Auth::guard('seller')->user()->email)->first()->toArray();
    return view('backend.seller.seller-details.seller-personal-details')->with(compact('sellerdetail'));
  }


  public function BussinessDetails(Request $request)
  {

    if ($request->isMethod('post')) {
      $data = $request->all();
      // echo "<pre>";print_r($data);die;




      $sellerCount = SellerBussinessDetails::where('seller_id', Auth::guard('seller')->user()->id)->count();

      if ($sellerCount > 0) {
        if ($request->hasfile('address_proof_image')) {
          $addressProofImage = SellerBussinessDetails::where('seller_id', Auth::guard('seller')->user()->id)->select('address_proof_image')->first();

          $path = 'uploads/seller/address_proof_image/' . $addressProofImage->address_proof_image;
          if (File::exists($path)) {
            File::delete($path);
          }

          $file = $request->file('address_proof_image');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . '.' . $extension;
          $file->move('uploads/seller/address_proof_image/', $filename);
          // $request->address_proof_image = $filename;
        } elseif (!empty($data['address_proof_image'])) {
          $filename = $data['address_proof_image'];
        } else {
          $filename = "";
        }

        $submit = SellerBussinessDetails::where('seller_id', Auth::guard('seller')->user()->id)->update(['shop_name' => $data['shop_name'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'shop_mobile' => $data['shop_mobile'], 'shop_website' => $data['shop_website'], 'shop_email' => $data['shop_email'], 'bussiness_license_number' => $data['bussiness_license_number'], 'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number'], 'address_proof' => $data['address_proof'], 'address_proof_image' => $filename]);
        // return redirect()->back()->with('success_message', 'Detail Changed Successfully');
        if ($submit) {
          return response()->json([
            'status' => '2',
            'message' => 'All Details Updated Successfully! Please wait 24Hrs To Approve your Account! Notification will be sent to your Email',
            'redirect_url' => route('seller.logout')
          ]);
        }
      } else {
        if ($request->hasfile('address_proof_image')) {

          $file = $request->file('address_proof_image');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . '.' . $extension;
          $file->move('uploads/seller/address_proof_image/', $filename);
          // $request->address_proof_image = $filename;
        } elseif (!empty($data['address_proof_image'])) {
          $filename = $data['address_proof_image'];
        } else {
          $filename = "";
        }

        $submit = SellerBussinessDetails::insert(['seller_id' => Auth::guard('seller')->user()->id, 'shop_name' => $data['shop_name'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'shop_mobile' => $data['shop_mobile'], 'shop_website' => $data['shop_website'], 'shop_email' => $data['shop_email'], 'bussiness_license_number' => $data['bussiness_license_number'], 'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number'], 'address_proof' => $data['address_proof'], 'address_proof_image' => $filename]);
        // return redirect()->back()->with('success_message', 'Detail Changed Successfully');
        if ($submit) {
          return response()->json([
            'status' => '2',
            'message' => 'All Details Added Successfully! Please wait 24Hrs To Approve your Account! Notification will be sent to your Email',
            'redirect_url' => route('seller.logout')
          ]);
        }
      }
    }

    return view('backend.seller.seller-details.seller-bussiness-details');
  }

  public function BankDetails(Request $request)
  {
    if ($request->isMethod('post')) {
      $data = $request->all();
      // echo "<pre>";print_r($data);die;

      $sellerCount = SellerBankDetails::where('seller_id', Auth::guard('seller')->user()->id)->count();

      if ($sellerCount > 0) {
        $submit = SellerBankDetails::where('seller_id', Auth::guard('seller')->user()->id)->update(['account_type' => $data['account_type'], 'account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 'bank_ifsc_code' => $data['bank_ifsc_code']]);
        // return redirect()->back()->with('success_message', 'Detail Changed Successfully');
      } else {
        $submit = SellerBankDetails::insert(['seller_id' => Auth::guard('seller')->user()->id, 'account_type' => $data['account_type'], 'account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 'bank_ifsc_code' => $data['bank_ifsc_code']]);
        // return redirect()->back()->with('success_message', 'Detail Changed Successfully');
      }



      if ($submit) {
        return response()->json([
          'status' => '1',
          'message' => 'Bank Details Added Successfully! Please wait to Fill Bussiness Details',
          'redirect_url' => route('seller.all-bussiness-details')
        ]);
      }
    }
    return view('backend.seller.seller-details.seller-bank-details');
  }

  public function updateSellerprofile(Request $request)
  {
    $tabId = $request->input('tab');


    if ($tabId == 'profilepic') {


      if ($request->isMethod('post')) {
        $data = $request->all();
        //  echo "<pre>";print_r($data);die;

        if ($request->hasfile('seller_image')) {
          $sellerImage = Seller::where('id', Auth::guard('seller')->user()->id)->select('seller_image')->first();

          $path = 'uploads/seller/seller_avatar/' . $sellerImage->seller_image;
          if (File::exists($path)) {
            File::delete($path);
          }

          $file = $request->file('seller_image');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . '.' . $extension;
          $file->move('uploads/seller/seller_avatar/', $filename);
          // $request->address_proof_image = $filename;
        } elseif (!empty($data['seller_image'])) {
          $filename = $data['seller_image'];
        } else {
          $filename = "";
        }

        $submit = Seller::where('id', Auth::guard('seller')->user()->id)->update(['seller_image' => $filename]);
        if ($submit) {
          return response()->json([
            'status' => '1',
            'message' => 'Profile Picture Changed Successfully!',
            'redirect_url' => route('seller.profile')
          ]);
        }
      }
    }

    if ($tabId == 'personal') {

      if ($request->isMethod('post')) {
        $data = $request->all();
        Seller::where('id', Auth::guard('seller')->user()->id)->update(['gender' => $data['gender'], 'name' => $data['name'], 'address' => $data['address'], 'city' => $data['city'], 'state' => $data['state'], 'country' => $data['country'], 'pincode' => $data['pincode'], 'phone' => $data['phone']]);
        return redirect()->back()->with('success_message', 'Personal Details Updated Successfully');
        // if ($submit) {
        //   return response()->json([
        //     'status' => '1',
        //     'message' => 'Personal Details Updated Successfully!',
        //     'redirect_url' => route('seller.profile')
        //   ]);
        // }
      }
    } elseif ($tabId == 'bussiness') {

      if ($request->isMethod('post')) {
        $data = $request->all();
        SellerBussinessDetails::where('seller_id', Auth::guard('seller')->user()->id)->update(['shop_name' => $data['shop_name'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'shop_mobile' => $data['shop_mobile'], 'shop_website' => $data['shop_website'], 'shop_email' => $data['shop_email'], 'bussiness_license_number' => $data['bussiness_license_number'], 'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number'], 'address_proof' => $data['address_proof']]);
        return redirect()->back()->with('success_message', 'Bussiness Detail Updated SuccessFully');
        // if ($submit) {
        //   return response()->json([
        //     'status' => '2',
        //     'message' => 'Bussiness Detail Updated SuccessFully',
        //     'redirect_url' => route('seller.profile')
        //   ]);
        // }
      }
    } else if ($tabId == 'bank') {
      if ($request->isMethod('post')) {
        $data = $request->all();
        $submit = SellerBankDetails::where('seller_id', Auth::guard('seller')->user()->id)->update(['account_type' => $data['account_type'], 'account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 'bank_ifsc_code' => $data['bank_ifsc_code']]);
        return redirect()->back()->with('success_message', 'Bank Details Updated Successfully');
        // return response()->json([
        //   'status' => '1',
        //   'message' => 'Bank Details Updated Successfully',
        //   'redirect_url' => route('seller.profile')
        // ]);
      }
    }


    $sellerPersonalDetails = Seller::where('email', Auth::guard('seller')->user()->email)->first();
    $sellerBussinessDetails = SellerBussinessDetails::where('seller_id', Auth::guard('seller')->user()->id)->first();
    $sellerBankDetails = SellerBankDetails::where('seller_id', Auth::guard('seller')->user()->id)->first();
    return view('backend.seller.seller-details.seller-profile')->with(compact(['sellerPersonalDetails', 'sellerBussinessDetails', 'sellerBankDetails']));
  }
}
