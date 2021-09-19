<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Country;
use App\Models\BusinessType;
use Auth;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    public function create()
    {
        $all_category =  Category::where('status',0)->get();
        $all_subcategory =  SubCategory::where('status',0)->get();
        $all_childcategory =  ChildCategory::where('status',0)->get();
        $all_country = Country::where('status',0)->orderBy('country_name')->get();
        $all_business =  BusinessType::where('status',0)->get();

        return view('admin.product.create',compact('all_category','all_subcategory','all_childcategory','all_country','all_business'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpg,jpeg,png|required|max:1024',
            'category_id' => 'required',
            'product_name' => 'required',
        ]);
      
        if(isset($request->color))
        {
            $color = implode(",",$request->color);
        }
        else
        {
            $color = '';
        }

        if(isset($request->quantity))
        {
            $quantity = implode(",",$request->quantity);
        }
        else
        {
            $quantity = '';
        }

        if(isset($request->quprice))
        {
            $quprice = implode(",",$request->quprice);
        }
        else
        {
            $quprice = '';
        }
     

        $product_slug = Str::slug($request->product_name.'-'.rand(1000,99999).'-'.Carbon::now()->timestamp);

        $logo_id = Product::insertGetId([
            'added_by' => Auth::id(),
            'business_id' => $request->business_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'domain_url' => $request->domain_url,
            'slug' => $product_slug,
            'brand_name' => $request->brand_name,
            'country_origin' => $request->country_origin,
            'color' => $color,
            'quantity' => $quantity,
            'quprice' => $quprice,
            'video_link' => $request->video_link,
            'price_dollar' => $request->price_dollar,
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'min_order_quantity' => $request->min_order_quantity,
            'product_quantity_one' => $request->product_quantity_one,
            'product_price_one_dollar' => $request->product_price_one_dollar,
            'product_price_one' => $request->product_price_one,
            'product_quantity_two' => $request->product_quantity_two,
            'product_price_two_dollar' => $request->product_price_two_dollar,
            'product_price_two' => $request->product_price_two,
            'product_quantity_three' => $request->product_quantity_three,
            'product_price_three_dollar' => $request->product_price_three_dollar,
            'product_price_three' => $request->product_price_three,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) 
        {
            $upload_logo_photo = $request->file('image');
            $new_upload_logo_photo_name = $logo_id.'.'.$upload_logo_photo->extension();
            $new_logo_photo_location = base_path('public/uploads/product/').$new_upload_logo_photo_name;
            Image::make($upload_logo_photo)->save($new_logo_photo_location);
            Product::find($logo_id)->update([
                'image' => $new_upload_logo_photo_name,
            ]);
        }
        
        

        $all_multiple_image = $request->file('product_multiple_photo');

        $flag = 1;
        foreach($all_multiple_image as $single_image)
        {
            $new_product_multiple_photo_name = $logo_id.'-'.$flag.'.'.$single_image->extension();
            $new_product_photo_location = base_path('public/uploads/product/product_details/'.$new_product_multiple_photo_name);
            Image::make($single_image)->save($new_product_photo_location);

            ProductDetails::insert([
              'user_id' => Auth::id(),
              'product_id' => $logo_id,
              'product_multiple_photo_name' => $new_product_multiple_photo_name,
              'created_at' => Carbon::now(),
            ]);

            $flag++;

        }

        Toastr::success('Product Add successfully :)','Success');
        return back();

    }
    public function list()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('admin.product.view',compact('products'));
    }
    
    public function delete($id)
    {
        $data = Product::find($id);
        $image = base_path('public/uploads/product/'.$data->image);;

        if ($image) {
            unlink($image);
            $data->delete();
        }
        else
        {
            $data->delete();
        }
        Toastr::success('Product Delete successfully :)','Success');
        return back();
    }
    public function status($id)
    {
        $data = Product::find($id);
        if ($data->status == 0) 
        {
           Product::where('id',$id)->update([
                'status' => 1,
           ]);
        } 
        else 
        {
            Product::where('id',$id)->update([
                'status' => 0,
            ]);
        }

        Toastr::success('Status Change successfully :)','Success');
        return back();
        
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $all_category =  Category::where('status',0)->get();
        $all_subcategory =  SubCategory::where('status',0)->get();
        $all_childcategory =  ChildCategory::where('status',0)->get();
        $all_business =  BusinessType::where('status',0)->get();
        return view('admin.product.edit',compact('product','all_category','all_subcategory','all_childcategory','all_business'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'category_id' =>'required',
        ]);

        if(isset($request->color))
        {
            $color = implode(",",$request->color);
            
        }
        else
        {
            $color = '';
            
        }

        if(isset($request->quantity))
        {
            $quantity = implode(",",$request->quantity);
        }
        else
        {
            $quantity = '';
        }

        if(isset($request->quprice))
        {
            $quprice = implode(",",$request->quprice);
        }
        else
        {
            $quprice = '';
        }

        $get_image = Product::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {
          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/product/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/product/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        $get_image->business_id = $request->business_id;
        $get_image->category_id = $request->category_id;
        $get_image->subcategory_id = $request->subcategory_id;
        $get_image->childcategory_id = $request->childcategory_id;
        $get_image->product_name = $request->product_name;
        $get_image->price_dollar = $request->price_dollar;
        $get_image->price = $request->price;
        $get_image->country_origin = $request->country_origin;
        $get_image->brand_name = $request->brand_name;
        $get_image->color = $color;
        $get_image->product_code = $request->product_code;
        $get_image->product_quantity = $request->product_quantity;
        $get_image->min_order_quantity = $request->min_order_quantity;
        $get_image->product_quantity_one = $request->product_quantity_one;
        $get_image->product_price_one = $request->product_price_one;
        $get_image->product_price_one_dollar = $request->product_price_one_dollar;
        $get_image->product_quantity_two = $request->product_quantity_two;
        $get_image->product_price_two = $request->product_price_two;
        $get_image->product_price_two_dollar = $request->product_price_two_dollar;
        $get_image->product_quantity_three = $request->product_quantity_three;
        $get_image->product_price_three = $request->product_price_three;
        $get_image->product_price_three_dollar = $request->product_price_three_dollar;
        $get_image->video_link = $request->video_link;
        $get_image->domain_url = $request->domain_url;
        $get_image->description = $request->description;
        $get_image->quantity = $quantity;
        $get_image->quprice = $quprice;
        $get_image->added_by = Auth::id();
        $get_image->created_at = Carbon::now();
        $get_image->save();
        
        Toastr::success('Product Update successfully :)','Success');
        return back();
    }
    public function findCityWithStateID($id)
    {
        $city = SubCategory::where('category_id',$id)->get();
        return response()->json($city);
    }
    public function getStateList($id)
    {
        $states = SubCategory::where('category_id',$id)->get();
        return response()->json($states);
    }

    public function getCityList($id)
    {
        $cities = ChildCategory::where('subcategory_id',$id)->get();
        return response()->json($cities);
    }
}
