<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Country;
use Auth;
use Mail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class CheckOutPageController extends Controller
{
    
    public function checkout(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->product_id;
            $productInfo = Product::where('id',$product_id)->first();
            $final_quantity = $request->final_quantity;
            $final_checkout_price = $request->final_checkout_price;
            $supplier_id = $request->supplier_id;
            $total_checkout_price = $final_checkout_price + 10;
            $all_country = Country::orderBy('country_name')->get();
            return view('frontend.checkout',compact('product_id','final_quantity','final_checkout_price','supplier_id','productInfo','total_checkout_price','all_country'));
        } 
        else 
        {
            return view('frontend.loginForbuy');
        }
        die();
        $product_id = $request->product_id;
        $productInfo = Product::where('id',$product_id)->first();
        $final_quantity = $request->final_quantity;
        $final_checkout_price = $request->final_checkout_price;
        $supplier_id = $request->supplier_id;
        $total_checkout_price = $final_checkout_price + 10;
        return view('frontend.checkout',compact('product_id','final_quantity','final_checkout_price','supplier_id','productInfo','total_checkout_price'));
    }

    public function checkoutOrder(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'address' => 'required',
            'country' => 'required',
            'payment' => 'required',
            'send_account_number' => 'required',
            'transactionid' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } 
        else 
        {
            $track_no = 'DT'.'-'.date("Y").date("m").rand(100,999999);
            
            Order::create([
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'add_require' => $request->add_require,
                'country' => $request->country,
                'state' => $request->state,
                'policeStation' => $request->policeStation,
                'payment' => $request->payment,
                'send_account_number' => $request->send_account_number,
                'transactionid' => $request->transactionid,
                'reference' => $request->reference,
                'product_name' => $request->product_name,
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'track_no' => $track_no,
                'final_quantity' => $request->final_quantity,
                'final_checkout_price' => $request->final_checkout_price,
                'sub_total_price' => $request->sub_total_price,
                'shipp_rate' => $request->shipp_rate,
                'confirm_total_price' => $request->confirm_total_price,
            ]);
            
            $supplierinfo = Supplier::where('id',$request->supplier_id)->exists();
            if ($supplierinfo == 1) {
                $supplierinfo = Supplier::where('id',$request->supplier_id)->first();
                $supplier_email = $supplierinfo->email;
            } else {
                $supplier_email = 'uithelps@gmail.com';
            }
    
            \Mail::send('email.orderInfo', array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'subject' => 'Order Information',
                'user_query' => 'Congratulation! Your order purchased has been successfully.',
            ), function($message) use ($request,$supplier_email){
                $message->from('uitdeveloper2021@gmail.com');
                $message->to(['uitdeveloper2021@gmail.com',$request->email,$supplier_email])->subject('Order Information');
            });
            return response()->json([
                'status' => 200,
                'message' => 'Order Successfully Completed',
            ]);
        }

        // $validator = $request->validate([
        //     'address' => 'required',
        //     'country' => 'required',
        //     'payment' => 'required',
        //     'send_account_number' => 'required',
        //     'transactionid' => 'required',
        // ]);

        
            // $track_no = 'DT'.'-'.date("Y").date("m").rand(100,999999);
            // dd($track_no);die();
            
            // Order::create([
            //     'email' => $request->email,
            //     'name' => $request->name,
            //     'phone' => $request->phone,
            //     'address' => $request->address,
            //     'add_require' => $request->add_require,
            //     'country' => $request->country,
            //     'state' => $request->state,
            //     'policeStation' => $request->policeStation,
            //     'payment' => $request->payment,
            //     'send_account_number' => $request->send_account_number,
            //     'transactionid' => $request->transactionid,
            //     'reference' => $request->reference,
            //     'product_name' => $request->product_name,
            //     'product_id' => $request->product_id,
            //     'supplier_id' => $request->supplier_id,
            //     'track_no' => $track_no,
            //     'final_quantity' => $request->final_quantity,
            //     'final_checkout_price' => $request->final_checkout_price,
            //     'sub_total_price' => $request->sub_total_price,
            //     'shipp_rate' => $request->shipp_rate,
            //     'confirm_total_price' => $request->confirm_total_price,
            // ]);
            
            // $supplierinfo = Supplier::where('id',$request->supplier_id)->exists();
            // if ($supplierinfo == 1) {
            //     $supplierinfo = Supplier::where('id',$request->supplier_id)->first();
            //     $supplier_email = $supplierinfo->email;
            // } else {
            //     $supplier_email = 'uithelps@gmail.com';
            // }
    
            // \Mail::send('email.orderInfo', array(
            //     'name' => $request->get('name'),
            //     'email' => $request->get('email'),
            //     'phone' => $request->get('phone'),
            //     'subject' => 'Order Information',
            //     'user_query' => 'Congratulation! Your order purchased has been successfully.',
            // ), function($message) use ($request,$supplier_email){
            //     $message->from('uitdeveloper2021@gmail.com');
            //     $message->to(['uitdeveloper2021@gmail.com',$request->email,$supplier_email])->subject('Order Information');
            // });
            // Toastr::success('Congratulation! Order Place Successfully :)','success');
            // return redirect('/'); 

        
    }
}
