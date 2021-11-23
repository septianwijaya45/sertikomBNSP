@extends('layouts.index', ['title' => 'Detail Arsip '.$arsip->judul])

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Arsip Surat  >>  Lihat</h3>
                <h6 class="font-weight-normal mb-0">Nomor: {{$arsip->nomor_surat}}</h6>
                <h6 class="font-weight-normal mb-0">Kategori: {{$arsip->kategori}}</h6>
                <h6 class="font-weight-normal mb-0">Judul: {{$arsip->judul}}</h6>
                <h6 class="font-weight-normal mb-0">Waktu Unggah: {{$arsip->created_at}}</h6>
            </div>
        </div>
        <div class="row">
            <iframe src="{{url('berkas/'.$arsip->file)}}" frameborder="5" class="form-control mt-4" style="height: 700px"></iframe>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <a href="{{route('arsip.index')}}">
                    <button class="btn btn-primary"><<  Kembali</button>
                </a>
                <a href="{{route('arsip.download', $arsip->id)}}">
                    <button class="btn btn-warning">Unduh</button>
                </a>
                <a href="#">
                    <button class="btn btn-light">Edit/Ganti File</button>
                </a>
            </div>
        </div>
    </div>
    </div>
</div>
@stop