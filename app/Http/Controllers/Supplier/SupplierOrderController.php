<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Product;
use Auth;
use PDF;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;


class SupplierOrderController extends Controller
{
    public function all_order()
    {
        $supplier = Supplier::where('user_id',Auth::id())->first();
        $all_order = Order::where('supplier_id',$supplier->id)->orderBy('id','desc')->get();
        return view('supplier.order.all_order',compact('all_order'));
    }
    public function order_status(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);

        Order::where('id',$request->id)->update([
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);
        

        Toastr::success('Delivery Status Change successfully :)','Success');
        return back();

    }
    public function pending_order()
    {
        $supplier = Supplier::where('user_id',Auth::id())->first();
        $all_order = Order::where('supplier_id',$supplier->id)->where('status',0)->orderBy('id','desc')->get();
        return view('supplier.order.pending_order',compact('all_order'));
    }
    public function processing_order()
    {
        $supplier = Supplier::where('user_id',Auth::id())->first();
        $all_order = Order::where('supplier_id',$supplier->id)->where('status',1)->orderBy('id','desc')->get();
        return view('supplier.order.processing_order',compact('all_order'));
    }
    public function confirm_order()
    {
        $supplier = Supplier::where('user_id',Auth::id())->first();
        $all_order = Order::where('supplier_id',$supplier->id)->where('status',2)->orderBy('id','desc')->get();
        return view('supplier.order.confirm_order',compact('all_order'));
    }
    public function ongoing_order()
    {
        $supplier = Supplier::where('user_id',Auth::id())->first();
        $all_order = Order::where('supplier_id',$supplier->id)->where('status',3)->orderBy('id','desc')->get();
        return view('supplier.order.ongoing_order',compact('all_order'));
    }

    public function delivered_order()
    {
        $supplier = Supplier::where('user_id',Auth::id())->first();
        $all_order = Order::where('supplier_id',$supplier->id)->where('status',4)->orderBy('id','desc')->get();
        return view('supplier.order.delivered_order',compact('all_order'));
    }
    public function cancel_order()
    {
        $supplier = Supplier::where('user_id',Auth::id())->first();
        $all_order = Order::where('supplier_id',$supplier->id)->where('status',5)->orderBy('id','desc')->get();
        return view('supplier.order.cancel_order',compact('all_order'));
    }
    public function download_order($id)
    {
        $order = Order::where('id',$id)->first();
        $product = $order->product_id;
        $productInfo = Product::where('id',$product)->first();
        $issueDate = Carbon::now();
        // $user = User::where('id',$order->user_id)->first();
        $report_pdf = PDF::loadView('download.supplier_order', $order,compact('order','issueDate','productInfo'));
        $dynamic_name = $order->track_no.'_'.Carbon::now()->format('d-m-Y').".pdf";
        return $report_pdf->download($dynamic_name); 
    }
}
