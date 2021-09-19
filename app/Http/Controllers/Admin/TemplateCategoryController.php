<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\TemplateCategory;
use App\Models\User;
use Hash;
use Auth;
use Image;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class TemplateCategoryController extends Controller
{
    public function template_category_create()
    {
        return view('admin.template_category.create');
    }
    public function template_category_post(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'status' => 'required',
        ]);

        TemplateCategory::create([
            'user_id' => Auth::id(),
            'category_name' => $request->category_name,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);

        Toastr::success('TemplateCategory Add successfully :)','Success');
        return back();

    }
    public function template_category_list()
    {
        $datas = TemplateCategory::orderBy('id','desc')->get();
        return view('admin.template_category.view',compact('datas'));
    }
    public function template_category_status($id)
    {
        $data = TemplateCategory::find($id);
        if ($data->status == 0) 
        {
           TemplateCategory::where('id',$id)->update([
                'status' => 1,
           ]);
        } 
        else 
        {
            TemplateCategory::where('id',$id)->update([
                'status' => 0,
            ]);
        }

        Toastr::success('Template Category Status Change successfully :)','Success');
        return back();
    }
    public function template_category_delete($id)
    {
        $data = TemplateCategory::find($id);
        $data->delete();
        Toastr::success('TemplateCategory Delete successfully :)','Success');
        return back();
    }
    public function template_category_edit($id)
    {
        $supplier = TemplateCategory::where('id',$id)->first();
        return view('admin.template_category.edit',compact('supplier'));
    }

    public function template_category_update(Request $request)
    {
        TemplateCategory::where('id',$request->id)->update([
            'user_id' => Auth::id(),
            'category_name' => $request->category_name,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]); 
        Toastr::success('Supplier Update successfully :)','Success');
        return back();
    }
}
