<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;
use Carbon\Carbon;
use Image;
use Brian2694\Toastr\Facades\Toastr;

class SubCategoryController extends Controller
{
    public function view()
    {
        $all_category =  Category::where('status',0)->get();
        $all_subcategory =  SubCategory::orderBy('id','desc')->get();
        return view('admin.subcategory.view',compact('all_category','all_subcategory'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:jpg,jpeg,png|required|max:1024',
        ]);

        $logo_id = SubCategory::insertGetId([
            'added_by' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) 
        {
            $upload_logo_photo = $request->file('image');
            $new_upload_logo_photo_name = $logo_id.'.'.$upload_logo_photo->extension();
            $new_logo_photo_location = base_path('public/uploads/subcategory/').$new_upload_logo_photo_name;
            Image::make($upload_logo_photo)->save($new_logo_photo_location);
            SubCategory::find($logo_id)->update([
                'image' => $new_upload_logo_photo_name,
            ]);
        }

        Toastr::success('SubCategory Add successfully :)','Success');
        return back();

    }
    
    public function delete($id)
    {
        $data = SubCategory::find($id);
        $image = base_path('public/uploads/subcategory/'.$data->image);;

        if ($image) {
            unlink($image);
            $data->delete();
        }
        else
        {
            $data->delete();
        }
        Toastr::success('SubCategory Delete successfully :)','Success');
        return back();
    }
    public function status($id)
    {
        $data = SubCategory::find($id);
        if ($data->status == 0) 
        {
           SubCategory::where('id',$id)->update([
                'status' => 1,
           ]);
        } 
        else 
        {
            SubCategory::where('id',$id)->update([
                'status' => 0,
            ]);
        }

        Toastr::success('Status Change successfully :)','Success');
        return back();
        
    }
    public function update(Request $request)
    {
        $get_image = SubCategory::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {
          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/subcategory/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/subcategory/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        $get_image->category_id = $request->category_id;
        $get_image->title = $request->title;
        $get_image->added_by = Auth::id();
        $get_image->created_at = Carbon::now();
        $get_image->save();
        
        Toastr::success('Sub-Category Update successfully :)','Success');
        return back();
    }
}
