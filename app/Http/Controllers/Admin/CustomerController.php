<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;

class CustomerController extends Controller
{
    public function customer_list()
    {
        $all_customer = User::where('user_type','çustomer')->get();
        return view('admin.customer.view',compact('all_customer'));
    }
    public function customer_status($id)
    {
        $data = User::find($id);
        if ($data->role == 0) 
        {
           User::where('id',$data->id)->update([
                'role' => 1,
           ]);
        } 
        else 
        {

            User::where('id',$data->id)->update([
                'role' => 0,
           ]);
        }

        Toastr::success('Customer Status Change successfully :)','Success');
        return back();
    }
    public function customer_delete($id)
    {
        $data = User::find($id);
        $image = base_path('public/uploads/profile/'.$data->image);;

        if ($image) {
            unlink($image);
            $data->delete();
        }
        else
        {
            $data->delete();
        }
        Toastr::success('Customer Delete successfully :)','Success');
        return back();
    }
}
