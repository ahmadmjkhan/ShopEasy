<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductsFilterValues;
use Illuminate\Support\Facades\View;

class FilterController extends Controller
{
    public function filter_index()
    {
        $all_filters = ProductsFilter::get();
        
        return view('admin.filters.filter-index')->with(compact('all_filters'));
    }

    public function filter_values_index()
    {
        $all_filters_values = ProductsFilterValues::get();

        return view('admin.filters.filter-value-index')->with(compact('all_filters_values'));
    }

    public function updatefiterstatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsFilter::where('id', $data['filter_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'filter_id' => $data['filter_id']]);
        }
    }

    public function updatefiltervaluestatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsFilterValues::where('id', $data['filter_value_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'filter_value_id' => $data['filter_value_id']]);
        }
    }

    public function Add_Edit_Filter(Request $request, $id = null)
    {

        if ($id == '') {
            $title = 'Add Filters Column';
            $message = "Filter Added Successfully";
            $filters = new ProductsFilter();
        } else {
            $title = "Edit Filters Column";
            $filters = ProductsFilter::find($id);
            $message = "Filters Updated Successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre";print_r($data);die;

            $cat_ids = implode(',', $request->cat_ids);
            $filters->cat_ids = $cat_ids;
            $filters->filter_name = $request->filter_name;
            $filters->filter_column = $request->filter_column;
            $filters->status = $request->status == TRUE ? '1' : '0';
            $filters->save();


            if(!empty($filters->filter_column)){
            DB::statement('Alter table products add ' . $request->filter_column . ' varchar(255) after is_bestseller');
            }

            return response()->json([
                'status' => '1',
                'message' => $message,
                "redirect_url" => route('admin.filter_index'),
            ]);




            // return redirect()->route('filters.index');

        }

        $categories = Section::with('categories')->get();
        return view('admin.filters.add-edit-filters')->with(compact('title', 'categories', 'filters'));
    }

    public function Add_Edit_Filter_Values(Request $request, $id = null)
    {

        if ($id == '') {
            $title = 'Add Filters Values';
            $message = "Filter Value Added Successfully";
            $filtersvalue = new ProductsFilterValues();
        } else {
            $title = "Edit Filters Values";
            $filtersvalue = ProductsFilterValues::find($id);
            $message = "Filters Value Updated Successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre";print_r($data);die;


            $filtersvalue->filter_id = $request->filter_id;
            $filtersvalue->filter_value = $request->filter_value;
            $filtersvalue->status = $request->status == TRUE ? '1' : '0';
            $submit = $filtersvalue->save();



            if ($submit) {
                return response()->json([
                    'status' => '1',
                    'message' => $message,
                    "redirect_url" => route('admin.filter_values_index'),
                ]);
            }




            // return redirect()->route('filters.index');

        }

        $filters = ProductsFilter::where('status',1)->get();
        // dd($filters);
        return view('admin.filters.add-edit-filter-values')->with(compact('title','filtersvalue','filters'));
    }

    public function delete_filter($id)
    {

        $filter = ProductsFilter::find($id);

        

        $submit = $filter->delete();
        DB::statement('ALTER TABLE products DROP ' . $filter->filter_column);
        if ($submit) {

            
            return response()->json([
                'status' => '1',
                'message' => 'Filter Deleted Successfully',
            ]);

           
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }

    public function delete_filter_values($id)
    {

        $filtervalues = ProductsFilterValues::find($id);

        

        $submit = $filtervalues->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Filter Values Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }


    // used for to get filter on select categories during adding products//
    public function categoryFilters(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $category_id = $data['category_id'];
            return response()->json([
                'view'=>(String)View::make('admin.filters.category-filter')->with(compact('category_id')),
            ]);
        }
    }


    public function deletecategoryFilters($id){
        $filter = ProductsFilter::find($id);

       

        $submit = $filter->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Filter Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }
}
