<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Template;
use App\Models\TemplateCategory;
use Hash;
use Auth;
use Image;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class TemplateCreateController extends Controller
{
    public function template_create()
    {
        $datas = TemplateCategory::where('status',0)->get();
        return view('admin.template.create',compact('datas'));
    }
    public function template_post(Request $request)
    {
        $request->validate([
            // 'template_category_id' => 'required',
            'template_url' => 'required',
            // 'image' => 'mimes:jpeg,jpg,png,gif|required|max:1024',
        ]);

        $supplier_id = Template::insertGetId([
            'user_id' => Auth::id(),
            'template_category_id' => $request->template_category_id,
            'template_url' => $request->template_url,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) 
        {
            $upload_logo_photo = $request->file('image');
            $new_upload_logo_photo_name = $supplier_id.'.'.$upload_logo_photo->extension();
            $new_logo_photo_location = base_path('public/uploads/template/').$new_upload_logo_photo_name;
            Image::make($upload_logo_photo)->save($new_logo_photo_location);
            Template::find($supplier_id)->update([
                'image' => $new_upload_logo_photo_name,
            ]);
        }

        Toastr::success('Template Add successfully :)','Success');
        return back();

    }
    public function template_list()
    {
        $datas = Template::orderBy('id','desc')->get();
        return view('admin.template.view',compact('datas'));
    }
    public function template_status($id)
    {
        $data = Template::find($id);
        if ($data->status == 0) 
        {
           Template::where('id',$id)->update([
                'status' => 1,
           ]);
        } 
        else 
        {
            Template::where('id',$id)->update([
                'status' => 0,
            ]);
        }

        Toastr::success('Template Status Change successfully :)','Success');
        return back();
    }
    public function template_delete($id)
    {
        $data = Template::find($id);
        $image = base_path('public/uploads/template/'.$data->image);;

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
    public function template_edit($id)
    {
        $data = Template::where('id',$id)->first();
        $temps = TemplateCategory::where('status',0)->get();
        return view('admin.template.edit',compact('data','temps'));
    }

    public function template_update(Request $request)
    {
        $get_image = Template::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {
          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/template/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/template/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        $get_image->template_category_id = $request->template_category_id;
        $get_image->template_url = $request->template_url;
        $get_image->user_id = Auth::id();
        $get_image->created_at = Carbon::now();
        $get_image->save();  
        Toastr::success('Template Update successfully :)','Success');
        return back();
    }
}
