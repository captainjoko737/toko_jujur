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
                    <!-- <div class="button pull-right">
                        <a type="button" class="btn btn-info btn-sm" href="{{ route('barang.create') }}"><i class="fa fa-plus"></i> Tambah </a>
                    </div> -->
                    @if (session('status'))
                        <div class="alert alert-success col-md-6">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger col-md-6">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:5%;">No</th>
                                    <th>NAMA PEMBELI</th>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>HARGA SATUAN</th>
                                    <th>QUANTITY</th>
                                    <th>HARGA TOTAL</th>
                                    <th>TGL TRANSAKSI</th>
                                    <th>NO ANTRIAN</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="width:5%;">No</th>
                                    <th>NAMA PEMBELI</th>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>HARGA SATUAN</th>
                                    <th>QUANTITY</th>
                                    <th>HARGA TOTAL</th>
                                    <th>TGL TRANSAKSI</th>
                                    <th>NO ANTRIAN</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($result as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value['nama_pembeli'] }}</td>
                                        <td>{{ $value['kode_barang'] }}</td>
                                        <td>{{ $value['nama_barang'] }}</td>
                                        <td>Rp. {{ number_format($value['total'], 2) }}</td>
                                        <td class="text-center">{{ $value['quantity'] }}</td>
                                        <td>Rp. {{ number_format($value['total'] * $value['quantity'], 2) }}</td>
                                        <td>{{ $value['created_at'] }}</td>
                                        <td class="text-center">{{ $value['no_antrian'] }}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function drop(id) {
        
        var data = {
                "id" : id};

        $(document).ready(function () {
            swal({   
                title: "Are you sure?",   
                text: "You will delete this data",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it !",   
                cancelButtonText: "No, cancel !",   
                closeOnConfirm: false,   
                closeOnCancel: false 
            }, function(isConfirm){   
                if (isConfirm) {    
                    
                    var href = $(this).attr('href');

                    $.ajax({

                        url: '{{ route("pelanggan.drop") }}',
                        data: data,
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                        success: function (data) {
                            // console.log(data);
                            location.reload();
                        }, error: function (data) {
                            alert(data.responseText);
                        }

                    });
                } else {     
                    swal("Cancelled", "Your data is safe :)", "error");   
                } 
            });
        
        });
    }
</script>
@endsection
