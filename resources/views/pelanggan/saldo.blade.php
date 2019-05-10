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
    
                        {!! Form::open(array('route' => 'pelanggan.postSaldo','files'=>true)) !!}
                        <div class="form-body">

                            <div class="row">
                                
                                
                                <input hidden type="hidden" id="id" name="id" class="form-control" style="width: 30%; height:56px;" required placeholder="Kode Barang" value="{{ $id_user }}">
                                 

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Total Saldo</h5>
                                        <input type="text" id="totalSaldo" name="totalSaldo" class="form-control" style="width: 30%; height:56px;" required placeholder="Total Saldo" readonly value="Rp. {{ number_format($saldo, 2) }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Top Up Saldo</h5>
                                        <input type="text" id="saldo" name="saldo" class="form-control" style="width: 30%; height:56px;" required placeholder="Masukkan Nominal Top Up Saldo" value="">
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


