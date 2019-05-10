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
    
                        {!! Form::open(array('route' => 'barang.store','files'=>true)) !!}
                        <div class="form-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Kode</h5>
                                        <input type="text" id="kode" name="kode" class="form-control" style="width: 30%; height:56px;" required placeholder="Kode Barang" value="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Nama</h5>
                                        <input type="text" id="nama" name="nama" class="form-control" style="width: 30%; height:56px;" required placeholder="Nama Barang" value="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Harga</h5>
                                        <input type="text" id="harga" name="harga" class="form-control" style="width: 30%; height:56px;" required placeholder="Harga Barang" value="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Stok</h5>
                                        <input type="text" id="stok" name="stok" class="form-control" style="width: 30%; height:56px;" required placeholder="Stok Barang" value="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Berat</h5>
                                        <input type="text" id="berat" name="berat" class="form-control" style="width: 30%; height:56px;" required placeholder="Berat Barang" value="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photos</label>
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="file" name="photos"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                    </div>
                                </div>
                                
                            </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <a type="button" href="{{ route('barang.index') }}" class="btn btn-inverse">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script src="{{ url('assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>

@endsection


