@extends('main-admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Data Joki</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">/Data Joki</li>
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
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table m-o">
                        <thead>
                            <tr>
                                <th>OID</th>
                                <th>Nomor</th>
                                <th>Layanan</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Login Via</th>
                                <th>Nickname</th>
                                <th>Request</th>
                                <th>Catatan</th>
                                <th>Status Joki</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($data as $datas)
                            @php
                            $label_pesanan = '';
                            if($datas->status_joki == "Sukses"){
                            $label_pesanan = 'success';
                            }else{
                            $label_pesanan = 'danger';
                            }
                            @endphp
                            
                           
                           <tr>
                               <th scope="row">#{{ $datas->order_id }}</th>
                               <td>{{ $datas->nomor }}</td>
                               <td>{{ $datas->layanan }}</td>
                               <td>{{ $datas->email }}</td>
                               <td>{{ $datas->password }}</td>
                               <td>{{ $datas->loginvia }}</td>
                               <td>{{ $datas->nickname }}</td>
                               <td>{{ $datas->request }}</td>
                               <td>{{ $datas->catatan }}</td>
                               <td>
                                   <div class="btn-group-vertical">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-{{$label_pesanan}} dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> {{ $datas->status_joki }} <i class="mdi mdi-chevron-down"></i> </button>
                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <li><a class="dropdown-item" href="/joki-status/{{ $datas->order_id }}/Sukses">Sukses</a></li>
                                            <li><a class="dropdown-item" href="/joki-status/{{ $datas->order_id }}/Proses">Proses</a></li>
                                    </div>
                               </td>
                               <td>
                                    <a class="btn btn-danger" href="/joki/hapus/{{ $datas->id }}">Hapus</a>
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
<script>
    $(document).ready(function(){
        $('.table').DataTable({
        });
    });
</script>
@endsection