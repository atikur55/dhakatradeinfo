<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Auth;
use Carbon\Carbon;
use Image;
use Brian2694\Toastr\Facades\Toastr;

class ChildCategoryController extends Controller
{
    public function view()
    {
        $all_category =  Category::where('status',0)->get();
        $childcategories = ChildCategory::orderBy('id','desc')->get();
        return view('admin.childcategory.view',compact('all_category','childcategories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpg,jpeg,png|required|max:1024',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'title' => 'required',
        ]);

        $logo_id = ChildCategory::insertGetId([
            'added_by' => Auth::id(),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'title' => $request->title,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) 
        {
            $upload_logo_photo = $request->file('image');
            $new_upload_logo_photo_name = $logo_id.'.'.$upload_logo_photo->extension();
            $new_logo_photo_location = base_path('public/uploads/childcategory/').$new_upload_logo_photo_name;
            Image::make($upload_logo_photo)->save($new_logo_photo_location);
            ChildCategory::find($logo_id)->update([
                'image' => $new_upload_logo_photo_name,
            ]);
        }

        Toastr::success('ChildCategory Add successfully :)','Success');
        return back();

    }
    
    public function delete($id)
    {
        $data = ChildCategory::find($id);
        $image = base_path('public/uploads/childcategory/'.$data->image);;

        if ($image) {
            unlink($image);
            $data->delete();
        }
        else
        {
            $data->delete();
        }
        Toastr::success('Child-Category Delete successfully :)','Success');
        return back();
    }
    public function status($id)
    {
        $data = ChildCategory::find($id);
        if ($data->status == 0) 
        {
           ChildCategory::where('id',$id)->update([
                'status' => 1,
           ]);
        } 
        else 
        {
            ChildCategory::where('id',$id)->update([
                'status' => 0,
            ]);
        }

        Toastr::success('Status Change successfully :)','Success');
        return back();
        
    }
    public function edit($id)
    {
        $childcategory = ChildCategory::find($id);
        $all_category =  Category::where('status',0)->get();
        return view('admin.childcategory.edit',compact('childcategory','all_category'));
    }
    public function update(Request $request)
    {
        $get_image = ChildCategory::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {
          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/childcategory/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/childcategory/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        $get_image->category_id = $request->category_id;
        $get_image->subcategory_id = $request->subcategory_id;
        $get_image->title = $request->title;
        $get_image->added_by = Auth::id();
        $get_image->created_at = Carbon::now();
        $get_image->save();
        
        Toastr::success('Child-Category Update successfully :)','Success');
        return back();
    }
    public function findCityWithStateID($id)
    {
        $city = SubCategory::where('category_id',$id)->get();
        return response()->json($city);
    }
}
