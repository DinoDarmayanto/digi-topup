@extends('template.template')

@section('custom_style')


<style>
        .accordion-button {
            box-shadow:none!important;
        }
        .accordion-tipe{
            font-weight:600;
        }
        .btn.disabled,.btn:disabled,fieldset:disabled{
            background:#8ba4b1;border-color:#8ba4b1;
        }
        .product .box{
            margin-bottom:40px;
        }
        .games-banner{
            height:170px;
            background:url({{ $kategori->banner }});
            background-size:cover;
            background-repeat:no-repeat;
            background-size:100%;
        }
        .num-page{
            margin-bottom:10px;
        }
        .num-page div{
            width:40px;
            height:40px;
            border-radius:50%;
            text-align:center;
            font-size:1.875rem;
            background:var(--warna_3);
            color:#fff;
            line-height:40px;
            float:left;
        }
        .num-page p{
            margin-left:5px;
            display:inline-block;
            font-size:1.25rem;
            font-weight:500;
            padding-top:6px;
        }
        .num-page i {
            font-size: 16px;
            margin-top:13px;
            margin-left:5px;
        }
        
        button.accordion-button{
            outline:none!important;
            border:none!important;
            box-shadow:none!important;
        }
        .box-back i{
            font-size:22px;
            margin-top:2px;
            color:#fff;
        }
        .product-list{
            border-radius:.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow:hidden;
            border:1px solid var(--warna_3)!important;
        }
        .product-list b{
            font-size:.85rem;font-weight:600;
        }
        .product-list span{
            font-size:11px;color:#fff;
        }
        .product-list.active{
            background: var(--warna_3);
            border:1px solid var(--warna_3)!important;
        }
        .product-list.active:before{
            display:inline-block;
            content:'L';
            position:relative;
            background:#212121;
            margin-left:-20px;
            height:53px;
            line-height:40px;
            width:20px;
            text-align:center;
            color:#fff;
            top:-23px;
            transform:rotate(45deg) scaleX(-1);
        }
        .product-list.active b{
            margin-top:-53px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: 0;
            margin-left: 0;
        }
        .bg-product {
            background: var(--warna_3);
        }
        .panduan {
            color: var(--warna_4);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
        .swal2-styled.swal2-confirm {
            background-color: var(--warna_2)!important;
            color: #fff;
        }
        .swal2-styled.swal2-confirm:focus {
            box-shadow: none!important;
        }
        .product-list img {
            display: flex;
            float: right;
            margin-top: -12px;
        }
        .productlogo {
            width: 32px;
            right: 5%;
        }
        .accordion-button:hover {
            z-index: 0;
        }
        .bg-payment {
            background: #E6E7EB;
        }
        .method-list.active {
            border-color: #3b3b3b!important;
        }
        .method-list.active:before {
            background: #3b3b3b!important;
        }
        
        .btn-order {
            display: inline-block;
            border: 0;
            outline: 0;
            padding: 12px 16px;
            line-height: 1.4;
            cursor: pointer;
            /* Important part */
            position: relative;
            transition: padding-right .3s ease-out;
                    
                }
                
        .btn-order.loading {
            padding-right: 40px;
        }
        
        .btn-order.loading:after {
            content: "";
            position: absolute;
            border-radius: 100%;
            right: 10px;
            top: 35%;
            width: 0px;
            height: 0px;
            border: 2px solid rgba(255,255,255,0.5);
            border-left-color: #FFF;
            border-top-color: #FFF;
            animation: spin .6s infinite linear, grow .3s forwards ease-out;
        }
        @keyframes  spin { 
            to {
                transform: rotate(359deg);
            }
        }
        @keyframes  grow { 
            to {
                width: 16px;
                height: 16px;
            }
        }
        
        .shadow-form {
            box-shadow: 0 4px 80px hsla(0,0%,77%,.13), 0 1.6711px 33.4221px hsla(0,0%,77%,.093), 0 0.893452px 17.869px hsla(0,0%,77%,.077), 0 0.500862px 10.0172px hsla(0,0%,77%,.065), 0 0.266004px 5.32008px hsla(0,0%,77%,.053), 0 0.11069px 2.21381px hsla(0,0%,77%,.037);
        }
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
<div class="content-body">
        <div class="row">
        <div class="col-lg-4">
            <div class="card bg-card border-0 mb-4 shadow-form">
                <div class="games-banner rounded-top"></div>
        		<div class="col-12 px-3 pb-2">
        			<img src="{{ $kategori->thumbnail  }}" alt="" width="100" class="float-start mr-2" style="border-radius: 16px; margin-top: -50px;">
        			<div class="col-8 mt-2 mt-lg-0 float-end">
        		        <h4>{{$kategori->nama}}</h4>
        		    </div>
        		</div>
        		<div class="col px-3 mb-4">
        		    <small style="font-size: 14px;">{!! $kategori->deskripsi_game !!}</small>
        		</div>
    		</div>
    	</div>
		<div class="col-lg-8">
		<form class="my-form" id="form-order" name="my-form">
            <input type="hidden" id="nominal">
            <input type="hidden" id="metode">
            <input type="hidden" id="ktg_tipe" value="{{$kategori->tipe}}">
        	
        <div class="card bg-card border-0 mb-4 shadow-form">
    			<div class="px-3 py-3">
    				<div class="d-flex border-bottom w-full num-page">
    					<div>1</div>
    					<p class="d-flex">Informasi Pesanan</p>
    				</div>
				<div class="row">
                    @if($kategori->server_id && $kategori->kode != "life-after" && $kategori->kode != "genshin-impact" && $kategori->kode != "ragnarok-m" && $kategori->kode != "tof")
					
					<div class="col-6">
						<input type="text" class="form-control" placeholder="Masukkan User ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					<div class="col-6">
						<input type="text" class="form-control" placeholder="Masukkan Server ID" name="zone_id" id="zone" autocomplete="off">
					</div>
					@elseif($kategori->kode == "life-after")
					<div class="col-6">
						<input type="text" class="form-control" placeholder="Masukkan User ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					<div class="col-6">
						<select class="form-control" id="zone">
						  <option value="">Pilih Server</option>
						  <option value="miskatown">Miska Town</option>
                          <option value="sandcastle">Sand Castle</option>
                          <option value="mouthswamp">Mouth Swamp</option>
                          <option value="redwoodtown">Red Wood Town</option>
                          <option value="obelisk">Oblisk</option>
                          <option value="fallforest">Fall Forest</option>
                          <option value="mountsnow">Mount Snow</option>
                          <option value="nancycity">Nancy City</option>
                          <option value="charlestown">Charles Town</option>
                          <option value="snowhighlands">Snow High Lands</option>
                          <option value="santopany">Santopany</option>
                          <option value="levincity">Levin City</option>
                          <option value="newland">New Land</option>
                          <option value="milestone">Mile Stone</option>
                          <option value="twinislands">Twin Island</option>
                          <option value="500007">ChaosOutpost (NA)</option>
                          <option value="500008">IronStride (NA)</option>
                          <option value="520007">ChaosCity (SEA)</option>
                          <option value="520008">TwinIslands (SEA)</option>
                          <option value="520009">HopeWall (SEA)</option>
                          <option value="500009">CrystalthornSea (NA)</option>
                          <option value="520010">LabyrinthSea (SEA)</option>
						</select>
					</div>
					
					@elseif($kategori->kode == "tof")
					
					<div class="col-6">
						<input type="text" class="form-control" placeholder="Masukkan User ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					
					<div class="col-6">
						<select class="form-control" id="zone">
						    <option value="">Pilih Server</option>
                            <option value="Southeast Asia-Osillron">Southeast Asia-Osillron</option>
                            <option value="Southeast Asia-Mistilteinn">Southeast Asia-Mistilteinn</option>
                            <option value="Southeast Asia-Illyrians">Southeast Asia-Illyrians</option>
                            <option value="Southeast Asia-Florione">Southeast Asia-Florione</option>
                            <option value="Southeast Asia-Animus">Southeast Asia-Animus</option>
                            <option value="Southeast Asia-Gumi Gumi">Southeast Asia-Gumi Gumi</option>
                            <option value="Southeast Asia-Oryza">Southeast Asia-Oryza</option>
                            <option value="Southeast Asia-Saeri">Southeast Asia-Saeri</option>
                            <option value="Southeast Asia-Phantasia">Southeast Asia-Phantasia</option>
                            <option value="Southeast Asia-Mechafield">Southeast Asia-Mechafield</option>
                            <option value="Southeast Asia-Ethereal Dream">Southeast Asia-Ethereal Dream</option>
                            <option value="Southeast Asia-Odyssey">Southeast Asia-Odyssey</option>
                            <option value="Southeast Asia-Aestral-Noa">Southeast Asia-Aestral-Noa</option>
                            <option value="Southeast Asia-Chandra">Southeast Asia-Chandra</option>
                            <option value="Southeast Asia-Aeria">Southeast Asia-Aeria</option>
                            <option value="Southeast Asia-Scarlet">Southeast Asia-Scarlet</option>
                            <option value="Southeast Asia-Fantasia">Southeast Asia-Fantasia</option>
                            <option value="Southeast Asia-Stardust">Southeast Asia-Stardust</option>
                            <option value="Southeast Asia-Arcania">Southeast Asia-Arcania</option>
                            <option value="Southeast Asia-Valhalla">Southeast Asia-Valhalla</option>
                            <option value="North America-Lunalite">North America-Lunalite</option>
                            <option value="North America-Sol-III">North America-Sol-III</option>
                            <option value="North America-Lighthouse">North America-Lighthouse</option>
                            <option value="North America-Silver Bridge">North America-Silver Bridge</option>
                            <option value="North America-The Glades">North America-The Glades</option>
                            <option value="North America-Nightfall">North America-Nightfall</option>
                            <option value="North America-Frontier">North America-Frontier</option>
                            <option value="North America-Libera">North America-Libera</option>
                            <option value="North America-Solaris">North America-Solaris</option>
                            <option value="North America-Freedom-Oasis">North America-Freedom-Oasis</option>
                            <option value="North America-The Worlds Between">North America-The Worlds Between</option>
                            <option value="North America-Radiant">North America-Radiant</option>
                            <option value="North America-Tempest">North America-Tempest</option>
                            <option value="North America-New Era">North America-New Era</option>
                            <option value="North America-Observer">North America-Observer</option>
                            <option value="North America-Starlight">North America-Starlight</option>
                            <option value="North America-Myriad">North America-Myriad</option>
                            <option value="North America-Oumuamua">North America-Oumuamua</option>
                            <option value="North America-Eternium Phantasy">North America-Eternium Phantasy</option>
                            <option value="North America-Azure Plane">North America-Azure Plane</option>
                            <option value="North America-Nirvana">North America-Nirvana</option>
                            <option value="Europe-Magia Przygoda Aida">Europe-Magia Przygoda Aida</option>
                            <option value="Europe-Transport Hub">Europe-Transport Hub</option>
                            <option value="Europe-The Lumina">Europe-The Lumina</option>
                            <option value="Europe-Lycoris">Europe-Lycoris</option>
                            <option value="Europe-Ether">Europe-Ether</option>
                            <option value="Europe-Olivine">Europe-Olivine</option>
                            <option value="Europe-Iter">Europe-Iter</option>
                            <option value="Europe-Aimanium">Europe-Aimanium</option>
                            <option value="Europe-Alintheus">Europe-Alintheus</option>
                            <option value="Europe-Andoes">Europe-Andoes</option>
                            <option value="Europe-Anomora">Europe-Anomora</option>
                            <option value="Europe-Astora">Europe-Astora</option>
                            <option value="Europe-Valstamm">Europe-Valstamm</option>
                            <option value="Europe-Blumous">Europe-Blumous</option>
                            <option value="Europe-Celestialrise">Europe-Celestialrise</option>
                            <option value="Europe-Cosmos">Europe-Cosmos</option>
                            <option value="Europe-Dyrnwyn">Europe-Dyrnwyn</option>
                            <option value="Europe-Elypium">Europe-Elypium</option>
                            <option value="Europe-Excalibur">Europe-Excalibur</option>
                            <option value="Europe-Espoir IV">Europe-Espoir IV</option>
                            <option value="Europe-Estrela">Europe-Estrela</option>
                            <option value="Europe-Ex Nihilor">Europe-Ex Nihilor</option>
                            <option value="Europe-Futuria">Europe-Futuria</option>
                            <option value="Europe-Hephaestus">Europe-Hephaestus</option>
                            <option value="Europe-Midgard">Europe-Midgard</option>
                            <option value="Europe-Kuura">Europe-Kuura</option>
                            <option value="Europe-Lyramiel">Europe-Lyramiel</option>
                            <option value="Europe-Magenta">Europe-Magenta</option>
                            <option value="Europe-Omnium Prime">Europe-Omnium Prime</option>
                            <option value="Europe-Turmus">Europe-Turmus</option>
                            <option value="South America-Corvus">South America-Corvus</option>
                            <option value="South America-Calodesma Seven">South America-Calodesma Seven</option>
                            <option value="South America-Columba">South America-Columba</option>
                            <option value="South America-Tiamat">South America-Tiamat</option>
                            <option value="South America-Orion">South America-Orion</option>
                            <option value="South America-Luna Azul">South America-Luna Azul</option>
                            <option value="South America-Hope">South America-Hope</option>
                            <option value="South America-Tanzanite">South America-Tanzanite</option>
                            <option value="South America-Antlia">South America-Antlia</option>
                            <option value="South America-Pegasus">South America-Pegasus</option>
                            <option value="South America-Phoenix">South America-Phoenix</option>
                            <option value="South America-Centaurus">South America-Centaurus</option>
                            <option value="South America-Cepheu">South America-Cepheu</option>
                            <option value="South America-Cygnus">South America-Cygnus</option>
                            <option value="South America-Grus">South America-Grus</option>
                            <option value="South America-Hydra">South America-Hydra</option>
                            <option value="South America-Lyra">South America-Lyra</option>
                            <option value="South America-Ophiuchus">South America-Ophiuchus</option>
                            <option value="Asia-Pacific-Cocoaiteruyo">Asia-Pacific-Cocoaiteruyo</option>
                            <option value="Asia-Pacific-Food Fighter">Asia-Pacific-Food Fighter</option>
                            <option value="Asia-Pacific-Gomap">Asia-Pacific-Gomap</option>
                            <option value="Asia-Pacific-Yggdrasil">Asia-Pacific-Yggdrasil</option>
                            <option value="Asia-Pacific-Daybreak">Asia-Pacific-Daybreak</option>
                            <option value="Asia-Pacific-Adventure">Asia-Pacific-Adventure</option>
                            <option value="Asia-Pacific-Eden">Asia-Pacific-Eden</option>
                            <option value="Asia-Pacific-Fate">Asia-Pacific-Fate</option>
                            <option value="Asia-Pacific-Nova">Asia-Pacific-Nova</option>
                            <option value="Asia-Pacific-Ruby">Asia-Pacific-Ruby</option>
                            <option value="Asia-Pacific-Babel">Asia-Pacific-Babel</option>
                            <option value="Asia-Pacific-Pluto">Asia-Pacific-Pluto</option>
                            <option value="Asia-Pacific-Sushi">Asia-Pacific-Sushi</option>
                            <option value="Asia-Pacific-Venus">Asia-Pacific-Venus</option>
                            <option value="Asia-Pacific-Galaxy">Asia-Pacific-Galaxy</option>
                            <option value="Asia-Pacific-Memory">Asia-Pacific-Memory</option>
                            <option value="Asia-Pacific-Oxygen">Asia-Pacific-Oxygen</option>
                            <option value="Asia-Pacific-Sakura">Asia-Pacific-Sakura</option>
                            <option value="Asia-Pacific-Seeker">Asia-Pacific-Seeker</option>
                            <option value="Asia-Pacific-Shinya">Asia-Pacific-Shinya</option>
                            <option value="Asia-Pacific-Stella">Asia-Pacific-Stella</option>
                            <option value="Asia-Pacific-Uranus">Asia-Pacific-Uranus</option>
                            <option value="Asia-Pacific-Utopia">Asia-Pacific-Utopia</option>
                            <option value="Asia-Pacific-Jupiter">Asia-Pacific-Jupiter</option>
                            <option value="Asia-Pacific-Sweetie">Asia-Pacific-Sweetie</option>
                            <option value="Asia-Pacific-Atlantis">Asia-Pacific-Atlantis</option>
                            <option value="Asia-Pacific-Takoyaki">Asia-Pacific-Takoyaki</option>
                            <option value="Asia-Pacific-Mars">Asia-Pacific-Mars</option>
						</select>
					</div>
					@elseif($kategori->kode == "genshin-impact")
					<div class="col-6">
						<input type="text" class="form-control" placeholder="Masukkan User ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					<div class="col-6">
						<select class="form-control" id="zone">
						  <option value="">Pilih Server</option>
						  <option value="america">America</option>
                          <option value="europe">Europa</option>
                          <option value="asia">Asia</option>
                          <option value="tw_hk_mo">TW_HK_MO</option>
						</select>
					</div>
					@elseif($kategori->kode == "ragnarok-m")
					 <div class="col-6">
						<input type="text" class="form-control" placeholder="User ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					<div class="col-6">
						<select class="form-control" id="zone">
						  <option value="">Pilih Server</option>
						    <option value="eternal_love">Eternal Love</option>
                            <option value="midnight_party">Midnight Party</option>
                            <option value="memory_of_faith">Memory Of Faith</option>
						</select>
					</div>
					
					@elseif($kategori->kode == "mobile-legends")
					<div class="col-6">
						<input type="text" class="form-control" placeholder="Masukkan User ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					<div class="col-6">
						<input type="text" class="form-control" placeholder="Masukkan Zone ID" name="zone_id" id="zone" autocomplete="off">
					</div>
					@elseif($kategori->kode == "apex-legends-mobile")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Player ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "call-of-duty-mobile")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Open ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "point-blank")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan User ID / ID Login" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "arena-of-valor")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Open ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "marvel-super-war")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Player ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "valorant")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Riot ID" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "tri")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor Tri Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "telkomsel")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor Telkomsel Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "indosat")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor Indosat Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "smartfren")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor Smartfren Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "xl")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor XL Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "axis")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor Axis Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "gopay")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor Gopay Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "ovo")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor OVO Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "isaku")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor i.saku Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "shopeepay")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor ShopeePay Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "dana")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor Dana Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					@elseif($kategori->kode == "linkaja")
					<div class="col-12">
						<input type="text" class="form-control" placeholder="Masukkan Nomor LinkAja Anda" id="user_id" name="user_id" autocomplete="off">
					</div>
					
					@else
					
					
    					@if(in_array($kategori->tipe,['game','voucher','pulsa','e-money']))
    					
    					   	
    					<div class="col-12">
    						<input type="text" class="form-control" placeholder="Masukkan User ID" id="user_id" name="user_id" autocomplete="off">
    					</div>
    				    
    				    
    				    @else
    				
    				    
    				    <div class="row">
    				        <div class="col-12 mb-2">
    				            <input type="text" class="form-control" placeholder="Masukkan Email" id="email_joki" name="email_joki" autocomplete="off">
    				        </div>
    				        <div class="col-12 mb-2">
    				            <input type="password" class="form-control" placeholder="Masukkan Password" id="password_joki" name="password_joki" autocomplete="off">
    				        </div>
    				    </div>
    				    
    				    <div class="row">
    				        <div class="col-12 mb-2">
    				            <select class="form-control" id="loginvia_joki" name="loginvia_joki">
    				                <option value="">Login Via</option>
    				                <option value="moonton">Moonton (Rekomendasi)</option
    				                <option value="vk">VK</option>
    				                <option value="tiktok">Tiktok</option>
    				                <option value="facebook">Facebook</option>
    				            </select>
    				        </div>
    				        <div class="col-12 mb-2">
    				           <input type="text" class="form-control" placeholder="Masukkan Nickname" id="nickname_joki" name="nickname_joki" autocomplete="off">
    				        </div>
    				    </div>
    				    
    				    
    				    <div class="row">
    				        <div class="col-12 mb-2">
    				            <input type="text" class="form-control" placeholder="Min Request 3 Hero (Diusahakan)" id="request_joki" name="request_joki" autocomplete="off">
    				        </div>
    				        <div class="col-12 mb-2">
    				           <input type="text" class="form-control" placeholder="Catatan untuk Penjoki" id="catatan_joki" name="catatan_joki" autocomplete="off">
    				        </div>
    				    </div>
    				    
    					
    					@endif
					
					@endif
					
					
					
					
					
					<p class="panduan">{!! $kategori->deskripsi_field !!}</p>
					
				</div>
			</div>
			</div>
			
			<div class="card bg-card border-0 mb-4 shadow-form">
    			<div class="px-3 py-3">
    				<div class="num-page border-bottom">
    					<div>2</div>
    					<p>Pilih Item</p>
    				</div>
    				<div class="row mt-4">
				    
				    @foreach($nominal as $nom)
				    
					<div class="col-6 col-md-3 col-lg-4 mb-3">
						<div id="product-{{$nom->id}}" class="p-2 px-3 cursor-pointer bg-product product-list" product-id="{{$nom->id}}">
							<b class="d-block">{{ $nom->layanan }}</b>
							 <span class="harga">Rp {{ number_format($nom->harga) }},-</span>
						</div>
					</div>
										
					@endforeach					
					
				</div>
			</div>
		</div>

			<div class="card bg-card border-0 mb-4 shadow-form">
    			<div class="px-3 py-3">
    				<div class="num-page border-bottom">
    					<div>3</div>
    					<p>Pilih Pembayaran</p>
    				</div>
    				<div class="row mt-4">
				
				@auth
				<div class="accordion mb-3" id="accordionExample-1" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06);border-radius: 6px;">
        					<div class="accordion-item border-0">
        						<h2 class="accordion-header" id="heading-balance">
        							<button class="accordion-button collapsed bg-white-custom text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-balance" aria-expanded="false" aria-controls="collapse-balance">
        								<div class="accordion-tipe">Saldo</div>
							</button>
						</h2>
						<div id="collapse-balance" class="accordion-collapse collapse" aria-labelledby="heading-balance" data-bs-parent="#accordionExample-balance">
							<div class="accordion-body bg-payment">
        								<div class="row">
        	<div class="col-6 col-md-3 col-lg-4">
										<div id="method-balance" class="p-2 border rounded mb-3 method-list bg-light shadow-sm" method-id="SALDO">
											<table class="w-100 border-bottom mb-2">
												<tr>
													<td>
														<img src="/assets/payment/saldo-akun.png" alt="" class="w-75">
													</td>
													<td>
														<b style="font-size: 12px;white-space: nowrap;" method-price="balance" id="SALDO"></b>
													</td>
												</tr>
											</table>
											<div style="font-size: 12px;color: #718096;">
												<b class="d-block mb-2">Saldo Akun</b>
												<b class="d-block">Proses otomatis</b>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="bg-payment p-2 text-end border-0 text-nowrap" style="border-radius: 0 0 6px 6px;overflow-x: auto">
						<img src="/assets/payment/saldo-akun.png" alt="" width="64">
					</div>
				</div>
				@endauth
				
				<div class="accordion mb-3" id="accordionExample-1" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06);border-radius: 6px;">
        					<div class="accordion-item border-0">
						<h2 class="accordion-header" id="heading-qris">
							<button class="accordion-button collapsed bg-white-custom text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-qris" aria-expanded="false" aria-controls="collapse-ewallet">
								<div class="accordion-tipe">QRIS</div>
							</button>
						</h2>
						<div id="collapse-qris" class="accordion-collapse collapse" aria-labelledby="heading-qris" data-bs-parent="#accordionExample-1">
							<div class="accordion-body bg-payment">
								<div class="row">
								    @foreach($pay_method as $p)
								    @if($p->tipe == 'qris')
								<div class="col-6 col-md-3 col-lg-4">
										<div id="method-23" class="p-2 border rounded mb-3 method-list bg-light shadow-sm"  method-id="{{$p->code}}">
											<table class="w-100 border-bottom mb-2">
												<tr>
													<td>
														<img src="{{$p->images}}" alt="" class="w-75">
													</td>
													<td>
														<b style="font-size: 12px;white-space: nowrap;" id="{{$p->code}}"></b>
													</td>
												</tr>
											</table>
											<div style="font-size: 12px;color: #718096;">
												<b class="d-block mb-2">{{$p->name}}</b>
												<b class="d-block">{{$p->keterangan}}</b>
											</div>
										</div>
									</div>
									@endif
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="bg-payment p-2 text-end border-0 text-nowrap" style="border-radius: 0 0 6px 6px;overflow-x: auto">
					    @foreach($pay_method as $p)
                        @if($p->tipe == 'qris')
						<img src="{{$p->images}}" alt="" width="64">
						@endif
                        @endforeach
					</div>
				</div>
				
				<div class="accordion mb-3" id="accordionExample-1" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06);border-radius: 6px;">
					<div class="accordion-item border-0">
						<h2 class="accordion-header" id="heading-ewallet">
							<button class="accordion-button collapsed bg-white-custom text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ewallet" aria-expanded="false" aria-controls="collapse-ewallet">
								<div class="accordion-tipe">E-Wallet</div>
							</button>
						</h2>
						<div id="collapse-ewallet" class="accordion-collapse collapse" aria-labelledby="heading-ewallet" data-bs-parent="#accordionExample-1">
							<div class="accordion-body bg-payment">
								<div class="row">
								    @foreach($pay_method as $p)
								    @if($p->tipe == 'e-walet')
								<div class="col-6 col-md-3 col-lg-4">
										<div id="method-23" class="p-2 border rounded mb-3 method-list bg-light shadow-sm"  method-id="{{$p->code}}">
											<table class="w-100 border-bottom mb-2">
												<tr>
													<td>
														<img src="{{$p->images}}" alt="" class="w-75">
													</td>
													<td>
														<b style="font-size: 12px;white-space: nowrap;" id="{{$p->code}}"></b>
													</td>
												</tr>
											</table>
											<div style="font-size: 12px;color: #718096;">
												<b class="d-block mb-2">{{$p->name}}</b>
												<b class="d-block">{{$p->keterangan}}</b>
											</div>
										</div>
									</div>
									@endif
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="bg-payment p-2 text-end border-0 text-nowrap" style="border-radius: 0 0 6px 6px;overflow-x: auto">
					    @foreach($pay_method as $p)
                        @if($p->tipe == 'e-walet')
						<img src="{{$p->images}}" alt="" width="64">
						@endif
                        @endforeach
					</div>
				</div>
				
				<div class="accordion mb-3" id="accordionExample-1" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06);border-radius: 6px;">
					<div class="accordion-item border-0">
						<h2 class="accordion-header" id="heading-convenience-store">
							<button class="accordion-button collapsed bg-white-custom text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-convenience-store" aria-expanded="false" aria-controls="collapse-convenience-store">
								<div class="accordion-tipe">Convenience Store</div>
							</button>
						</h2>
						<div id="collapse-convenience-store" class="accordion-collapse collapse" aria-labelledby="heading-convenience-store" data-bs-parent="#accordionExample-2">
							<div class="accordion-body bg-payment">
								<div class="row">
								    @foreach($pay_method as $p)
								    @if($p->tipe == 'convenience-store')
								<div class="col-6 col-md-3 col-lg-4">
										<div id="method-12" class="p-2 border rounded mb-3 method-list bg-light shadow-sm"  method-id="{{$p->code}}">
											<table class="w-100 border-bottom mb-2">
												<tr>
													<td>
														<img src="{{$p->images}}" alt="" class="w-75">
													</td>
													<td>
														<b style="font-size: 12px;white-space: nowrap;" id="{{$p->code}}"></b>
													</td>
												</tr>
											</table>
											<div style="font-size: 12px;color: #718096;">
												<b class="d-block mb-2">{{$p->name}}</b>
												<b class="d-block">{{$p->keterangan}}</b>
											</div>
										</div>
									</div>
									@endif
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="bg-payment p-2 text-end border-0 text-nowrap" style="border-radius: 0 0 6px 6px;overflow-x: auto">
					    @foreach($pay_method as $p)
						@if($p->tipe == 'convenience-store')
						<img src="{{$p->images}}" alt="" width="64">
						@endif
						@endforeach
					</div>
				</div>
								
				<div class="accordion mb-3" id="accordionExample-1" disabled style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06);border-radius: 6px;">
					<div class="accordion-item border-0">
						<h2 class="accordion-header" id="heading-virtual-account">
							<button class="accordion-button collapsed bg-white-custom text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-virtual-account" aria-expanded="false" aria-controls="collapse-virtual-account">
								<div class="accordion-tipe">Virtual Account</div>
							</button>
						</h2>
						<div id="collapse-virtual-account" class="accordion-collapse collapse" aria-labelledby="heading-virtual-account" data-bs-parent="#accordionExample-5">
							<div class="accordion-body bg-payment">
								<div class="row">
								    @foreach($pay_method as $p)
						            @if($p->tipe == 'virtual-account')
						<div class="col-6 col-md-3 col-lg-4">
										<div id="method-21" class="p-2 border rounded mb-3 method-list bg-light shadow-sm"  method-id="{{$p->code}}">
											<table class="w-100 border-bottom mb-2">
												<tr>
													<td>
														<img src="{{$p->images}}" alt="" class="w-75">
													</td>
													<td>
														<b style="font-size: 12px;white-space: nowrap;" id="{{$p->code}}"></b>
													</td>
												</tr>
											</table>
											<div style="font-size: 12px;color: #718096;">
												<b class="d-block mb-2">{{$p->name}}</b>
												<b class="d-block">{{$p->keterangan}}</b>
											</div>
										</div>
									</div>
									@endif
						            @endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="bg-payment p-2 text-end border-0 text-nowrap" style="border-radius: 0 0 6px 6px;overflow-x: auto">
					    @foreach($pay_method as $p)
						@if($p->tipe == 'virtual-account')
						<img src="{{$p->images}}" alt="" width="64">
						@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
							
			<div class="card bg-card border-0 shadow-form">			
    			<div class="px-3 pt-3" style="margin-bottom: 15px;">
    				<div class="num-page border-bottom">
    					<div>4</div>
    					<p>No Whatsapp</p>
    				</div>
    				<div class="mt-3">
        			    <input type="number" class="form-control" placeholder="08xXXXXXXX" id="nomor" autocomplete="off" name="whatsapp">
        				<p class="mt-3" style="font-size: 13px;color: var(--warna_4);">Bukti pembayaran atas pembelian anda akan kami kirimkan ke WhatsApp anda.</p>
    				</div>
    			<button class="btn btn-order btn-primary" type="button" id="btn-order">Beli</button>
    			</div>
            </div>
	    </form>
    </div>
    
