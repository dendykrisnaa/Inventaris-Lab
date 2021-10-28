<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\PinjamAlat;

class CartToPinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            // 'praktikum' => 'required',
            // 'customer_id' => 'required',
            // 'nim' => 'required',
            // 'kelas' => 'required',
            // 'semester' => 'required',
            // 'tanggal_pinjam' => 'required',
            // 'tanggal_kembali' => 'required',
            // 'pro_id' => 'required',
            // 'nama_alat' => 'required',
            // 'jumlah_alat' => 'required',
            // 'product_price' => 'required',
            // 'sub_total' => 'required',
        ]);


        $pinjam = array();
        $pinjam['praktikum'] = $request->praktikum;
        $pinjam['customer_id'] = $request->customer_id;
        $pinjam['nim'] = $request->nim;
        $pinjam['kelas'] = $request->kelas;
        $pinjam['semester'] = $request->semester;
        $pinjam['tanggal_pinjam'] = $request->tanggal_pinjam;
        $pinjam['tanggal_kembali'] = $request->tanggal_kembali;

        $order_id = DB::table('pinjam_alats')->insertGetId($pinjam);

        $contents = DB::table('pos')->get();

        $pinjamalat = array();
        foreach ($contents as $i => $content) {
            $pinjamalat['order_id'] = $order_id;
            $pinjamalat['pro_id'] = $request->get('chart')[$i]['pro_id'];
            $pinjamalat['pro_name'] = $request->get('chart')[$i]['pro_name'];
            $pinjamalat['pro_quantity'] = $request->get('chart')[$i]['pro_quantity'];
            $pinjamalat['product_price'] = $request->get('chart')[$i]['product_price'];
            $pinjamalat['sub_total'] = $request->get('chart')[$i]['sub_total'];
            $pinjamalat['keterangan'] = $request->get('chart')[$i]['keterangan'];


            DB::table('order_dons')->insert($pinjamalat);
        }

        return $pinjamalat;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pinjam = DB::table('PinjamAlats')->where('id', $id)->first();
        return response()->json($pinjam);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }



    public function StockUpdate(Request $request, $id)
    {
    }
}
