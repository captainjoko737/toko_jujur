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
                                    <th>NAMA</th>
                                    <th>USERNAME</th>
                                    <th>EMAIL</th>
                                    <th>ALAMAT</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>AKTIF</th>
                                    <th>RFID</th>
                                    <th>SALDO</th>
                                    <th>TGL REGISTRASI</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="width:5%;">No</th>
                                    <th>NAMA</th>
                                    <th>USERNAME</th>
                                    <th>EMAIL</th>
                                    <th>ALAMAT</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>AKTIF</th>
                                    <th>RFID</th>
                                    <th>SALDO</th>
                                    <th>TGL REGISTRASI</th>
                                    <th>AKSI</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($result as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value['nama'] }}</td>
                                        <td>{{ $value['username'] }}</td>
                                        <td>{{ $value['email'] }}</td>
                                        <td>{{ $value['alamat'] }}</td>
                                        <td>{{ $value['jenis_kelamin'] }}</td>
                                        <td>{{ $value['active'] }}</td>
                                        <td>{{ $value['rfid'] }}</td>
                                        <td>Rp. {{ number_format($value['saldo'], 2) }}</td>
                                        <td>{{ $value['created_at'] }}</td>
                                        <td>
                                            <a href="{{ route('pelanggan.saldo', ['id' => $value->id_user]) }}" data-toggle="tooltip" data-original-title="Topup Saldo" > <i class="fa fa-money m-r-10"></i> </a>
                                            <a href="{{ route('pelanggan.edit', ['id' => $value->id_user]) }}" data-toggle="tooltip" data-original-title="Edit" > <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                            <a onclick="drop({{$value->id_user}})" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash-o text-danger m-r-10"></i> </a>
                                        </td>
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
