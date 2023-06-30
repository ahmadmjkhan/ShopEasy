<?php

namespace App\Http\Controllers\Backend\AdminOperations\ShippingCharges;

use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use App\Http\Controllers\Controller;

class ShippingChargeController extends Controller
{
    public function shippingchargeindex()
    {
        $all_charges = ShippingCharge::get()->toArray();
        return view('backend.admin.shipping-charges.shipping-charge-index')->with(compact('all_charges'));
    }

    public function updateShippingChargestatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();


            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            ShippingCharge::where('id', $data['charge_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'charge_id' => $data['charge_id']]);
        }
    }

    public function AddEditShippingChargesImages($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $submit = ShippingCharge::where('id', $id)->update(['0_500g' => $data['0_500g'], '501_1000g' => $data['501_1000g'], '1001_2000g' => $data['1001_2000g'], '2001_5000g' => $data['2001_5000g'], 'above_5000g' => $data['above_5000g']]);

            if ($submit) {
                return response()->json([
                    'status' => '1',
                    'message' => 'Shipping Charge Updated Successfully',
                    "redirect_url" => route('admin.shipping-charges'),
                ]);
            }

            // $message = "Shipping Charges Updated Successfully";
            // return redirect()->back()->with('success_message', $message);

        }

        $shippingchargedetails = ShippingCharge::where('id', $id)->first()->toArray();

        $title = "Edit Shipping Charges";
        return view('backend.admin.shipping-charges.add-edit-shipping-charges')->with(compact('shippingchargedetails', 'title'));
    }

    public function delete_shipping_charge($id)
    {

        $shippingcharge = ShippingCharge::find($id);

       

        $submit = $shippingcharge->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Shipping Charge Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }
}
