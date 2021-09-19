<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\BusinessType;
use Auth;
use Carbon\Carbon;
use Image;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    public function view()
    {
        $all_category =  Category::orderBy('id','desc')->get();
        $all_business = BusinessType::where('status',0)->get();
        return view('admin.category.view',compact('all_category','all_business'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
            'business_id' => 'required',
            'image' => 'mimes:jpg,jpeg,png|required|max:1024',
        ]);

        $logo_id = Category::insertGetId([
            'added_by' => Auth::id(),
            'category_name' => $request->category_name,
            'business_id' => $request->business_id,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) 
        {
            $upload_logo_photo = $request->file('image');
            $new_upload_logo_photo_name = $logo_id.'.'.$upload_logo_photo->extension();
            $new_logo_photo_location = base_path('public/uploads/category/').$new_upload_logo_photo_name;
            Image::make($upload_logo_photo)->save($new_logo_photo_location);
            Category::find($logo_id)->update([
                'image' => $new_upload_logo_photo_name,
            ]);
        }

        Toastr::success('Category Add successfully :)','Success');
        return back();

    }
    
    public function delete($id)
    {
        $data = Category::find($id);
        $image = base_path('public/uploads/category/'.$data->image);;

        if ($image) {
            unlink($image);
            $data->delete();
        }
        else
        {
            $data->delete();
        }
        Toastr::success('Category Delete successfully :)','Success');
        return back();
    }
    public function status($id)
    {
        $data = Category::find($id);
        if ($data->status == 0) 
        {
           Category::where('id',$id)->update([
                'status' => 1,
           ]);
        } 
        else 
        {
            Category::where('id',$id)->update([
                'status' => 0,
            ]);
        }

        Toastr::success('Status Change successfully :)','Success');
        return back();
        
    }
    public function update(Request $request)
    {
        $get_image = Category::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {
          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/category/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/category/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        $get_image->category_name = $request->category_name;
        $get_image->business_id = $request->business_id;
        $get_image->added_by = Auth::id();
        $get_image->created_at = Carbon::now();
        $get_image->save();
        
        Toastr::success('Category Update successfully :)','Success');
        return back();
    }
}
