<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang as MBarang;
use Auth;

class Barang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Data Barang';

        $result = MBarang::orderBy('created_at', 'DESC')->get();

        $data['result'] = $result;

        return view('barang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Data Barang';

        return view('barang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        $param = $request->all();

        if ($request->photos) {
            $fileName = '/assets/images/barang/'. md5($user->username) . '_'. time().'.'.$request->photos->getClientOriginalExtension();
            $param['photo']    = $fileName;
        }

        $save = MBarang::create($param);

        if ($save) {
            if ($request->photos) {
                $request->photos->move(base_path().'/public/assets/images/barang/', $fileName);
            }
            session()->flash('status', 'Barang berhasil ditambah!');
        }else{
            session()->flash('error', 'Maaf, Terjadi Kesalahan');
        }

        return redirect()->route('barang.index');

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
        $data['title'] = 'Edit Data Barang';

        $data['result'] = MBarang::where('id', $id)->first();

        return view('barang.edit', $data);
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

    public function save(request $request) {

        $user = Auth::user();

        $barang = MBarang::find($request->id);

        $barang['kode']     = $request->kode;
        $barang['nama']     = $request->nama;
        $barang['harga']    = $request->harga;
        $barang['stok']     = $request->stok;
        $barang['berat']    = $request->berat;
        $barang['active']   = $request->active;

        if ($request->photos) {
            $fileName = '/assets/images/barang/'. md5($user->username) . '_'. time().'.'.$request->photos->getClientOriginalExtension();
            $barang['photo'] = $fileName;
        }

        $barang->save();

        if ($barang) {

            if ($request->photos) {
                $request->photos->move(base_path().'/public/assets/images/barang/', $fileName);
            }

            session()->flash('status', 'Data barang berhasil diperbaharui!');
        }else{
            session()->flash('error', 'Terjadi kesalahan');
        }

        return redirect()->route('barang.index');

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

        $result = MBarang::find($request->id);
        $result->delete();

        session()->flash('status', 'Barang Berhasil dihapus!');
        return response()->json(['success'=>"Barang Deleted successfully.", 'tr'=>'tr_'.$request->id]);

    }
}
