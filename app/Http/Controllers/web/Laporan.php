<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang as MBarang;
use App\Models\Saldo as MSaldo;
use App\Models\Transaksi;
use Auth;

class Laporan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Laporan Penjualan';

        $result = Transaksi::join('users', 'users.id', '=', 'transaksi.id_user')
                        ->orderBy('users.created_at', 'DESC')
                        ->select('users.nama as nama_pembeli', 'transaksi.*')
                        ->get();

        $data['result'] = $result;
// return $data;
        return view('laporan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Data Pelanggan';

        $data['result'] = User::where('id', $id)->first();

        return view('pelanggan.edit', $data);
    }

    public function save(request $request) {

        $user = Auth::user();

        $users = User::find($request->id);

        $users['nama']          = $request->nama;
        $users['username']      = $request->username;
        $users['email']         = $request->email;
        $users['alamat']        = $request->alamat;
        $users['rfid']          = $request->rfid;
        $users['jenis_kelamin'] = $request->jenis_kelamin;
        $users['active']        = $request->active;

        $users->save();

        if ($users) {
            session()->flash('status', 'Data Pelanggan berhasil diperbaharui!');
        }else{
            session()->flash('error', 'Terjadi kesalahan');
        }

        return redirect()->route('pelanggan.index');

    }

    public function saldo($id) {

        $data['title'] = 'Data Saldo Pelanggan';

        $saldo = MSaldo::where('id_user', $id)->first();

        $totalSaldo = 0;

        if ($saldo) {
            $totalSaldo = $saldo->saldo;    
        }

        $data['saldo'] = $totalSaldo;
        $data['id_user'] = $id;

        return view('pelanggan.saldo', $data);

    }

    public function postSaldo(request $request) {

        // return $request->all();

        $saldo = MSaldo::where('id_user', $request->id)->first();

        if ($saldo) {
            $saldo['saldo'] = $request->totalSaldo + $request->saldo;
            $save = $saldo->save();
        }else{
            $param = [
                'id_user' => $request->id,
                'saldo'   => $request->saldo
            ];

            $save = MSaldo::create($param);
        }

        if ($save) {
            session()->flash('status', 'Top Up Saldo berhasil!');
        }else{
            session()->flash('error', 'Terjadi kesalahan');
        }

        return redirect()->route('pelanggan.index');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function drop(request $request) {

        $result = User::find($request->id);
        $result->delete();

        session()->flash('status', 'Pelanggan Berhasil dihapus!');
        return response()->json(['success'=>"Pelanggan Deleted successfully.", 'tr'=>'tr_'.$request->id]);

    }

}
