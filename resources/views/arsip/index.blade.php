@extends('layouts.index', ['title' => 'Arsip Laporan'])

@section('content')
<div class="content-wrapper">
    <div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Arsip Surat</h3>
                <h6 class="font-weight-normal mb-0">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan</h6>
                <h6 class="font-weight-normal mb-0">Klik "Lihat" pada kolom aksi untuk menampilkan surat</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card mt-5">
                <span class="text-center mr-1" style="margin-top: 13px;">Cari Surat: </span>
                <input type="text" name="judul" id="judul" class="form-control col-10">
                <button class="btn btn-primary ml-1" id="cari">Cari!</button>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Arsip</h4>
                  <div class="table-responsive">
                    <table class="table datatable">
                      <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nomor Surat</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Waktu Pengarsipan</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
                <a href="{{route('arsip.insert')}}">
                    <button class="btn btn-success">Arsipkan Surat</button>
                </a>
            </div>
        </div>
    </div>
    </div>
</div>
@stop

@section('footer')
<script type="text/javascript">  
    $(document).ready(function() {
        $('.datatable').DataTable({
            processing  : true,
            serverSide  : true,
            autowidth   : true,
            searching   : false,
            destroy     : true,
            ajax        : {
                url     : "{{url('api/Arsip/get-data')}}",
                method  : "GET"
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nomor_surat', name: 'nomor_surat'},
                {data: 'kategori', name: 'kategori'},
                {data: 'judul', name: 'judul'},
                {data: 'created_at', name: 'created_at'},
                {data: 'Actions', name: 'Actions'}
            ]
        });

        $('body').on('click', '#cari', function(e){
            e.preventDefault();
            let judul = $('#judul').val();
            if(judul != ''){
                $('.datatable').DataTable({
                    processing  : true,
                    serverSide  : true,
                    autowidth   : true,
                    searching   : false,
                    destroy     : true,
                    ajax        : {
                        url     : "{{url('api/Arsip/search-data')}}/"+judul,
                        method  : "GET"
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'nomor_surat', name: 'nomor_surat'},
                        {data: 'kategori', name: 'kategori'},
                        {data: 'judul', name: 'judul'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'Actions', name: 'Actions'}
                    ]
                })
            }else{
                $('.datatable').DataTable({
                    processing  : true,
                    serverSide  : true,
                    autowidth   : true,
                    searching   : false,
                    destroy     : true,
                    ajax        : {
                        url     : "{{url('api/Arsip/get-data')}}",
                        method  : "GET"
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'nomor_surat', name: 'nomor_surat'},
                        {data: 'kategori', name: 'kategori'},
                        {data: 'judul', name: 'judul'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'Actions', name: 'Actions'}
                    ]
                });
            }
        });
    }); 
</script>
<script type="text/javascript">
    function confirmDelete(id){
        swal({
            title: "Alert?",
            text: "Apakah Anda yakin ingin menghapus arsip surat ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                    url: "{{url('api/Arsip/delete')}}/"+id,
                    method: 'DELETE',
                    success: function (results) {
                        swal("Berhasil!", "Data Berhasil Dihapus!", "success");
                        $('.datatable').DataTable().ajax.reload();
                            setInterval(function(){ 
                        }, 1000);
                    },
                    error: function (results) {
                        swal("GAGAL!", "Gagal Menghapus Data!", "error");
                    }
                });
            } else {

            }
        });
    }
</script>
@stop