<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Auth;
use App\Models\Order;
use App\Models\OrderDetail;
class productController extends Controller
{
    //
    public function index(Request $request)
    {
        
        $product=Product::get();
        
        return view('product.listOfProduct',compact('product'));
    }
    public function remove_cart(Request $request)
    {
        $id=$request->id;
        dump($id);
    }
    public function store_cart(Request $request)
    {
        $id=$request->id;
        $product=Product::where('id',$id)->first();
        if($product && $product->product_quantity > 0)
        {
            $upd=Product::find($id);
            $upd->product_quantity=intval($product->product_quantity)-1;
            $upd->save();

            $checkCart=Cart::where('product_id',$id)->where('user_id',\Auth::user()->id)->first();
            if($checkCart === null)
            {
                $addCart=new Cart;
                $addCart->user_id=\Auth::user()->id;
                $addCart->product_id=$id;
                $addCart->qty=1;
                $addCart->price=$product->product_price;
                $addCart->total=$product->product_price*1;
                $addCart->save();
            }
            else
            {
                $addCart=Cart::find($checkCart->id);
                $addCart->user_id=\Auth::user()->id;
                $addCart->product_id=$id;
                $addCart->qty=$checkCart->qty+1;
                $addCart->price=$product->product_price;
                $addCart->total=$product->product_price*($checkCart->qty+1);
                $addCart->save();  
            }
        }
        return response()->json(['success'=>true]);
    }
    public function show_carts()
    {
        $carts=Cart::with('product')->where('user_id',\Auth::user()->id)->get();
        $html=view('product.dyanamic',compact('carts'))->render();
        return response()->json(['html'=>$html]);
    }
    public function checkout()
    {
        $cartTotal=Cart::where('user_id',\Auth::user()->id)->sum('total');
        $order=new Order;
        $order->user_id=\Auth::user()->id;
        $order->total=$cartTotal;
        $order->save();

        $carts=Cart::where('user_id',\Auth::user()->id)->get();
        if(count($carts) > 0)
        {
            foreach($carts as $cart)
            {
                $addorderDetail=new OrderDetail;
                $addorderDetail->user_id=\Auth::user()->id;
                $addorderDetail->product_id=$cart->product_id;
                $addorderDetail->order_id=$order->id;
                $addorderDetail->qty=$cart->qty;
                $addorderDetail->price=$cart->price;
                $addorderDetail->save();
                $cartDelete=Cart::where('id',$cart->id)->delete();
            }
        }
        return redirect()->back();
    }
}
