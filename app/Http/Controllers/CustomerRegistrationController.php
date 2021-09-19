<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Image;
use Redirect;
use Mail;
use Hash;
use Brian2694\Toastr\Facades\Toastr;

class CustomerRegistrationController extends Controller
{
    public function register_form()
    {
        return view('frontend.customer_register');
    }
    public function register_post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);
        if ($request->password == $request->password_confirmation) 
        {
            $user_id = User::insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_type' => 'customer',
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
            \Mail::send('email.supplier_register', array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'subject' => 'Customer Registration',
                'user_query' => 'Congratulation! Your registration has been completed Successfully.',
            ), function($message) use ($request){
                $message->from('uitdeveloper2021@gmail.com');
                $message->to(['uitdeveloper2021@gmail.com','dhakatradeinfobd@gmail.com',$request->email])->subject('Customer Registration');
            });
            Toastr::success('Registration Successfully Completed :)','error');
            return \Redirect::route('custom.login');

        } 
        else 
        {
            Toastr::error('Sorry! Your Password & Confirm Password Does not Match :)','error');
            return back();
        }
        
       
        
        
    }
}
