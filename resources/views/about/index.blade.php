@extends('layouts.index', ['title' => 'About Me'])

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">About</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2 grid-margin stretch-card">
                <img src="{{asset('image/1931733056.jpeg')}}" height="280px">
        </div>
        <div class="col-10 grid-margin">
            <h6 class="font-weight-normal mb-0">Aplikasi ini dibuat oleh:</h6>
            <h6 class="font-weight-normal mb-0">Nama : Septian Wijaya Aminulloh</h6>
            <h6 class="font-weight-normal mb-0">NIM: 1931713056</h6>
            <h6 class="font-weight-normal mb-0">Tanggal: 22 November 2021</h6>
        </div>
    </div>
</div>
@stop