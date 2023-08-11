@extends('template.template')

@section('custom_style')


<style>
    .btn:disabled{background:#8ba4b1;border-color:#8ba4b1}
</style>


@endsection


@section('content')
@if(Auth::check())
    @if(Auth()->user()->role == 'Member' || Auth()->user()->role == 'Platinum' || Auth()->user()->role == 'Gold')
<nav class="navbar navbar-expand-lg d-flex fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="{{url('')}}{{ !$config ? '' : $config->logo_header }}" alt="" width="100" onclick="window.location='{{url('')}}'">
    </a>
    <div class="search-item">
                    <div class="">
                        <div class="nav-item dropdown">
                            <div class="input-group search-bar" aria-haspopup="true" id="dropsearchdown" aria-expanded="false">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" name="q" placeholder="Cari..." id="searchProds" class="form-control input-box" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="hasil-cari">
                <ul class="position-absolute resultsearch shadow dropdown-menu" aria-labelledby="dropsearchdown"></ul>
            </div>
    
            <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
              <span><i class="fa fa-bars-staggered text-light"></i></span>
            </button>
            <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                    <img src="{{url('')}}{{ !$config ? '' : $config->logo_header }}" alt="" width="100" onclick="window.location='{{url('')}}'">
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
		      <div class="offcanvas-body d-lg-none">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="{{url('')}}"><i class="fa-solid fa-house"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/cari')}}"><i class="fa-solid fa-magnifying-glass"></i> Cek Pesanan</a>
          </li>
                    <li class="nav-item">
            <a class="nav-link" href="{{url('/riwayat-pembelian')}}"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pembelian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/deposit')}}"><i class="fa-solid fa-wallet"></i> Top Up Saldo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/user/edit/profile')}}"><i class="fa-solid fa-user-pen"></i> Edit Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/membership')}}"><i class="fa-solid fa-circle-up"></i> Upgrade Membership</a>
          </li>
          <div class="card bg-card mt-2 mb-2">
            <div class="card-body">
                <span class="py-1 px-2 float-end rounded bg-warning text-dark" style="font-size: 12px;">{{Str::title(Auth()->user()->role)}}</span>
                <h5 class="card-title">{{Str::title(Auth()->user()->name)}}</h5>
                <p class="card-text">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</p>
             </div>
          </div>
                    
          <div class"mt-2">
                                                          </div>
                        <button onclick="logout();" class="btn bg-white border-0 text-danger mt-2">Logout</button>
                    </ul>
    </div>
  </div>
    <div class="collapse navbar-collapse text-right d-none d-md-none d-lg-block">
      <div class="navbar-nav ms-auto nav-stacked">
        <a class="nav-link" href="{{url('')}}"><i class="fa-solid fa-house"></i> Home</a>
        <a class="nav-link" href="{{url('/cari')}}"><i class="fa-solid fa-magnifying-glass""></i> Cek Pesanan</a>
        <a class="nav-link text-primary" href="{{url('/dashboard')}}"><i class="fa-solid fa-arrow-right-to-bracket""></i> Dashboard</a>
</div>
  </div>
</nav>
@else
<nav class="navbar navbar-expand-lg d-flex fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="{{url('')}}{{ !$config ? '' : $config->logo_header }}" alt="" width="100" onclick="window.location='{{url('')}}'">
    </a>
    <div class="search-item">
                    <div class="">
                        <div class="nav-item dropdown">
                            <div class="input-group search-bar" aria-haspopup="true" id="dropsearchdown" aria-expanded="false">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" name="q" placeholder="Cari..." id="searchProds" class="form-control input-box" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="hasil-cari">
                <ul class="position-absolute resultsearch shadow dropdown-menu" aria-labelledby="dropsearchdown"></ul>
            </div>
    
            <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
              <span><i class="fa fa-bars-staggered text-light"></i></span>
            </button>
            <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                    <img src="{{url('')}}{{ !$config ? '' : $config->logo_header }}" alt="" width="100" onclick="window.location='{{url('')}}'">
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
		      <div class="offcanvas-body d-lg-none">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="{{url('')}}"><i class="fa-solid fa-house"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/cari')}}"><i class="fa-solid fa-magnifying-glass"></i> Cek Pesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-primary" href="{{url('/dashboard')}}"><i class="fa-solid fa-arrow-right-to-bracket"></i> Dashboard</a>
          </li>
                    </ul>
    </div>
  </div>
    <div class="collapse navbar-collapse text-right d-none d-md-none d-lg-block">
      <div class="navbar-nav ms-auto nav-stacked">
        <a class="nav-link" href="{{url('')}}"><i class="fa-solid fa-house"></i> Home</a>
        <a class="nav-link" href="{{url('/cari')}}"><i class="fa-solid fa-magnifying-glass""></i> Cek Pesanan</a>
        <a class="nav-link text-primary" href="{{url('/dashboard')}}"><i class="fa-solid fa-arrow-right-to-bracket""></i> Dashboard</a>
