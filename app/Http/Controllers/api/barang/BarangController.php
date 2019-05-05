<?php

namespace App\Http\Controllers\api\barang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;

class BarangController extends Controller {
    
    // GET DATA BARANG WHERE CODE
    public function getBarang() {

    	$validator = Validator::make(request()->all(), [
            'kode'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        $result = Barang::where('kode', request()->kode)->first();

        if (!$result) {
        	return response()->json(['status'=> true, 'message'=> 'Barang Tidak ditemukan', 'data' => []]);
        }else{
        	if ($result->stok == 0) {
        		return response()->json(['status'=> true, 'message'=> 'Stok barang habis', 'data' => []]);
        	}
        }

		return response()->json(['status'=> true, 'message'=> 'Success', 'data' => [$result]]);

    }

}
