<?php

namespace App\Http\Controllers\api\saldo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Saldo;

class SaldoController extends Controller
{
    public function getSaldo() {

    	$validator = Validator::make(request()->all(), [
            'id_user'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        $result = Saldo::where('id_user', request()->id_user)->first();

        if (!$result) {
        	return response()->json(['status'=> true, 'message'=> 'Success', 'data' => [['saldo' => 0]]]);
        }

		return response()->json(['status'=> true, 'message'=> 'Berhasil login!', 'data' => [['saldo' => $result->saldo]]]);

    }
}
