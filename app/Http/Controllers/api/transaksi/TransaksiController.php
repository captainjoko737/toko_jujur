<?php

namespace App\Http\Controllers\api\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Antrian;
use App\Models\Transaksi;
use App\Models\Keranjang;

class TransaksiController extends Controller
{
    
    public function getHistoryTransaksi() {

        $validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
            'no_antrian'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        // GET LIST KERANJANG

        $listKeranjang = Transaksi::with('barang')
                        ->where('id_user', request()->id_user)
                        ->where('no_antrian', request()->no_antrian)
                        ->get();

        $total = 0;
        $items = 0;
        foreach ($listKeranjang as $key => $value) {
            $listKeranjang[$key]['total'] = $value->barang->harga * $value->quantity;
            $total += (Int)$listKeranjang[$key]['total'];
            $items += $value->quantity;
        }

        $totalTransaksi = [
            'total_price'    => $total,
            'total_items'    => $items,
            'list_keranjang' => $listKeranjang
        ];

        if ($totalTransaksi) {
            return response()->json(['status'=> true, 'message'=> 'Success', 'data' => $totalTransaksi]);
        }else{
            return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }

    }

    public function postTransaksi() {

        $validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
            'no_antrian'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        // GET LIST KERANJANG

        $listKeranjang = Keranjang::with('barang')
                        ->where('id_user', request()->id_user)
                        ->where('no_antrian', request()->no_antrian)
                        ->get();

        foreach ($listKeranjang as $key => $value) {
            $param[] = [
                'id_user'       => request()->id_user,   
                'id_barang'     => $value->id_barang,
                'create_date'   => Carbon::now(),
                'total'         => $value->barang->harga,
                'active'        => 1,
                'quantity'      => $value->quantity,
                'no_antrian'    => $value->no_antrian
            ];
        }

        $save = Transaksi::insert($param);

        $total = 0;
        $items = 0;
        foreach ($listKeranjang as $key => $value) {
            $listKeranjang[$key]['total'] = $value->barang->harga * $value->quantity;
            $total += (Int)$listKeranjang[$key]['total'];
            $items += $value->quantity;
        }

        $totalTransaksi = [
            'total_price'    => $total,
            'total_items'    => $items,
            'list_keranjang' => $listKeranjang
        ];

        if ($totalTransaksi) {
            return response()->json(['status'=> true, 'message'=> 'Success', 'data' => $totalTransaksi]);
        }else{
            return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }
    }

}
