<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class BuynowPageController extends Controller
{
    public function buyNow(Request $request)
    {

        $total_quantity = $request->total_quantity;
        $total_price = $request->total_price;
        $product_id = $request->product_id;
        $supplier_id = $request->supplier_id;
        // Quantity Three Section
        $first_pack_quantity = $request->first_pack_quantity;
        $second_pack_quantity = $request->second_pack_quantity;
        $third_pack_quantity = $request->third_pack_quantity;
        // Product Three Price Section
        $first_package_price = $request->first_package_price;
        $second_package_price = $request->second_package_price;
        $third_package_price = $request->third_package_price;      

        $findProduct = Product::where('id',$product_id)->exists();
        if ($findProduct == 1) 
        {
            $productInfo = Product::where('id',$product_id)->first();
            $product_stock_quantity = $productInfo->product_quantity;
            if($total_quantity <= $product_stock_quantity)
            {
                return view('frontend.buynow-cart',compact(
                    'productInfo',
                    'total_quantity',
                    'total_price',
                    'supplier_id',
                    'product_id',
                    'first_pack_quantity',
                    'second_pack_quantity',
                    'third_pack_quantity',
                    'first_package_price',
                    'second_package_price',
                    'third_package_price'
                    )
                );
            }
            else
            {
                // echo "product sesh";
                Toastr::error('Sorry! You Will Purchase '.$product_stock_quantity.' Product :)','error',["positionClass" => "toast-top-right","showDuration"=> "500","hideDuration"=>"2000",]);
                return back();
            }
        } 
        else 
        {
            Toastr::success('Sorry! Product Not Available :)','error');
            return back();
        }
        
    }
    public function buyLogin(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
        // $email = $request->email;
        // $password = $request->password;
        // $checkUser = User::where('email',$email)->exists();
        // if($checkUser == 1)
        // {
        //     $userInfo = User::where('email',$email)->first();
        //     $credentials = $request->only('email', 'password');

        //     if (Auth::attempt($credentials)) {
        //         return redirect()->intended('checkout')
        //                     ->withSuccess('You have Successfully loggedin');
        //         return back();
        //     }
        // }
        // else
        // {
        //     dd('null');
        // }
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
             'password' => 'required',
         ]);
     
         if ($validator->passes()) {
             if (auth()->attempt(array('email' => $request->input('email'),
               'password' => $request->input('password')),true))
             {
                 return response()->json(['message'=>'Login Successfully']);
             }
             return response()->json([
                'error' => [
                    'email' => 'Sorry User not found.'
                ]
            ]);
         }
     
         return response()->json(['error'=>$validator->errors()->all()]);
        
    }
}