</div>
  </div>
</nav>
@endif
@else

<nav class="navbar navbar-expand-lg d-flex fixed-top shadow">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
        <img src="{{url('')}}{{ !$config ? '' : $config->logo_header }}" alt="" width="100" onclick="window.location='{{url('')}}'">
    </a>
    <div class="search-item">
                    <div class="">
                        <div class="nav-item dropdown">
                            <div class="input-group search-bar" aria-haspopup="true" id="dropsearchdown" aria-expanded="false">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" name="q" placeholder="Cari..." id="searchProds" class="form-control input-box" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="hasil-cari">
                <ul class="position-absolute resultsearch shadow dropdown-menu" aria-labelledby="dropsearchdown"></ul>
            </div>
    
            <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
              <span><i class="fa fa-bars-staggered text-light"></i></span>
            </button>
            <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                    <img src="{{url('')}}{{ !$config ? '' : $config->logo_header }}" alt="" width="100" onclick="window.location='{{url('')}}'">
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
		      <div class="offcanvas-body d-lg-none">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="{{url('')}}"><i class="fa-solid fa-house"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/cari')}}"><i class="fa-solid fa-magnifying-glass"></i> Cek Pesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/login')}}"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
          </li>
                    </ul>
    </div>
  </div>
    <div class="collapse navbar-collapse text-right d-none d-md-none d-lg-block">
      <div class="navbar-nav ms-auto nav-stacked">
        <a class="nav-link" href="{{url('')}}"><i class="fa-solid fa-house"></i> Home</a>
        <a class="nav-link" href="{{url('/cari')}}"><i class="fa-solid fa-magnifying-glass""></i> Cek Pesanan</a>
         <a class="nav-link" href="{{url('/login')}}"><i class="fa-solid fa-arrow-right-to-bracket""></i> Login</a>
</div>
  </div>
