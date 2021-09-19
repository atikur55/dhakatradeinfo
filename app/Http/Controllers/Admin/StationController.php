<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\PoliceStation;
use Auth; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class StationController extends Controller
{
    public function create()
    {
        $all_country = Country::where('status',0)->orderBy('country_name')->get();

        return view('admin.station.create',compact('all_country'));
    }
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'country_id' => 'required',
            'state_id' => 'required',
            'police_station' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } 
        else 
        {
            PoliceStation::insert([
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'police_station' => $request->police_station,
                'created_at' => Carbon::now(),
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Data Added Successfully',
            ]);
        }
        
    }
    public function list()
    {
        $all_station = PoliceStation::orderBy('id','desc')->get();
        $all_country = Country::where('status',0)->orderBy('country_name')->get();
        return view('admin.station.view',compact('all_station','all_country'));
    }
    public function status($id)
    {
        $data = PoliceStation::find($id);
        if ($data->status == 0) 
        {
            PoliceStation::where('id',$id)->update([
                'status' => 1,
           ]);
           return response()->json([
               'status' => 200,
               'message' => 'Status Change Successfully',
           ]);
        } 
        else 
        {
            PoliceStation::where('id',$id)->update([
                'status' => 0,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Status Change Successfully',
            ]);
        }
        
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'country_id' => 'required',
            'state_id' => 'required',
            'police_station' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } 
        else 
        {
            PoliceStation::where('id',$request->id)->update([
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'police_station' => $request->police_station,
                'created_at' => Carbon::now(),
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Data Updated Successfully',
            ]);
        }
    }
    public function delete($id)
    {
        $data = PoliceStation::find($id);
        if($data)
        {
            $data->delete();
            return response()->json([
                'status' => 200,
                'message' => 'State Delete Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 400,
                'message' => 'Data Not Found',
            ]);
        }
    }
    public function stateName($id)
    {
        $states = State::where('country_id',$id)->get();
        return response()->json($states);
    }
}