</div>
        






@push('custom_script')

<script>
function removeClass(){  
    btnorder.className = btnorder.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
}

var btnorder = document.getElementById('btn-order');


btnorder.addEventListener("click", function() {
    btnorder.className = btnorder.className + ' loading';
    setTimeout(removeClass, 5000);
}, false);
</script>

<script>
    
     function changeHarga(harga,hargareal)
    {
        $("#SALDO").html(harga);
        $("#OVO").html(harga);
        $("#GOPAY").html(harga);
        $("#SHOPEEPAY").html(harga);
        $("#QRIS").html(harga);
        $("#QRIS2").html(harga);
        $("#MYBVA").html(harga);
        $("#PERMATAVA").html(harga);
        $("#BNIVA").html(harga);
        $("#BRIVA").html(harga);
        $("#MANDIRIVA").html(harga);
        $("#SMSVA").html(harga);
        $("#MUAMALATVA").html(harga);
        $("#CIMBVA").html(harga);
        $("#SAMPOERNAVA").html(harga);
        $("#BSIVA").html(harga);
        $("#ALFAMART").html(harga);
        $("#ALFAMIDI").html(harga);
        $("#INDOMARET").html(harga);
    }
    
    
     $('.accordion-button').css('pointer-events','none');
     $('.accordion-header').addClass('hide-payment');
     
    
    $('.product-list').click(function(){
        
        $('.accordion-button').css('pointer-events','auto');
        $('.accordion-header').removeClass('hide-payment');
        
       const prd = $(this).attr('product-id');
       $('.product-list').removeClass('active');
       $(this).addClass('active');
       
       $('#nominal').val(prd);
       
       $.ajax({
                    url: "<?php echo route('ajax.price') ?>",
                    dataType: "json",
                    type: "POST",
                    data: {
                        "_token": "<?php echo csrf_token() ?>",
                        "nominal": prd
                    },
                    success: function(res) {
                        changeHarga(res.harga);
                    }
                })
       
       
    });
    
    
    $('.accordion-header').click(function(){
       
        if($(this).hasClass('hide-payment')){
            
            toastr.options.positionClass = "toast-top-right";
            toastr.options.closeButton = true;
            
            toastr.warning('Mohon untuk pilih item terlebih dahulu');
            
        }
        
    });
    
    
    
    $('.method-list').click(function(){
        
       const mtd = $(this).attr('method-id');
       $('.method-list').removeClass('active');
       $(this).addClass('active');
       
       $('#metode').val(mtd);
       
      
       
    });
    
    $("#btn-order").on("click", function() {
        

            var uid = $("#user_id").val();
            var zone = $("#zone").val();
            var email_joki = $("#email_joki").val();
            var password_joki = $("#password_joki").val();
            var loginvia_joki = $("#loginvia_joki").val();
            var nickname_joki = $("#nickname_joki").val();
            var request_joki = $("#request_joki").val();
            var catatan_joki = $("#catatan_joki").val();
            var service = $("#nominal").val();
            var pembayaran = $("#metode").val();
            var nomor = $("#nomor").val();
            // var email = $("input[name='email']").val();
            var voucher = $("#voucher").val();
            var ktg_tipe = $("#ktg_tipe").val();
           
            $.ajax({
                url: "<?php echo route('ajax.confirm-data') ?>",
                dataType: "JSON",
                type: "POST",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'uid': uid,
                    'zone': zone,
                    'service': service,
                    'payment_method': pembayaran,
                    'nomor': nomor,
                    'email_joki' : email_joki,
                    'password_joki' : password_joki,
                    'loginvia_joki' : loginvia_joki,
                    'nickname_joki' : nickname_joki,
                    'request_joki' : request_joki,
                    'catatan_joki' : catatan_joki,
                    'ktg_tipe' : ktg_tipe,
                    // 'email': email,
                    'voucher': voucher
                },
                complete:function(){
                    grecaptcha.reset();
                },
                success: function(res) {
                    if (res.status == true) {
                        Swal.fire({
                            icon: 'question',
                            titleText: 'Detail Pesanan',
                            html: `${res.data}`,
                            showCancelButton: true,
                            cancelButtonText: 'Cancel',
                            confirmButtonText: 'Beli Sekarang',
                            backdrop: 'hsla(220,9%,46%,.75)',
                            customClass: {
                                title: 'swal-title',
                                htmlContainer: 'swal-text'
                            }

                        }).then(resp => {
                            if (resp.isConfirmed) {
                                var nickname = $("#nick").text();
                                var nohp = $("#nomor").val();
                                // var email = $("input[name='email']").val();
                                $.ajax({
                                    url: "<?php echo route('order') ?>",
                                    dataType: "JSON",
                                    type: "POST",
                                    data: {
                                        '_token': '<?php echo csrf_token() ?>',
                                        'nickname': nickname,
                                        'uid': uid,
                                        'zone': zone,
                                        'service': service,
                                        'payment_method': pembayaran,
                                        'nomor': nohp,
                                        // 'email': email,
                                        'voucher': voucher,
                                        'email_joki' : email_joki,
                                        'password_joki' : password_joki,
                                        'loginvia_joki' : loginvia_joki,
                                        'nickname_joki' : nickname_joki,
                                        'request_joki' : request_joki,
                                        'catatan_joki' : catatan_joki,
                                        'ktg_tipe' : ktg_tipe,

                                    },
                                    beforeSend: function() {
                                        let timerInterval
                                        Swal.fire({
                                          title: 'Tunggu Sebentar',
                                          timerProgressBar: false,
                                          didOpen: () => {
                                            Swal.showLoading()
                                            const b = Swal.getHtmlContainer().querySelector('b')
                                            timerInterval = setInterval(() => {
                                              b.textContent = Swal.getTimerLeft()
                                            }, 100)
                                          },
                                          willClose: () => {
                                            clearInterval(timerInterval)
                                          }
                                        }).then((result) => {
                                          /* Read more about handling dismissals below */
                                          if (result.dismiss === Swal.DismissReason.timer) {
                                            console.log('I was closed by the timer')
                                          }
                                        })
                                    },
                                    success: function(resOrder) {
                                        if (resOrder.status) {
                                            Swal.fire({
                                                title: 'Berhasil memesan!',
                                                text: `Order ID : ${resOrder.order_id}`,
                                                icon: 'success',
                                                showConfirmButton: false,
                                                allowOutsideClick: false,
                                                // background: '#222831',
                                                // color: '#fff'
                                            });
                                            window.location = `/pembelian/invoice/${resOrder.order_id}`;
                                        } else {
                                            Swal.fire({
                                                title: 'Oops...',
                                                text: `${resOrder.data}`,
                                                icon: 'error',
                                                // background: '#222831',
                                                // color: '#fff'
                                            });
                                        }
                                    }
                                })
                            }
                        })
                    } else if (res.status == false) {
                        Swal.fire({
                            title: 'Oops...',
                            text: res.data,
                            icon: 'error',
                            // background: '#222831',
                            // color: '#fff'
                        });
                    } else {
                        Swal.fire({
                            title: 'Oops...',
                            text: 'User ID tidak ditemukan.',
                            icon: 'error',
                            // background: '#222831',
                            // color: '#fff'
                        });
                    }
                },
                error: function(e) {
                    if (e.status == 422) {
                        toastr.options = {
                            "positionClass": "toast-top-right",
                            "closeButton": false,
                            "progressBar": true,
                        }
                        toastr["error"]("Masih ada data yang kosong", "Warning");
                    }
                }
            })
        })
        
        
        
        
        $("#btn-check").on("click", function(){
            var voucher = $("#voucher").val();
            var service = $("#nominal").val();
            $.ajax({
                url: "<?php echo route('check.voucher') ?>",
                dataType: "JSON",
                type: "POST",
                data: {
                    "_token": "<?php echo csrf_token(); ?>",
                    "voucher": voucher,
                    "service": service
                },
                beforeSend: function() {
                    Swal.fire({
                        icon: "info",
                        title: "Mohon Tunggu",
                        // background: '#222831',
                        // color: '#fff',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                },
                success: function (res){
                    Swal.fire({
                        icon: "info",
                        title: res.message,
                        // background: '#222831',
                        // color: '#fff',
                        showConfirmButton: true,
                        allowOutsideClick: true,
                    });                   
                    
                    if(res.harga){
                        changeHarga(res.harga);
                    }
                },
                error: function(e){
                    Swal.fire({
                        title: 'Oops...',
                        text: e.responseJSON.message,
                        icon: 'error',
                        // background: '#222831',
                        // color: '#fff'
                    });                    
                }
            }) 
        });
        

    
    
    
</script>





@endpush




@endsection