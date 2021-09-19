<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Response;

class ApiSupplierProductController extends Controller
{
    public function view()
    {
        $products = Product::where('status',0)->orderBy('id','asc')->get();
        return response()->json($products, 200);
        //  return Response::json(array(
        //             'status'  => 'ok',
        //             'message'  => 'success',
        //             'data' => $products
        //         ));
        
    }
}
