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
use App\Models\Saldo;
use App\Models\Barang;
use App\Http\Controllers\api\saldo\SaldoController;
use App\Http\Controllers\api\antrian\AntrianController;

class TransaksiController extends Controller
{
    
    // GET LIST DATA HISTORY TRANSAKSI
    public function getHistoryTransaksi() {

        $validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        // GET LIST KERANJANG

        $listTransaksi = Transaksi::with('barang')
                        ->where('id_user', request()->id_user)
                        ->orderBy('id', 'DESC')
                        ->get();

        $resultTransaksi = [];

        foreach ($listTransaksi as $key => $value) {
            $noAntrian = $value->no_antrian;

            $dataTransaksi = [];
            foreach ($listTransaksi as $keys => $values) {
                if ($values->no_antrian == $noAntrian) {
                    array_push($dataTransaksi, $values);
                }
            }

            $data = [
                'no_antrian' => $noAntrian,
                'list'       => $dataTransaksi
            ];

            array_push($resultTransaksi, $data);
        }

        // return $resultTransaksi;

        if ($resultTransaksi) {
            return response()->json(['status'=> true, 'message'=> 'Success', 'data' => $resultTransaksi]);
        }else{
            return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }

    }

    // GET DETAIL DATA HISTORY TRANSAKSI
    public function getHistoryDetailTransaksi() {

        $validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
            'no_antrian'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        // GET LIST KERANJANG

        $listTransaksi = Transaksi::with('barang')
                        ->where('id_user', request()->id_user)
                        ->where('no_antrian', request()->no_antrian)
                        ->orderBy('id', 'DESC')
                        ->get();

        $resultTransaksi = [];

        foreach ($listTransaksi as $key => $value) {
            $noAntrian = $value->no_antrian;

            $dataTransaksi = [];
            foreach ($listTransaksi as $keys => $values) {
                if ($values->no_antrian == $noAntrian) {
                    array_push($dataTransaksi, $values);
                }
            }

            $data = [
                'no_antrian' => $noAntrian,
                'list'       => $dataTransaksi
            ];

            array_push($resultTransaksi, $data);
        }

        if ($resultTransaksi) {
            return response()->json(['status'=> true, 'message'=> 'Success', 'data' => $resultTransaksi]);
        }else{
            return response()->json(['status'=> false, 'message'=> 'History detail transaksi tidak ditemukan', 'data' => []]);
        }

    }

    // DO TRANSAKSI
    public function postTransaksi() {

        $validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
            'no_antrian'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        // GET SALDO

        $saldo = (new SaldoController)->checkSaldo(request()->id_user);

        // CHECK IF SALDO IS EXIST
        if (!isset($saldo->saldo)) {
            return response()->json(['status'=> false, 'message'=> 'Data Saldo Tidak ditemukan, silahkan untuk mengisi saldo terlebih dulu.', 'data' => []]);
        }

        // GET LIST KERANJANG

        $listKeranjang = Keranjang::with('barang')
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

        // CHECK IF SALDO IS ENOUGH
        if ((Int)$saldo->saldo < $total) {
            return response()->json(['status'=> false, 'message'=> 'Saldo tidak mencukupi untuk melanjutkan transaksi', 'data' => []]);
        }

        // INSERT DATA TO TABLE TRANSAKSI AND DELETE DATA KERANJANG
        foreach ($listKeranjang as $key => $value) {
            $param = [
                'id_user'       => request()->id_user,   
                'id_barang'     => $value->id_barang,
                'create_date'   => Carbon::now(),
                'total'         => $value->barang->harga,
                'active'        => 1,
                'quantity'      => $value->quantity,
                'no_antrian'    => $value->no_antrian
            ];

            // SAVE TRANSAKSI
            $save = Transaksi::create($param);
            // DELETE DATA KERANJANG
            $deleteKeranjang = Keranjang::where('id_barang', $value->id_barang)
                                ->where('id_user', request()->id_user)
                                ->where('no_antrian', request()->no_antrian)
                                ->delete();
            // UPDATE STOCK BARANG
            $updateStock = Barang::where('id', $value->id_barang)->first();
            $updateStock->stok = $updateStock->stok - $value->quantity;
            $updateStock->save();
        }

        // POTONG SALDO

        $cutSaldo = (new SaldoController)->cutSaldo(request()->id_user, $total);

        // UPDATE NO ANTRIAN

        $updateNoAntrian = (new AntrianController)->updateNoAntrian(request()->no_antrian);

        $totalTransaksi = [
            'saldo'          => $cutSaldo,
            'total_price'    => $total,
            'total_items'    => $items,
            'list_transaksi' => $listKeranjang,
        ];

        if ($totalTransaksi) {
            return response()->json(['status'=> true, 'message'=> 'Success', 'data' => $totalTransaksi]);
        }else{
            return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }
    }

}
