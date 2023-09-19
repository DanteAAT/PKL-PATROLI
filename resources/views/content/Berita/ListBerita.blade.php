@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Berita</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Berita</b> <small>Mengelola Berita</small>
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('berita/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Berita Baru</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Gambar Atau Video</th>
                            <th style='text-align:center'>Keterangan</th>
                            <th style='text-align:center'>Tanggal Mulai Tampil</th>
                            <th style='text-align:center'>Tanggal Terakhir Tampil</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($berita as $beritas)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                {{-- <td style='text-align:center' width='15%'>
                                <img src="{{asset('upload/'.$beritas->file)}}" alt="">
                                </td> --}}
                                <td style='text-align:center' width='15%'>
                                    @if (in_array(pathinfo($beritas->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img width="150px" src="{{ asset('upload/' . $beritas->file) }}" alt="">
                                    @elseif (in_array(pathinfo($beritas->file, PATHINFO_EXTENSION), ['mp4', 'webm']))
                                        <video width="150px" autoplay muted>
                                            <source src="{{ asset('upload/' . $beritas->file) }}" type="video/{{ pathinfo($beritas->file, PATHINFO_EXTENSION) }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        Format not supported.
                                    @endif
                                </td>
                                
                                <td style='text-align:center' width='10%'>{{ $beritas['information_berita'] }}</td>
                                <td style='text-align:center 'width='10%'>{{ $beritas['start_date_show'] }}</td>
                                <td style='text-align:center 'width='10%'>{{ $beritas['last_date_show'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/berita/edit/' . $beritas['berita_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/berita/detail/' . $beritas['berita_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/berita/hapus/' . $beritas['berita_id']) }}">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
