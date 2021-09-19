<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\PoliceStation;
use App\Models\Supplier;
use App\Models\User;
use Image;
use Hash;
use Mail;
use App\Mail\SupplierRegistration;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SupplierRegisterController extends Controller
{
    public function index()
    {
        $all_country = Country::orderBy('country_name')->get();
        return view('frontend.supplier.register',compact('all_country')); 
    }
    public function post(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'password' => 'required',
            'company_name' => 'required',
            'company_logo' => 'mimes:jpg,jpeg,png|max:1024',
            'image' => 'mimes:jpg,jpeg,png|max:1024',
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
            $user_id = User::insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_type' => 'supplier',
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
            ]);
            if ($request->hasFile('image')) 
            {
                $upload_logo_photo = $request->file('image');
                $new_upload_logo_photo_name = $user_id.'.'.$upload_logo_photo->extension();
                $new_logo_photo_location = base_path('public/uploads/profile/').$new_upload_logo_photo_name;
                Image::make($upload_logo_photo)->save($new_logo_photo_location);
                User::find($user_id)->update([
                    'image' => $new_upload_logo_photo_name,
                ]);
            }

            $supplier_id = Supplier::insertGetId([
                'user_id' => $user_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'national_id' => $request->national_id,
                'trade_licence' => $request->trade_licence,
                'company_name' => $request->company_name,
                'country' => $request->country,
                'state' => $request->state,
                'policeStation' => $request->policeStation,
                'created_at' => Carbon::now(),
            ]);
    
            if ($request->hasFile('company_logo')) 
            {
                $upload_logo_photo = $request->file('company_logo');
                $new_upload_logo_photo_name = $supplier_id.'.'.$upload_logo_photo->extension();
                $new_logo_photo_location = base_path('public/uploads/company/').$new_upload_logo_photo_name;
                Image::make($upload_logo_photo)->save($new_logo_photo_location);
                Supplier::find($supplier_id)->update([
                    'company_logo' => $new_upload_logo_photo_name,
                ]);
            }
            if ($request->hasFile('company_cover_image')) 
            {
                $upload_logo_photo = $request->file('company_cover_image');
                $new_upload_logo_photo_name = $supplier_id.'.'.$upload_logo_photo->extension();
                $new_logo_photo_location = base_path('public/uploads/company_cover/').$new_upload_logo_photo_name;
                Image::make($upload_logo_photo)->save($new_logo_photo_location);
                Supplier::find($supplier_id)->update([
                    'company_cover_image' => $new_upload_logo_photo_name,
                ]);
            }
            Mail::to($request->email)->send(new SupplierRegistration);


            return response()->json([
                'status' => 200,
                'message' => 'Supplier Registration Successfully',
            ]);
        }
    }
    public function getStateList($id)
    {
        $states = State::where('country_id',$id)->get();
        return response()->json($states);
    }
    public function getCityList($id)
    {
        $policeStation = PoliceStation::where('state_id',$id)->get();
        return response()->json($policeStation);
    }
}
