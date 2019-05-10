<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang as MBarang;
use App\Models\Saldo as MSaldo;
use App\Models\Transaksi;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['title'] = 'Beranda';

        $transaksi = Transaksi::all();

        $totalTransaksi = 0;
        foreach ($transaksi as $key => $value) {
            $totalTransaksi += $value->total * $value->quantity;
        }

        $user = User::where('access', 0)->count();

        $totalBarang = MBarang::count();

        $saldo = MSaldo::all();

        $totalDeposit = 0;

        foreach ($saldo as $key => $value) {
            $totalDeposit += $value->saldo;
        }

        $data['total_transaksi'] = $totalTransaksi;
        $data['total_pelanggan'] = $user;
        $data['total_barang']    = $totalBarang;
        $data['total_deposit']   = $totalDeposit;


        return view('home', $data);
    }
}
