<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Models\Supplier;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;

class EmailController extends Controller
{

    public function email_to_supplier(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        \Mail::send('email.supplier', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from('uitdeveloper2021@gmail.com');
            $message->to([$request->email,'uitdeveloper2021@gmail.com'])->subject($request->get('subject'));
        });
        Toastr::success('Email Sent successfully :)','Success');
        return back();
    }
    public function email_to_all_supplier(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $all_supplier = User::where('user_type','supplier')->orderBy('id','asc')->get();

        foreach($all_supplier as $supplier)
        {
            \Mail::send('email.supplier_all', array(
                'name' => $supplier->name,
                'email' => $supplier->email,
                'subject' => $request->get('subject'),
                'user_query' => $request->get('message'),
            ), function($message) use ($supplier,$request){
                $message->from('uitdeveloper2021@gmail.com');
                $message->to($supplier->email)->subject($request->get('subject'));
            });
        }
        Toastr::success('Email Sent successfully :)','Success');
        return back();
    }
    public function email_to_all_customer(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $all_customer = User::where('user_type','customer')->orderBy('id','asc')->get();

        foreach($all_customer as $customer)
        {
            \Mail::send('email.supplier_all', array(
                'name' => $customer->name,
                'email' => $customer->email,
                'subject' => $request->get('subject'),
                'user_query' => $request->get('message'),
            ), function($message) use ($customer,$request){
                $message->from('uitdeveloper2021@gmail.com');
                $message->to($customer->email)->subject($request->get('subject'));
            });
        }
        Toastr::success('Email Sent successfully :)','Success');
        return back();
    }
}
