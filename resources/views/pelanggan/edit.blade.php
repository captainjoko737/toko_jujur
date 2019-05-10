@extends('layouts.app')

@section('content')
   <div class="page-wrapper">
            
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header bg-default">
                        <h4 class="m-b-0 text-black">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif

                        {!! csrf_field() !!}
    
                        {!! Form::open(array('route' => 'pelanggan.save','files'=>true)) !!}
                        <div class="form-body">

                            <div class="row">
                                
                                
                                <input hidden type="hidden" id="id" name="id" class="form-control" style="width: 30%; height:56px;" required placeholder="Kode Barang" value="{{ $result->id }}">
                                 

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Nama</h5>
                                        <input type="text" id="nama" name="nama" class="form-control" style="width: 30%; height:56px;" required placeholder="Nama Pelanggan" value="{{ $result->nama }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Username</h5>
                                        <input type="text" id="username" name="username" class="form-control" style="width: 30%; height:56px;" required placeholder="Username Pelanggan" value="{{ $result->username }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Email</h5>
                                        <input type="text" id="email" name="email" class="form-control" style="width: 30%; height:56px;" required placeholder="Email Pelanggan" value="{{ $result->email }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Alamat</h5>
                                        <input type="text" id="alamat" name="alamat" class="form-control" style="width: 30%; height:56px;" required placeholder="Alamat Pelanggan" value="{{ $result->alamat }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>RFID</h5>
                                        <input type="text" id="rfid" name="rfid" class="form-control" style="width: 30%; height:56px;" required placeholder="RFID Pelanggan" value="{{ $result->rfid }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Jenis Kelamin</h5>
                                        <select class="select2 form-control custom-select" name="jenis_kelamin" style="width: 30%; height:56px;" required>
                                            <option>P</option>
                                            <option>W</option>
                                        </select>
                                    </div>
                                </div>  

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>AKTIF</h5>
                                        <select class="select2 form-control custom-select" name="active" style="width: 30%; height:56px;" required>
                                            <option>Y</option>
                                            <option>T</option>
                                        </select>
                                    </div>
                                </div>  

                                        
                            </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <a type="button" href="{{ route('pelanggan.index') }}" class="btn btn-inverse">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection


