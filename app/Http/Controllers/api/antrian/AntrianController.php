<?php

namespace App\Http\Controllers\api\antrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Antrian;

class AntrianController extends Controller
{
    
    public function getNomorAntrian() {

    	$validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        $date = \Carbon\Carbon::now();

        $kedatangan = $date->format('H:i:s');
        $masaAktif 	= $date->addMinutes(15)->format('Y-m-d H:i:s');
     
        $param = [
        	'id_user' 		=> request()->id_user,
			'kedatangan'	=> $kedatangan, 	
			'masa_aktif'	=> $masaAktif, 	
			'active'		=> 1,
			'tanggal'		=> \Carbon\Carbon::now()->format('Y-m-d')
        ];

        $save = Antrian::create($param);

        if ($save) {
        	$save['nomor_antrian'] = $save->id;
        	return response()->json(['status'=> true, 'message'=> 'Success', 'data' => [$save]]);
        }else{
        	return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }

    }

}
