<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;
use Auth;
use Hash;
use Image;
use Brian2694\Toastr\Facades\Toastr;

class ProfileController extends Controller
{
    public function profile()
    {
        $supplier = Supplier::where('user_id',Auth::id())->first();
        return view('profile.profile',compact('supplier'));
    }
    public function update_customer_info(Request $request)
    {
        $get_image = User::find($request->id);
        $request->all();
       
        if ($request->hasFile('image')) {

          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/profile/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/profile/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        $get_image->name = $request->name;
        $get_image->email = $request->email;
        $get_image->phone = $request->phone;
        $get_image->created_at = Carbon::now();
        $get_image->save();
        
        Toastr::success('Profile Update successfully :)','Success');
        return back();
    }
    public function update_supplier_info(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_logo' => 'mimes:jpeg,jpg,png,gif|required|max:1024',
        ]);

        $supplier_id = Supplier::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_name' => $request->company_name,
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


        $get_image = User::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {

          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/profile/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/profile/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        $get_image->name = $request->name;
        $get_image->email = $request->email;
        $get_image->phone = $request->phone;
        $get_image->created_at = Carbon::now();
        $get_image->save();
        
        Toastr::success('Profile Update successfully :)','Success');
        return back();

    }
    public function password_change()
    {
        return view('profile.password_change');
    }
    public function password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
        ]);

        $id = Auth::user()->id;
        $db_pass = Auth::user()->password;
        $old_pass = $request->old_password;
        $new_pass = $request->password;
        $confirm_pass = $request->password_confirmation;


        if(Hash::check($old_pass,$db_pass)){

            if ($new_pass === $confirm_pass)
            {
                User::find($id)->update([
                   'password'=> Hash::make($request->password)
                ]);
                Auth::logout();
                return redirect('login')->with('status','password updated successfully');

            }
            else{
                return redirect()->back()->with('error','new password and confirm password not matched ');
             
            }

        }
        else{
            return redirect()->back()->with('error','old password doesnt matched ');
             
        }
        

    }
}
