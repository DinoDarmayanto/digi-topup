@extends('main-admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Setelan kategori</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">/kategori</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <h4 class="mb-3 header-title mt-0">Tambah Kategori</h4>
        <form action="{{ route('kategori.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Nama</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" name="nama">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Sub Nama</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control @error('sub_nama') is-invalid @enderror" value="{{ old('sub_nama') }}" name="sub_nama">
                    @error('sub_nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Url</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode') }}" name="kode">
                    @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Brand</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" name="brand">
                    @error('brand')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Deskripsi Game</label>
                <div class="col-lg-10">
                    <textarea class="form-control @error('deskripsi_game') is-invalid @enderror" name="deskripsi_game">{{ old('deskripsi_game') }}</textarea>
                    @error('deskripsi_game')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Deskripsi Field User ID & Zone ID</label>
                <div class="col-lg-10">
                    <textarea class="form-control @error('deskripsi_field') is-invalid @enderror" name="deskripsi_field">{{ old('deskripsi_field') }}</textarea>
                    @error('deskripsi_field')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Membutuhkan Server ID?</label>
                <div class="col-lg-10 mt-1">
                    <input type="radio" id="customRadio1" name="serverOption" class="form-check-input" value="ya">
                    <label class="form-check-label" for="customRadio1">Ya</label>
                    <input type="radio" id="customRadio1" name="serverOption" class="form-check-input" value="tidak">
                    <label class="form-check-label" for="customRadio1">Tidak</label>
                    <input type="radio" id="customRadio1" name="serverOption" class="form-check-input" value="tidak">
                    <label class="form-check-label" for="customRadio1">Custom</label>
                    @error('serverOption')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Thumbnail</label>
                <div class="col-lg-10">
                    <input type="file" class="form-control" name="thumbnail">
                    @error('thumbnail')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Banner</label>
                <div class="col-lg-10">
                    <input type="file" class="form-control" name="banner">
                    @error('banner')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-lg-2 col-form-label" for="example-fileinput">Tipe</label>
                <div class="col-lg-10">
                    <select class="form-select" name="tipe">                
                        <option value='game'>Game</option>
                        <option value='voucher'>Voucher</option>
                        <option value='pulsa'>Pulsa</option>
                        <option value='e-money'>E-Money</option>
                        <option value='streamingapp'>Streaming APP</option>
                        <option value='joki'>Joki</option>
                    </select>
                    @error('tipe')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-1">Semua Kategori</h4>
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Sub Nama</th>
                                <th>Kode</th>
                                <th>Brand</th>
                                <th>Deskripsi Game</th>
                                <th>Deskripsi Field User ID & Zone ID</th>
                                <th>Status</th>
                                <th>Thumbnail</th>
                                <th>Banner</th>
                                <th>Aksi</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $data as $datas )
                            @php
                            $label_pesanan = '';
                            if($datas->status == "active"){
                            $label_pesanan = 'info';
                            }else if($datas->status == "unactive"){
                            $label_pesanan = 'warning';
                            }
                            @endphp
                            <tr>
                                <th scope="row">{{ $datas->id }}</th>
                                <td>{{ $datas->nama }}</td>
                                <td>{{ $datas->sub_nama }}</td>
                                <td>{{ $datas->kode }}</td>
                                <td>{{ $datas->brand }}</td>
                                <td>{{ $datas->deskripsi_game }}</td>
                                <td>{{ $datas->deskripsi_field }}</td>
                                <td>
                                    <div class="btn-group-vertical">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-{{$label_pesanan}} dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> {{ $datas->status }} <i class="mdi mdi-chevron-down"></i> </button>
                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <li><a class="dropdown-item" href="/kategori-status/{{ $datas->id }}/unactive">unactive</a></li>
                                            <li><a class="dropdown-item" href="/kategori-status/{{ $datas->id }}/active">active</a></li>

                                    </div>
                                </td>
                                <td>{{ $datas->thumbnail }}</td>
                                <td>{{ $datas->banner }}</td>
                                <td>
                                    <a href="javascript:;" onclick="modal('{{ $datas->nama }}', '{{ route('kategori.detail', [$datas->id]) }}')" class="btn-sm btn-info mb-3">Edit</a>
                                    <br>
                                     <br>
                                    <a class="btn-sm btn-danger mt-2" href="/kategori/hapus/{{ $datas->id }}">Hapus</a>
                                </td>
                                <td>{{ $datas->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
               
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.table').DataTable({
        });
    });
    
    function modal(name, link) {
        var myModal = new bootstrap.Modal($('#modal-detail'))
        $.ajax({
            type: "GET",
            url: link,
            beforeSend: function() {
                $('#modal-detail-title').html(name);
                $('#modal-detail-body').html('Loading...');
            },
            success: function(result) {
                $('#modal-detail-title').html(name);
                $('#modal-detail-body').html(result);
            },
            error: function() {
                $('#modal-detail-title').html(name);
                $('#modal-detail-body').html('There is an error...');
            }
        });
        myModal.show();
    }
</script>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modal-detail" style="border-radius:7%">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-detail-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-detail-body"></div>
        </div>
    </div>
</div>

@endsection