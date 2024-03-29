<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Order;
use App\Order_list;
use App\Product;
use Carbon\Carbon;


class CheckoutController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }

    function index(Request $request){
        if(Auth::user()->role == 1){
            echo "Your are an Admin,You Can Not Buy";
        }else{
            return view('checkout',[
                'carts' => Cart::where('ip_address',request()->ip())->get(),
                'total' => $request->total
            ]);
        }
    }

    function checkoutpost(Request $request){
        if($request->payment_option == 1){
             //insert into order table
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country' => $request->country,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'city' => $request->city,
            'notes' => $request->notes,
            'payment_option' => $request->payment_option,
            'sub_total' => $request->sub_total,
            'total' => $request->total,
            'created_at' => Carbon::now()
        ]);

        foreach(Cart::where('ip_address',request()->ip())->get() AS $cart){

        //insert into order list table

        Order_list::insert([
            'order_id' => $order_id,
            'user_id' => Auth::id(),
            'product_id' => $cart->product_id,
            'quantity' => $cart->quantity,
            'created_at' => Carbon::now(),
        ]);

        //decrement form product table

        Product::find($cart->product_id)->decrement('product_quantity',$cart->quantity);

        //delete for cart table

        Cart::find($cart->id)->delete();

        }
        return redirect('/');
        }

        else{
            //register
            //echo "Online Payment";

            return view('stripe',[
                'request_all_data' => $request->all()
            ]);

            //return redirect('/stripe')->with('request_all_data',$request->all());
        }
    }
}
