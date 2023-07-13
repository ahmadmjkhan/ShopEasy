<?php

namespace App\Http\Controllers\Backend\AdminOperations\RatingController;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rating_index(){
            $ratings = Rating::with(['user','product'])->get()->toArray();

            return view('backend.admin.ratings.rating-index')->with(compact('ratings'));
    }

    public function updateratingstatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Rating::where('id', $data['rating_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'rating_id' => $data['rating_id']]);
        }
    }
}
