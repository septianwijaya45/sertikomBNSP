@extends('layouts.index', ['title' => 'Arsip Laporan'])

@section('content')
<div class="content-wrapper">
    <div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Arsip Surat  >>  Unggah</h3>
                <h6 class="font-weight-normal mb-0">Unggah arsip yang telah terbit pada form ini untuk diarsipkan</h6>
                <h6 class="font-weight-normal mb-0">Catatan: </h6>
                <h6 class="font-weight-normal mb-0">
                    <ul>
                        <li>Gunakan file berformat PDF</li>
                    </ul>
                </h6>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data" id="formTambahData">
                      @csrf
                    <div class="row" id="error_message">
                    </div>
                    <div class="form-group">
                          <div class="row">
                              <div class="col-md-2">
                                  <label for="nomor_surat">Nomor Surat</label>
                              </div>
                              <div class="col-md-10">
                                  <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat">
                              </div>
                          </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="kategori">Kategori</label>
                            </div>
                            <div class="col-md-10">
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="" disabled selected> --- Pilih Kategori Surat --- </option>
                                    <option value="Undangan">Undangan</option>
                                    <option value="Pengumuman">Pengumuman</option>
                                    <option value="Nota Dinas">Nota Dinas</option>
                                    <option value="Pemberitahuan">Pemberitahuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                          <div class="row">
                              <div class="col-md-2">
                                  <label for="judul">Judul</label>
                              </div>
                              <div class="col-md-10">
                                  <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul">
                              </div>
                          </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>File upload</label>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group col-xs-12">
                                  <input type="file" class="form-control" name="file"  placeholder="Upload File">
                                  <span class="input-group-append">
                                    <button class="btn btn-primary" type="button">Upload</button>
                                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('arsip.index')}}" class="btn btn-light">
                        << Kembali
                    </a>
                    <button type="submit" class="btn btn-primary mr-2" id="simpanTambahData">Simpan</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    </div>
</div>
@stop

@section('footer')
<script type="text/javascript">
    $('#formTambahData').on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('arsip.store') }}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                if (result.errors) {
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        swal("Gagal!", 'Gagal Menambahkan Data Arsip!',
                            "error");
                        $('#error_message').append(
                            '<div class="col-md-3"><div class="alert alert-danger">' +
                            value + '</div></div>')
                        setInterval(function() {
                            $('#error_message').empty();
                        }, 4000);
                    });
                } else {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    swal("Berhasil!", "Berhasil Menambahkan Data Arsip!", "success");
                    setInterval(function(){
                        window.location = "{{route('arsip.index')}}"
                    })
                }
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(kode_brg, error) {
                    $(document).find('[name=' + kode_brg + ']').after(
                        '<span class="text-strong text-danger">' + error +
                        '</span>')
                })
            }
        });
    });
</script>
@stop