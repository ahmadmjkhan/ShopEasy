<?php

namespace App\Http\Controllers\Backend\AdminOperations\Sections;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    public function section_index()
    {
        $all_section = Section::all();
        return view('backend.admin.catalogue-management.sections.section-index', compact('all_section'));
    }




    public function Add_Edit_Sections(Request $request, $id = null)  // for ADD-EDIT IN ONE TEMPLATE //
    {
        if ($id == "") {
            $title = "Add Section";
            $message = "Section Added Successfully";
            $section  = new Section();
        } else {
            $title = "Edit Section";
            $message = "Section Updated Successfully";
            $section = Section::find($id);
        }



        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'section_name' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                if ($request->hasFile('section_image')) {
                    $path = 'uploads/catalogue-images/sections/' . $section->section_image;

                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('section_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/catalogue-images/sections/', $filename);
                    $section->section_image = $filename;
                }


                $section->section_name = $request->section_name;

                $section->status = $request->status == TRUE ? '1' : '0';
                
                $submit = $section->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => $message,
                        "redirect_url" => route('admin.section_index'),
                    ]);
                }
            }
        }

        return view('backend.admin.catalogue-management.sections.add-edit-section')->with(compact('title', 'section'));
    }


    public function updatesectionstatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }


    public function delete_section($id)
    {

        $section = Section::find($id);

        if ($section->section_image) {
            $path = 'uploads/catalogue-images/sections/' . $section->section_image;

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $submit = $section->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Section Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }


    public function deleteAllSection(Request $request)
    {
        $data = $request->all();

        $ids = $data['ids'];
        //    DB::table('brands')->whereIn('id',explode(",",$ids))->delete();
        Section::whereIn('id', explode(",", $ids))->delete();
        return response()->json([
            'status' => '1',
            'message' => 'Section Deleted Successfully',
            "redirect_url" => route('admin.section_index'),
        ]);
    }
}
