<?php

namespace App\Http\Controllers\Backend\AdminOperations\Banners;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function banner_index()
    {

        $all_banners = Banner::get();
        return view('backend.admin.catalogue-management.banners.banner-index')->with(compact('all_banners'));
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

            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }


    public function Add_Edit_Banners(Request $request, $id = null)
    {
        if ($id == '') {

            $title = "Add Banner";
            $message = "Banner Added Successfully";
            $banners = new Banner();
        } else {
            $title = "Edit Banner";
            $message = "Banner Updated Successfully";
            $banners = Banner::find($id);
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


                if ($request->type == "Slider") {
                    $width = "1920";
                    $height = "720";
                } else if ($request->type == "Fix") {
                    $width = "1920";
                    $height = "450";
                }

                if ($request->hasFile('banner_image')) {
                    $path = 'uploads/catalogue-images/banners/' . $banners->banner_image;

                    if (File::exists($path)) {
                        File::delete($path);
                    }


                    $file = $request->file('banner_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;

                    $bannerpath = 'uploads/catalogue-images/banners/' . $filename;

                    Image::make($file)->resize($width, $height)->save($bannerpath);

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
                        "redirect_url" => route('admin.banner_index'),
                    ]);
                }
            }
        }


        $allbanner = Banner::where('status', 1)->get();
        return view('backend.admin.catalogue-management.banners.add-edit-banner')->with(compact('banners', 'title', 'message', 'allbanner'));
    }


    public function delete_banner($id)
    {

        $banner = Banner::find($id);

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

    public function deleteallbanners(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $ids = $data['ids'];
        $banner = explode(",", $ids);


        foreach ($banner as $id) {
            $banners = Banner::find($id);
            // echo "<pre>";print_r($cat);die;

            if ($banners) {
                $banners->delete();

                if ($banners->banner_image) {
                    $path = 'uploads/catalogue-images/banners/' . $banners->banner_image;

                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }
        }
        return response()->json([
            'status' => '1',
            'message' => 'Banner Deleted Successfully',
            "redirect_url" => route('admin.banner_index'),
        ]);
    }
}
