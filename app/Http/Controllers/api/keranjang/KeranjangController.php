<?php

namespace App\Http\Controllers\api\keranjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Keranjang;
use App\Models\Antrian;
use App\Models\Voucher;

class KeranjangController extends Controller
{
    
    // SAVE DATA TO KERANJANG
    public function postKeranjang() {
    	
    	$validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
            'id_barang'   => 'required',
            'quantity'    => 'required',
            'no_antrian'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        // CEK NOMOR ANTRIAN

        $antrian = Antrian::where('id', request()->no_antrian)->first();
        $masaBerlakuAntrian = $antrian->masa_aktif;
        $masaAktifAntrian = $antrian->active;

        if($masaBerlakuAntrian->lt(Carbon::now())){
            // DELETE DATA KERANJANG 
            $delete = Keranjang::where('no_antrian', request()->no_antrian)->delete();

		    return response()->json(['status'=> false, 'message'=> 'Masa Berlaku Nomor Antrian Telah Habis', 'data' => []]);
		}

        if($masaAktifAntrian == 'N'){
            // DELETE DATA KERANJANG 
            $delete = Keranjang::where('no_antrian', request()->no_antrian)->delete();

            return response()->json(['status'=> false, 'message'=> 'Masa Aktif Nomor Antrian Telah Habis', 'data' => []]);
        }

        $param = [
        	'id_user' 		=> request()->id_user,
			'id_barang'		=> request()->id_barang, 	
			'quantity'		=> request()->quantity, 	
			'no_antrian'	=> request()->no_antrian
        ];

        $save = Keranjang::create($param);

        if ($save) {
        	return response()->json(['status'=> true, 'message'=> 'Success', 'data' => [$save]]);
        }else{
        	return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }
    }

    // GET LIST KERANJANG
    public function getKeranjang() {
    	
    	$validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
            'no_antrian'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        $voucher = 0;
        $responseVoucher = Voucher::join('voucher', 'voucher.id', '=', 'transaksi_voucher.id_voucher')->where('transaksi_voucher.id_user', request()->id_user)->where('transaksi_voucher.no_antrian', null)->first();

        if ($responseVoucher) {
            $voucher = $responseVoucher->value;
        }

        $response = Keranjang::with('barang')
        ->where('id_user', request()->id_user)
        ->where('no_antrian', request()->no_antrian)
        ->get();

        $total = 0;
        $items = 0;
        foreach ($response as $key => $value) {
            $response[$key]['total'] = $value->barang->harga * $value->quantity;
            $total += (Int)$response[$key]['total'];
            $items += $value->quantity;
        }

        $result = [
        	'total_price'  => $total,
            'total_payment'  => $total - $voucher,
            'voucher'      => $voucher,
        	'total_item'   => $items,
        	'barang'	   => $response
        ];

        // return $result;

        if ($result) {
        	return response()->json(['status'=> true, 'message'=> 'Success', 'data' => [$result]]);
        }else{
        	return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }
    }
}
