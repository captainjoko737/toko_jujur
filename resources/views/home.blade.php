@extends('layouts.app')

@section('content')
<div class="page-wrapper">        
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card-header bg-default">
                <h4 class="m-b-0 text-black">{{ $title }}</h4>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="../assets/images/icon/income.png" alt="Income" /></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">Total Pendapatan</h6>
                                    <h2 class="m-t-0">Rp. {{ number_format($total_transaksi, 2) }}</h2></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="../assets/images/icon/expense.png" alt="Income" /></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">Total Saldo Deposit</h6>
                                    <h2 class="m-t-0">Rp. {{ number_format($total_deposit, 2) }}</h2></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="../assets/images/icon/assets.png" alt="Income" /></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">Total Barang</h6>
                                    <h2 class="m-t-0">{{ $total_barang }}</h2></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="../assets/images/icon/staff.png" alt="Income" /></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">Total Pelanggan Terdaftar</h6>
                                    <h2 class="m-t-0">{{ $total_pelanggan }}</h2></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
        