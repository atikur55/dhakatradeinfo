<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Order;
use App\Models\CustomerMessage;
use Auth;
use Mail;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class CustomerOrderController extends Controller
{
    public function customer_track()
    {
        return view('customer.track');
    }
    public function customer_track_post(Request $request)
    {
        $request->validate([
            'track_no' => 'required',
        ]);
        $data = Tracking::where('track_no',$request->track_no)->exists();
        
        if($data == 1)
        {
            $trackNo = $request->track_no;
            $tracks = Tracking::where('track_no',$request->track_no)->orderBy('id','asc')->get();
            $status = Tracking::where('track_no',$request->track_no)->latest()->first();
            return view('customer.trackPage',compact('tracks','trackNo','status'));
        }
        else
        {
            Toastr::success('Sorry! Track Number Not Available :)','error');
            return back();
        }
        
    }
    public function my_order()
    {
        $all_orders = Order::where('email',Auth::user()->email)->orderBy('id','desc')->get();

        return view('customer.allOrder',compact('all_orders'));
    }
    public function customer_message_post(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
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
            CustomerMessage::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            \Mail::send('email.supplier_register', array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'subject' => $request->get('subject'),
                'user_query' => $request->get('message'),
            ), function($message) use ($request){
                $message->from($request->email);
                $message->to(['uitdeveloper2021@gmail.com','dhakatradeinfobd@gmail.com'])->subject($request->get('subject'));
            });
            return response()->json([
                'status' => 200,
                'message' => 'Message Sent Successfully',
            ]);
        }
    }
}
