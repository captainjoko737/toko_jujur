<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use Hash;

class AuthController extends Controller {
    

    // LOGIN
    public function login() {

    	$validator = Validator::make(request()->all(), [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        $result = User::with('saldo')->where('email', request()->email)->first();

        if (!$result) {
        	return response()->json(['status'=> false, 'message'=> 'User tidak ditemukan atau belum terdaftar!', 'data' => []]);
        }

        if(!Hash::check(request()->password, $result->password)) {
		    return response()->json(['status'=> false, 'message'=> 'Password tidak cocok!', 'data' => []]);
		}

		return response()->json(['status'=> true, 'message'=> 'Berhasil login!', 'data' => [$result]]);
        
    }

    // REGISTER
    public function register() {

    	$validator = Validator::make(request()->all(), [
            'email'					=> 'required|unique:users',
			'password'				=> 'required|confirmed',
			'username'				=> 'required',
			'nama'					=> 'required',
			'alamat'				=> 'required',
			'jenis_kelamin'			=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        request()->merge(['confirmation_password']);
        $request = request()->all();
        $request['password'] = bcrypt(request()->password);
        $request['access'] = 0;
        $request['active'] = 'N';

        $save = User::create($request);

        if ($save) {
        	return response()->json(['status'=> true, 'message'=> 'Success', 'data' => [$save]]);
        }else{
        	return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }

    }

    // VERIFIKASI AKUN
    public function verifikasi() {

        $validator = Validator::make(request()->all(), [
            'id_user'    => 'required',
            'rfid'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> false, 'message'=> $validator->messages()->first(), 'data' => []]);
        }

        $result = User::where('id', request()->id_user)->first();

        $result->rfid = request()->rfid;
        $result->active = 'Y';
        $save = $result->save();

        if ($save) {
            return response()->json(['status'=> true, 'message'=> 'Success', 'data' => [$result]]);
        }else{
            return response()->json(['status'=> false, 'message'=> 'Something went wrong!', 'data' => []]);
        }

    }

}
