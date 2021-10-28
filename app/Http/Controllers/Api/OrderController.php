<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\OrderDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  public function TodayOrder()
  {

    $order = DB::table('pinjam_alats')
      ->join('customers', 'pinjam_alats.customer_id', 'customers.id')
      ->select('customers.name', 'pinjam_alats.*')
      ->orderBy('pinjam_alats.id', 'DESC')->get();
    return response()->json($order);
  }


  public function OrderDetails($id)
  {
    //return response()->json($id);
    $order = DB::table('pinjam_alats')
      ->join('customers', 'pinjam_alats.customer_id', 'customers.id')
      ->where('pinjam_alats.id', $id)
      ->select('customers.name', 'customers.phone', 'customers.address', 'pinjam_alats.*')
      ->first();
    return response()->json($order);
  }


  public function OrderDetailsAll($id)
  {
    // $data = OrderDon::all();
    $details = DB::table('order_dons')
      ->join('products', 'order_dons.pro_id', 'products.id')
      ->where('order_dons.order_id', $id)
      ->select('products.product_name', 'order_dons.keterangan', 'products.image', 'order_dons.*')
      ->get();
    return response()->json($details);

    // return $id;
  }
}
