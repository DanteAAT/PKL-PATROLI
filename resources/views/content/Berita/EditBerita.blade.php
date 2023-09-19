@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('berita') }}">Daftar Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Berita</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Edit Berita
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Edit
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('berita') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
            </div>
        </div>

        <form method="post" action="{{ url('/berita/edit/process/' . $berita['berita_id']) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Pilih File<a class='red'> *</a></a>
                            {{-- <input class="form-control" type="file" name="file" accept="image/*, video/*" id="" value="{{ $berita['file'] }}"/> --}}
                            <input class="form-control" type="file" name="file" accept="image/*, video/*"
                                id="fileInput" />
                            <input type="hidden" name="existing_file" value="{{ $berita['file'] }}" />
                            {{-- <button type="button" id="populateFileInput">Populate File</button> --}}
                            @if (in_array(pathinfo($berita->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                <img width="150px" src="{{ asset('upload/' . $berita->file) }}" alt="">
                            @elseif (in_array(pathinfo($berita->file, PATHINFO_EXTENSION), ['mp4', 'webm']))
                                <video width="150px" autoplay muted>
                                    <source src="{{ asset('upload/' . $berita->file) }}"
                                        type="video/{{ pathinfo($berita->file, PATHINFO_EXTENSION) }}">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                Format not supported.
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tanggal Mulai Tampil<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="date" name="start_date_show" id="latitude"
                                value="{{ $berita['start_date_show'] }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tanggal Terakhir Tampil<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="date" name="last_date_show" id="longitude"
                                value="{{ $berita['last_date_show'] }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Keterangan<a class='red'> *</a></a>
                            <textarea name="information_berita" id="location_information" cols="20" rows="5"
                                class="form-control input-bb">{{ $berita['information_berita'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                            class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i>
                        Simpan</button>
                </div>
            </div>
    </div>
    </div>
    </form>

    <script>
        // Menambahkan event listener ke tombol "Populate File"
        document.getElementById('populateFileInput').addEventListener('click', function() {
            var existingFileValue = document.querySelector('input[name="existing_file"]').value;
            if (existingFileValue) {
                var fileInput = document.getElementById('fileInput');
                var existingFile = new File([existingFileValue], existingFileValue);
                fileInput.files = new FileList([existingFile]);
            } else {
                alert('No existing file value to populate.');
            }
        });
    </script>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
