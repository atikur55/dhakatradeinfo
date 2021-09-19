<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use Auth; 
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class StateController extends Controller
{
    public function create()
    {
        $all_country = Country::where('status',0)->orderBy('country_name')->get();
        return view('admin.state.create',compact('all_country'));
    }
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'country_id' => 'required',
            'state_name' => 'required',
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
            State::insert([
                'country_id' => $request->country_id,
                'state_name' => $request->state_name,
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
        $all_state = State::orderBy('id','desc')->get();
        $all_country = Country::where('status',0)->orderBy('country_name')->get();
        return view('admin.state.view',compact('all_state','all_country'));
    }
    public function status($id)
    {
        $data = State::find($id);
        if ($data->status == 0) 
        {
            State::where('id',$id)->update([
                'status' => 1,
           ]);
           return response()->json([
               'status' => 200,
               'message' => 'Status Change Successfully',
           ]);
        } 
        else 
        {
            State::where('id',$id)->update([
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
            'state_name' => 'required',
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
            State::where('id',$request->id)->update([
                'country_id' => $request->country_id,
                'state_name' => $request->state_name,
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
        $data = State::find($id);
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
}
