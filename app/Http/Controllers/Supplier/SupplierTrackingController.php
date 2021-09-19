<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tracking;
use Carbon\Carbon;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class SupplierTrackingController extends Controller
{
    public function tracking_post(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'order_status' => 'required',
        ]);

        Tracking::insert([
            'added_by' => Auth::id(),
            'order_id' => $request->order_id,
            'track_no' => $request->track_no,
            'icon' => $request->icon,
            'order_status' => $request->order_status,
            'description' => $request->description,
            'expect_date' => $request->expect_Date,
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('Tracking Add successfully :)','Success');
        return back();
    }
}
