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

  public function updatePeminjaman(Request $request)
  {
    $validadeData = $request->validate([
      'id' => 'required',
      'praktikum' => 'required',
      'customer_id' => 'required',
      'dosen' => 'required',
      'nim' => 'required',
      'kelas' => 'required',
      'semester' => 'required',
      'tanggal_pinjam' => 'required',
      'tanggal_kembali' => 'required',


    ]);

    $data = PinjamAlat::where('id', '=', $request->id)->first();
    $data->id = $request->id;
    $data->praktikum = $request->praktikum;
    $data->customer_id = $request->customer_id;
    $data->nim = $request->nim;
    $data->kelas = $request->kelas;
    $data->semester = $request->semester;
    $data->tanggal_pinjam = $request->tanggal_pinjam;
    $data->tanggal_kembali = $request->tanggal_kembali;

    $data->save();

    return response()->json($data, 201);
  }

  public function updateDetailPeminjaman(Request $request)
  {
    $validadeData = $request->validate([
      'id' => 'required',
      'order_id' => 'required',
      'pro_id' => 'required',
      'pro_name' => 'required',
      'pro_quantity' => 'required',
      'keterangan' => 'required',


    ]);

    $data = OrderDon::where('id', '=', $request->id)->first();
    $data->id = $request->id;
    $data->order_id = $request->order_id;
    $data->pro_id = $request->pro_id;
    $data->pro_name = $request->pro_name;
    $data->pro_quantity = $request->pro_quantity;
    $data->keterangan = $request->keterangan;

    $data->save();

    return response()->json($data, 201);
  }

  public function destroyPeminjaman(Request $request)
  {
    $data_pinjamalats = PinjamAlat::where('id', '=', $request->id)->first();

    if (!empty($data_pinjamalats)) {
      $data_pinjamalats->delete();

      return response()->json($data_pinjamalats, 200);
    } else {
      return response()->json([
        'error' => 'data tidak ditemukan',
      ], 404);
    }
  }
  public function destroyDetailPeminjaman(Request $request)
  {
    $data_detailpeminjaman = OrderDon::where('id', '=', $request->id)->first();

    if (!empty($data_detailpeminjaman)) {
      $data_detailpeminjaman->delete();

      return response()->json($data_detailpeminjaman, 200);
    } else {
      return response()->json([
        'error' => 'data tidak ditemukan',
      ], 404);
    }
  }
}
