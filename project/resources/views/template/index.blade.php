 @extends('template.template')

@section('custom_style')


<style>
    .card {
        border: none!important;
        background-color: transparent!important;
    }
    .bottom-6 {
        bottom: 3rem!important;
    }
    .absolute {
        position: absolute!important;
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
            <div class="swiper-container mt-2 mb-2">
              <div class="swiper-wrapper" id="swiper">
              	@foreach($banner as $data)
                   <div class="swiper-slide">
                    <img src="{{ $data->path }}">
                </div>
                @endforeach
                              </div>
            </div>
                
            <section class="px-2 mt-5" style="">
                <h4 class="mb-2 text-white" style="font-size: 1.7rem;">Top Up Games</h4>
                <div class="product row mt-4">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "game")
                    
                    <div class="col-4 col-md-3 col-lg-2">
                    <div class="card-product">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm lazy" src="{{ $category->thumbnail  }}" loading="lazy" alt="{{ $category->nama }}">
                        </a>
                    </div>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                    
                </div>
            </section>        
            <section class="px-2 mt-5" style="">
                <h4 class="mb-2 text-white" style="font-size: 1.7rem;">Joki MLBB</h4>
                <div class="product row mt-4">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "joki")
                    
                    <div class="col-4 col-md-3 col-lg-2">
                    <div class="card-product">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm lazy" src="{{ $category->thumbnail  }}" loading="lazy" alt="{{ $category->nama }}">
                        </a>
                    </div>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                    
                </div>
            </section>        
          
        </div>    
        
        <section class="px-2 resultsearch d-none" style="padding-bottom: 2rem;">
                <h4 class="mb-2" style="font-size: 1rem;">Hasil Pencarian</h4><br>
                <div class="product productresultsearch row">
                    
   
                            
                </div>
            </section>

@push('custom_script')
    
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>

<script>
var swiper = new Swiper('.swiper-container', {
  effect: 'coverflow',
  grabCursor: true,
  loop: true,
  centeredSlides: true,
  spaceBetween: 1,
  slidesPerView: 'auto',
  coverflow: {
    rotate: 50,
    stretch: 0,
    depth: 100,
    modifier: 1,
    slideShadows : true
  },
  pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
});

</script>

<script>
            $('.metode-top').owlCarousel({
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:1000,
                responsive:{
                    0:{
                        items:3
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            });
            $('.metode-bottom').owlCarousel({
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:1000,
                rtl: true,
                responsive:{
                    0:{
                        items:3
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            });

            $(window).on('load',function(){
                setTimeout(() => {
                    $('.skeleton-loader').addClass('d-none');
                    $('.item-skeleton-content').removeClass('d-none');
                }, 1500);
            });
            
            var delay = (function () {
                var timer = 0;
                return function (callback, ms) {
                        clearTimeout(timer);
                        timer = setTimeout(callback, ms);
                    };
                })();
            
           
            
            $('#searchProds').keyup(function () {
                                    const data = $(this).val();
                                    if (data.length < 1) {
                                        $('.resultsearch').removeClass('show');
                                        $('.resultsearch li').remove();
                                    } else {

                                        delay(function () {

                                            $.ajax({
                                                url: "{{url('/cari/index')}}",
                                                method: "POST",
                                                data: {
                                                    data: data
                                                },
                                                beforeSend: function () {
                                                    $('.resultsearch li').remove();
                                                },
                                                success: function (res) {
                                                    $('.resultsearch').append(res);
                                                    $('.resultsearch').addClass('show');
                                                }
                                            })

                                        }, 100);

                                    }
                                })
            
        </script>


@endpush




@endsection