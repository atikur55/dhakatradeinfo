<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\Country;
use App\Models\ProductDetails;
use App\Models\BusinessType;
use Auth;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class SupplierProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $all_category =  Category::where('status',0)->get();
        $all_subcategory =  SubCategory::where('status',0)->get();
        $all_childcategory =  ChildCategory::where('status',0)->get();
        $all_business =  BusinessType::where('status',0)->get();
        $all_country = Country::where('status',0)->orderBy('country_name')->get();

        return view('supplier.product.create',compact('all_category','all_subcategory','all_childcategory','all_country','all_business'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'mimes:jpg,jpeg,png|required|max:1024',
            'category_id' => 'required',
            'product_name' => 'required',
            'product_multiple_photo' => 'required',
        ]);
        // Business Type
        if(isset($request->business_id))
        {
            $business_data = BusinessType::where('id',$request->business_id)->exists();
            if($business_data == 1)
            {
                $business_data = BusinessType::where('id',$request->business_id)->first();
                $business_id_no = $business_data->id;
            }
            else
            {
                $business_id_no = BusinessType::insertGetId([
                    'user_id' => Auth::id(),
                    'business_name' => $request->business_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $business_final_data = $business_id_no??'';

        // Category Type
        if(isset($request->category_id))
        {
            $category_data = Category::where('id',$request->category_id)->exists();
            if($category_data == 1)
            {
                $category_data = Category::where('id',$request->category_id)->first();
                $category_id_no = $category_data->id;
                
            }
            else
            { 
                $category_id_no = Category::insertGetId([
                    'added_by' => Auth::id(),
                    'business_id' => $business_final_data,
                    'category_name' => $request->category_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $category_final_data = $category_id_no??'';

        // Sub-Category Type
        if(isset($request->subcategory_id))
        {
            $subcategory_data = SubCategory::where('id',$request->subcategory_id)->exists();
            if($subcategory_data == 1)
            {
                $subcategory_data = SubCategory::where('id',$request->subcategory_id)->first();
                $subcategory_id_no = $subcategory_data->id;
                
            }
            else
            { 
                $subcategory_id_no = SubCategory::insertGetId([
                    'added_by' => Auth::id(),
                    'category_id' => $category_final_data,
                    'title' => $request->subcategory_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $subcategory_final_data = $subcategory_id_no??'0';
        
        // Child-Category Type
        if(isset($request->childcategory_id))
        {
            $childcategory_data = ChildCategory::where('id',$request->childcategory_id)->exists();
            if($childcategory_data == 1)
            {
                $childcategory_data = ChildCategory::where('id',$request->childcategory_id)->first();
                $childcategory_id_no = $childcategory_data->id;
                
            }
            else
            { 
                $childcategory_id_no = ChildCategory::insertGetId([
                    'added_by' => Auth::id(),
                    'category_id' => $category_final_data,
                    'subcategory_id' => $subcategory_final_data,
                    'title' => $request->childcategory_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $childcategory_final_data = $childcategory_id_no??'0';
      
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
            // 'business_id' => $business_id_no,
            // 'category_id' => $category_id_no,
            'business_id' => $business_final_data,
            'category_id' => $category_final_data,
            // 'subcategory_id' => $request->subcategory_id,
            'subcategory_id' => $subcategory_final_data,
            // 'childcategory_id' => $request->childcategory_id,
            'childcategory_id' => $childcategory_final_data,
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
        $products = Product::where('added_by',Auth::id())->orderBy('id','desc')->get();
        return view('supplier.product.view',compact('products'));
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
        return view('supplier.product.edit',compact('product','all_category','all_subcategory','all_childcategory','all_business'));
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

    public function image()
    {
        $datas = ProductDetails::orderBy('id','desc')->get();
        return view('supplier.product.product_image',compact('datas'));
    }
    public function image_delete($id)
    {
        $data = ProductDetails::find($id);

        $image = base_path('public/uploads/product/product_details/'.$data->product_multiple_photo_name);

        if ($image) {
            unlink($image);
            $data->delete();
        }
        else
        {
            $data->delete();
        }
        Toastr::success('Product Image Delete successfully :)','Success');
        return back();
    }
    public function image_update(Request $request)
    {
        
        $get_image = ProductDetails::find($request->id);
        $request->all();
        if ($request->hasFile('product_multiple_photo')) {
          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/product/product_details/'.$get_image->product_multiple_photo_name);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('product_multiple_photo');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/product/product_details/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->product_multiple_photo_name = $new_product_photo_name;
        }
        $get_image->product_id = $request->product_id;
        $get_image->created_at = Carbon::now();
        $get_image->save();
        
        Toastr::success('Product Image Update successfully :)','Success');
        return back();
    }
    public function getCountryList($id)
    {
        $country = Category::where('business_id',$id)->get();
        return response()->json($country);
    }
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'mimes:jpg,jpeg,png|required|max:1024',
            'category_id' => 'required',
            'product_name' => 'required',
            'product_multiple_photo' => 'required',
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
            // Business Type
        if(isset($request->business_id))
        {
            $business_data = BusinessType::where('id',$request->business_id)->exists();
            if($business_data == 1)
            {
                $business_data = BusinessType::where('id',$request->business_id)->first();
                $business_id_no = $business_data->id;

            }
            else
            {
                $business_id_no = BusinessType::insertGetId([
                    'user_id' => Auth::id(),
                    'business_name' => $request->business_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $business_final_data = $business_id_no??'';

        // Category Type
        if(isset($request->category_id))
        {
            $category_data = Category::where('id',$request->category_id)->exists();
            if($category_data == 1)
            {
                $category_data = Category::where('id',$request->category_id)->first();
                $category_id_no = $category_data->id;
                
            }
            else
            { 
                $category_id_no = Category::insertGetId([
                    'added_by' => Auth::id(),
                    'business_id' => $business_final_data,
                    'category_name' => $request->category_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $category_final_data = $category_id_no??'';

        // Sub-Category Type
        if(isset($request->subcategory_id))
        {
            $subcategory_data = SubCategory::where('id',$request->subcategory_id)->exists();
            if($subcategory_data == 1)
            {
                $subcategory_data = SubCategory::where('id',$request->subcategory_id)->first();
                $subcategory_id_no = $subcategory_data->id;
                
            }
            else
            { 
                $subcategory_id_no = SubCategory::insertGetId([
                    'added_by' => Auth::id(),
                    'category_id' => $category_final_data,
                    'title' => $request->subcategory_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $subcategory_final_data = $subcategory_id_no??'0';
        
        // Child-Category Type
        if(isset($request->childcategory_id))
        {
            $childcategory_data = ChildCategory::where('id',$request->childcategory_id)->exists();
            if($childcategory_data == 1)
            {
                $childcategory_data = ChildCategory::where('id',$request->childcategory_id)->first();
                $childcategory_id_no = $childcategory_data->id;
                
            }
            else
            { 
                $childcategory_id_no = ChildCategory::insertGetId([
                    'added_by' => Auth::id(),
                    'category_id' => $category_final_data,
                    'subcategory_id' => $subcategory_final_data,
                    'title' => $request->childcategory_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $childcategory_final_data = $childcategory_id_no??'0';

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
            // 'business_id' => $business_id_no,
            // 'category_id' => $category_id_no,
            'business_id' => $business_final_data,
            'category_id' => $category_final_data,
            // 'subcategory_id' => $request->subcategory_id,
            'subcategory_id' => $subcategory_final_data,
            // 'childcategory_id' => $request->childcategory_id,
            'childcategory_id' => $childcategory_final_data,
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
            return response()->json([
                'status' => 200,
                'message' => 'Data Added Successfully',
            ]);
        }
    }
}