</nav>
@endif
<div class="content-body" style="height: auto;">
			<div class="px-3 pt-3 mb-2">
				@if(session('error'))
			    
			    <div class="alert alert-danger">
			       <ul>
			           <li>{{session('error')}}</li>
			       </ul>
			    </div>
			    
			    @endif
			    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
						  <div class="alert alert-info">
		            <b>Harap Dibayar Sebelum {{ $expired }}</b><br> Segera lakukan pembayaran sesuai dengan kode bayar / nomor VA yang tercantum. Pastikan nominal pembayaran juga sesuai dengan total bayar.
		          </div>
                @if(Str::upper($data->metode_pembayaran) == "QRIS" || Str::upper($data->metode_pembayaran) == "QRISC" || Str::upper($data->metode_pembayaran) == "QRIS2" || Str::upper($data->metode_pembayaran) == "QRISOP" || Str::upper($data->metode_pembayaran) == "QRISCOP" )
                              <div id="qris-payment">
                                  <center><img src="{{$data->no_pembayaran}}" width="300"></center>
                                  <center><span class="badge bg-danger text-center mt-3">Scan QR Code diatas ini</span></center>
                              </div>
                            @endif
				
				<div class="row mt-3">
        			    <div class="col-12 col-md-4 col-lg-4">
            				<div class="card bg-card mb-3">
            				    <div class="card-body">
            				        <div>
						            	<span class="d-block">Tanggal Pembelian</span>
            				            <b class="">{{ $data->created_at }}</b>
            				        </div>
                                          <div class="mt-2">
            				            <span class="d-block">Batas Pembayaran</span>
            				            <b class="">{{ $expired }}</b>
            				        </div>
                                         <div class="mt-2">
            				            <span class="d-block">Nomor Pesanan</span>
            				            <b class="">{{ $data->id_pembelian }}</b>
            				        </div>
            				        <div class="mt-2">
            				            <span class="d-block">Metode Pembayaran</span>
            				            <b class="text-info">{{ $data->metode_pembayaran }}</b>
            				        </div>
                                         <div class="mt-2">
            				            <span class="d-block">Kode Bayar / Nomor VA</span>
                                        @if(Str::upper($data->metode_pembayaran) == "QRIS" || Str::upper($data->metode_pembayaran) == "QRISC" || Str::upper($data->metode_pembayaran) == "QRIS2" || Str::upper($data->metode_pembayaran) == "QRISOP" || Str::upper($data->metode_pembayaran) == "QRISCOP" )
							            <a class="btn btn-primary btn-sm" href="#qris-payment">Lihat QRIS</a>
							        @elseif(Str::upper($data->metode_pembayaran) == "SHOPEEPAY")
							            <a class="btn btn-primary btn-sm" href="{{$data->no_pembayaran}}">KLIK UNTUK BAYAR VIA SHOPEEPAY</a>
							        @else
							            <b class="text-danger">{{ $data->no_pembayaran }}</b>
							        @endif
							              </div>
							<div class="mt-2">
            				            <span class="d-block">Status Pembayaran</span>
								            @if($data->status_transaksi !== 'joki')
								@if($data->status_pembelian == "Pending")
								<b class="text-warning">Menunggu Pembayaran</b>
								@elseif($data->status_pembelian == "Processing")
								<b class="text-info">Sedang Diproses</b>
								@elseif($data->status_pembelian == "Batal")
								<b class="text-danger">Pembayaran Batal</b>
								@elseif($data->status_pembelian == "Sukses")
								<b class="text-success">Pembayaran Berhasil</b>
								@endif
								@else
								@if($data->status_pembayaran == "Belum Lunas")
								<b class="text-warning">Menunggu Pembayaran</b>
								@elseif($data->status_pembayaran == "Batal")
								<b class="text-danger">Pembayaran Batal</b>
								@elseif($data->status_pembayaran == "Lunas")
								<b class="text-success">Pembayaran Berhasil</b>
								@endif
								@endif
                        </div>
                        </div>
            				    <div class="card-footer">
            				        <table class="table table-clear text-white">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                        <strong>Total Pembayaran :</strong>
                                        </td>
                                        <td class="right text-right">
                                        <strong style="color:lime;">
                                        Rp.
                                        <span>
                                        {{ number_format($data->harga_pembayaran, 0, ',','.') }},-
                                        </span>
                                        </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
            				    </div>
            				</div>
        				</div>
        <div class="col-12 col-md-6 col-lg-8">
            				<div class="card bg-card mb-3">
            				    <div class="card-body">
            				        
                                    <div class="">
            				            <b class="">Detail Pembelian</b>
            				        </div>
            				        <div class="mt-2">
            				            <span class="d-block">Item</span>
            				            <b class="">{{ $data->layanan }}</b>
            				        </div>
            				        <div class="mt-2">
            				            <span class="d-block">User ID</span>
            				            <b class="">{{ $data->user_id }}  {{ $data->zone != null ? "(".$data->zone.")" : ''  }}</b>
            				        </div>
            				        <div class="mt-2">
            				            <span class="d-block">Username</span>
            				            <b class="">{{ $data->nickname }}</b>
            				        </div>
            				        <div class="mt-2">
            				            <span class="d-block">Status Pembelian</span>
            			@if($data->status_transaksi !== 'joki')
								@if($data->status_pembelian == "Pending")
								<b class="text-warning">Pending</b>
								@elseif($data->status_pembelian == "Processing")
								<b class="text-info">Diproses</b>
								@elseif($data->status_pembelian == "Batal")
								<b class="text-danger">Batal</b>
								@elseif($data->status_pembelian == "Sukses")
								<b class="text-success">Sukses</b>
								@endif
								@else
								@if($data->status_pembayaran == "Belum Lunas")
								<b class="text-warning">Pending</b>
								@elseif($data->status_pembayaran == "Batal")
								<b class="text-danger">Batal</b>
								@elseif($data->status_pembayaran == "Lunas")
								<b class="text-success">Sukses</b>
								@endif
								@endif
                                                                                                				        </div>
            				        
                                </div>
            				</div>
        				</div>
        </div>
        <div class="card bg-card">
				          <div class="card-body">
				              <div class="card-title">
				                  <h4>Pesanan Belum Masuk ?</h4>
				                  <p>Hubungi customer service kami untuk melakukan konfirmasi pesanan</p>
				              </div>
				              <a class="btn btn-primary btn-sm w-100 rounded" href="{{ !$config ? '' : $config->url_wa }}">Hubungi Kami</a>
				          </div>
				      </div>  
				
			</div>
			
					</div>
        
        






@push('custom_script')



@endpush




@endsection