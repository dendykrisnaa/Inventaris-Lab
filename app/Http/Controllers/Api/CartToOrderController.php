<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CartToOrderController extends Controller
{
    public function AddToOrder(Request $request, $id){
    	$product = DB::table('pos')->where('id',$id)->first();

    	$check = DB::table('cart_orders')->where('order_id',$id)->first();

    	if ($check) {
    	DB::table('cart_orders')->where('order_id',$id)->increment('jumlah_order');

       $product = DB::table('cart_orders')->where('order_id',$id)->first();

    	}else{
    	$data = array();
    	$data['order_id'] = $id;
    	$data['product_name'] = $product->pro_name;
    	$data['jumlah_order'] = 1;
    	// $data['keterangan'] = $product->selling_price;

    	DB::table('cart_orders')->insert($data);
    	}

    	
 
    }


  public function OrderProduct(){
   $cartorder = DB::table('cart_orders')->get();
  	return response()->json($cartorder);
  }



 public function removeCart($id){
 	DB::table('pos')->where('id',$id)->delete();
 	return response('Done');

 }


  public function increment($id){
  	$quantity = DB::table('pos')->where('id',$id)->increment('pro_quantity');

  	$product = DB::table('pos')->where('id',$id)->first();
  	$subtotal = $product->pro_quantity * $product->product_price;
  	DB::table('pos')->where('id',$id)->update(['sub_total'=> $subtotal]);
  	return response('Done');
  }


  public function decrement($id){
  	$quantity = DB::table('pos')->where('id',$id)->decrement('pro_quantity');

  	$product = DB::table('pos')->where('id',$id)->first();
  	$subtotal = $product->pro_quantity * $product->product_price;
  	DB::table('pos')->where('id',$id)->update(['sub_total'=> $subtotal]);
  	return response('Done');
  }


  public function Vats(){
  	$vat = DB::table('extra')->first();
  	return response()->json($vat);
  }
}
