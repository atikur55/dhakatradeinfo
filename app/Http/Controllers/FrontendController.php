<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\SupplierUpgrade;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $all_products = Product::where('status',0)->orderBy('id','desc')->get();
        return view('frontend.index',compact('all_products'));
    }
    public function product_details($slug)
    {
        $product = Product::where('slug',$slug)->where('status',0)->first();
        $same_product_code = Product::where('product_code',$product->product_code)->orderBy('id','desc')->take(8)->get();
        $product_images = ProductDetails::where('product_id',$product->id)->get();
        $similar_product = Product::where('childcategory_id','!=',$product->childcategory_id)->where('status',0)->take(12)->get();
        $company_info = SupplierUpgrade::where('user_domain',$product->domain_url)->exists();
        if ($company_info == 1) 
        {
            $supplier = Supplier::where('user_id',$product->added_by)->first();
        } 
        else 
        {
            $supplier = '';

        }
        

        return view('frontend.product_details',compact('product','product_images','supplier','similar_product','same_product_code'));
    }
    public function child_product_list($id)
    {
        $child_name = ChildCategory::find($id);
        $child_products = Product::where('childcategory_id',$id)->where('status',0)->get();
        
        // dd($child_products);
        return view('frontend.child_products',compact('child_products','child_name'));
    }
    public function category_assets($name)
    {
        $category = $name;
        $category_info = Category::where('category_name',$category)->first();
        $subcategories = Subcategory::where('category_id',$category_info->id)->get();
        $products = Product::where('category_id',$category_info->id)->where('status',0)->get();
        return view('frontend.category_asset',compact('subcategories','category','products','category_info'));
    }
    public function track()
    {
        return view('frontend.track');
    }
    public function track_order(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'track_no' => 'required',
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
            State::insert([
                'country_id' => $request->country_id,
                'state_name' => $request->state_name,
                'created_at' => Carbon::now(),
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Data Added Successfully',
            ]);
        }
    }

}
