<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Hash;
use Auth;
use Image;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class CountryController extends Controller
{
    public function create()
    {
        return view('admin.country.create');
    }
    public function post(Request $request)
    {
        $request->validate([
            // 'template_category_id' => 'required',
            'country_name' => 'required',
            // 'image' => 'mimes:jpeg,jpg,png,gif|required|max:1024',
        ]);

        $supplier_id = Country::insertGetId([
            'user_id' => Auth::id(),
            'country_name' => $request->country_name,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) 
        {
            $upload_logo_photo = $request->file('image');
            $new_upload_logo_photo_name = $supplier_id.'.'.$upload_logo_photo->extension();
            $new_logo_photo_location = base_path('public/uploads/country/').$new_upload_logo_photo_name;
            Image::make($upload_logo_photo)->save($new_logo_photo_location);
            Country::find($supplier_id)->update([
                'image' => $new_upload_logo_photo_name,
            ]);
        }

        Toastr::success('Country Add successfully :)','Success');
        return back();

    }
    public function list()
    {
        $datas = Country::orderBy('id','desc')->get();
        return view('admin.country.view',compact('datas'));
    }
    public function status($id)
    {
        $data = Country::find($id);
        if ($data->status == 0) 
        {
            Country::where('id',$id)->update([
                'status' => 1,
           ]);
        } 
        else 
        {
            Country::where('id',$id)->update([
                'status' => 0,
            ]);
        }

        Toastr::success('Country Status Change successfully :)','Success');
        return back();
    }
    public function delete($id)
    {
        $data = Country::find($id);
        $image = base_path('public/uploads/country/'.$data->image);;

        if ($image) {
            unlink($image);
            $data->delete();
        }
        else
        {
            $data->delete();
        }
        Toastr::success('Template Delete successfully :)','Success');
        return back();
    }
    public function edit($id)
    {
        $data = TempCountrylate::where('id',$id)->first();
        $temps = TemplateCategory::where('status',0)->get();
        return view('admin.template.edit',compact('data','temps'));
    }

    public function update(Request $request)
    {
        $get_image = Country::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {
          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/country/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/country/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        $get_image->country_name = $request->country_name;
        $get_image->user_id = Auth::id();
        $get_image->created_at = Carbon::now();
        $get_image->save();  
        Toastr::success('Country Update successfully :)','Success');
        return back();
    }
}
