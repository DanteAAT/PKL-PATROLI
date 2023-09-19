@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('berita') }}">Daftar Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Berita</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Detail Berita
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Detail
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('berita') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="post" action="/system-user/process-edit-system-user" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">ID Berita</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $berita['berita_id'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Gambar/Video Berita</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $berita->file }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Gambar/Video Berita</a>
                            <div class="image-or-video">
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
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tanggal Mulai Tampil</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $berita['start_date_show'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tanggal Terakhir Tampil</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $berita['last_date_show'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Keterangan</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $berita['information_berita'] }}" readonly />
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </form>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
