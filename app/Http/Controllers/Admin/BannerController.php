<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banners;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class BannerController extends Controller
{
    public function banner_index()
    {

        $all_banners = Banners::get();
        return view('admin.banners.banner-index')->with(compact('all_banners'));
    }


    public function updatebannerstatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Banners::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }


    public function Add_Edit_Banners(Request $request, $id = null)
    {
        if ($id == '') {
            
            $title = "Add Banner";
            $message = "Banner Added Successfully";
            $banners = new Banners();
        } else {
            $title = "Edit Banner";
            $message = "Banner Updated Successfully";
            $banners = Banners::find($id);
        }

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'alt' => 'required',

                
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {


                if($request->type == "Slider"){
                    $width = "1920";
                    $height = "720";
                }else if($request->type == "Fix"){
                    $width = "1920";
                    $height = "450";

                }

                if ($request->hasFile('banner_image')) {
                    $path = 'uploads/images/banners/' . $banners->banner_image;

                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    
                    $file = $request->file('banner_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;

                    $bannerpath = 'uploads/images/banners/' . $filename;

                    Image::make($file)->resize($width,$height)->save($bannerpath);
                    
                    $banners->banner_image = $filename;
                }

                $banners->type = $request->type;
                $banners->link = $request->link;
                $banners->title = $request->title;
                $banners->alt = $request->alt;
               
                $banners->status = $request->status == TRUE ? '1' : '0';
               
                $submit = $banners->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => $message,
                        "redirect_url"=>route('admin.banner_index'),
                    ]);
                }
            }
        }

        
        $allbanner = Banners::where('status',1)->get();
        return view('admin.banners.add-edit-banner')->with(compact('banners','title','message','allbanner'));
    }


    public function delete_banner($id)
    {

        $banner = Banners::find($id);

        if ($banner->banner_image) {
            $path = 'uploads/images/banners/' . $banner->banner_image;

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $submit = $banner->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Banner Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }
}
