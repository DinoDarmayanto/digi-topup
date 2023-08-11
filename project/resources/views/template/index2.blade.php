 @extends('template.template')

@section('custom_style')


<style>
        .product .box{margin-bottom:40px}

        .ph-item{

            border: none;
            background-color: transparent;
            padding: 0px;
            margin-bottom: 0px;

        }

        .ph-picture{
            border-radius: 10px;
        }

        .ph-col-12{
            border-radius: 10px;
        }
        
        .carousel-indicators{
            margin-bottom: -1.5rem;
        }
        
    
        
        .carousel-indicators button.active{
            
            background-color: var(--warna_2) !important;
            height: 12px;
            width: 30px;
            display: inline-block;
            border-radius: 0.5rem !important;
            opacity: 1;
           
            
            
          
        }
        
        .carousel-indicators [data-bs-target] {
            box-sizing: content-box;
            flex: 0 1 auto;
            width: 12px; 
            height: 12px; 
            padding: 0;
            margin-right: 3px;
            margin-left: 3px;
            text-indent: -999px;
            cursor: pointer;
            background-color: var(--warna_2) !important;
            background-clip: padding-box;
            border: 0;
            /*border-top: 10px solid transparent;*/
            /*border-bottom: 10px solid transparent;*/
            opacity: .5;
            transition: opacity .6s ease;
            border-radius: 100%; 
        }
        .nav-pills li button {
        color: #004c64;
        width: 120px;
        padding: 10px 0px !important;
        margin: 2px;
        border: 1px solid var(--warna_2) !important;
      }
      .nav-pills button.active {
      	background-color: var(--warna_2) !important;
      }
      .nav-pills li button p{
        display: inline;
        text-align: center;
        font-size: 14px;
      }
</style>


@endsection


@section('content')



<div class="header">
            <img src="{{url('')}}{{ !$config ? '' : $config->logo_header }}" alt="">
        </div>
        <div class="content-body" style="margin-top: -125px;">
            <form onkeydown="return event.key != 'Enter';">
                <input type="text" class="form-control search-input" placeholder="Cari Game Favoritmu">
            </form>
            <div class="mb-5">
                
                <div id="carouselExampleIndicators" class="carousel slide mt-4" data-bs-ride="carousel">
                  
                  <div class="carousel-inner">
                   
                   
                    @foreach($banner as $data)
                      
                    <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                      <img src="{{ $data->path }}" class="d-block w-100 rounded" style="box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);">
                    </div>
                    
                    @endforeach
                   
                    
                  </div>
                  
                  <div class="carousel-indicators">
                     @foreach($banner as $data)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$loop->index}}" class="{{$loop->first ? 'active' : ''}}"></button>
                    @endforeach
                  </div>
                  
                </div>
                
                
                
                
                
            </div>

            <div class="skeleton-loader">
                
                @for($i=1;$i<=5;$i++)
                
                <div class="ph-item">
                    <div class="ph-col-12">
                        <div class="ph-picture"></div>
                        <div class="ph-row">
                            <div class="ph-col-12"></div>
                        </div>
                    </div>
                </div>
    
                @endfor
                
                
            </div>

            <section class="px-2 item-skeleton-content d-none" style="">
                <h4 class="mb-2" style="font-size: 1rem;">Populer</h4><br>
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->kode == "mlbb" || $category->kode == "free-fire" || $category->kode == "joki-rank-paketan" || $category->kode == "#" || $category->kode == "#" || $category->kode == "#")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-lg" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>
            <ul class="nav nav-pills mb-3 d-flex flex-row flex-nowrap overflow-scroll" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-game-tab" data-bs-toggle="pill" data-bs-target="#pills-game" type="button" role="tab" aria-controls="pills-game" aria-selected="true">
                  <p>SEMUA</p>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-game2-tab" data-bs-toggle="pill" data-bs-target="#pills-game2" type="button" role="tab" aria-controls="pills-game2" aria-selected="false">
                  <p>TOPUP</p>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-jasajoki-tab" data-bs-toggle="pill" data-bs-target="#pills-jasajoki" type="button" role="tab" aria-controls="pills-jasajoki" aria-selected="false">
                  <p>JASA MLBB</p>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-voucher-tab" data-bs-toggle="pill" data-bs-target="#pills-voucher" type="button" role="tab" aria-controls="pills-voucher" aria-selected="false">
                  <p>VOUCHER</p>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-pulsadata-tab" data-bs-toggle="pill" data-bs-target="#pills-pulsadata" type="button" role="tab" aria-controls="pills-pulsadata" aria-selected="false">
                  <p>PULSA & DATA</p>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-ewallet-tab" data-bs-toggle="pill" data-bs-target="#pills-ewallet" type="button" role="tab" aria-controls="pills-ewallet" aria-selected="false">
                  <p>E-WALLET</p>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-streamingapp-tab" data-bs-toggle="pill" data-bs-target="#pills-streamingapp" type="button" role="tab" aria-controls="pills-streamingapp" aria-selected="false">
                  <p>STREAMING APP</p>
                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              
            <div class="tab-pane fade show active" id="pills-game" role="tabpanel" aria-labelledby="pills-game-tab">
            <section class="px-2 item-skeleton-content d-none" style="">
                <h4 class="mb-2" style="font-size: 1rem;">Semua Produk</h4><br>
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "game")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                    
                </div>
            </section>        
            <section class="px-2 item-skeleton-content d-none" style="">
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "joki")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>            
            <section class="px-2 item-skeleton-content d-none" style="">
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "voucher")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>
            <section class="px-2 item-skeleton-content d-none" style="">
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "pulsa")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>            
            <section class="px-2 item-skeleton-content d-none" style="">
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "e-money")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>            
            <section class="px-2 item-skeleton-content d-none" style="">
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "streamingapp")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>            
            </div>
            <div class="tab-pane fade" id="pills-game2" role="tabpanel" aria-labelledby="pills-game2-tab">
            <section class="px-2 item-skeleton-content d-none" style="">
                <h4 class="mb-2" style="font-size: 1rem;">TOPUP</h4><br>
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "game")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>
            </div>
             <div class="tab-pane fade" id="pills-voucher" role="tabpanel" aria-labelledby="pills-voucher-tab">
            <section class="px-2 item-skeleton-content d-none" style="">
                <h4 class="mb-2" style="font-size: 1rem;">VOUCHER</h4><br>
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "voucher")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>
            </div>
             <div class="tab-pane fade" id="pills-pulsadata" role="tabpanel" aria-labelledby="pills-pulsadata-tab">
            <section class="px-2 item-skeleton-content d-none" style="">
                <h4 class="mb-2" style="font-size: 1rem;">PULSA</h4><br>
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "pulsa")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>            
            </div>
            <div class="tab-pane fade" id="pills-ewallet" role="tabpanel" aria-labelledby="pills-ewallet-tab">
            <section class="px-2 item-skeleton-content d-none" style="">
                <h4 class="mb-2" style="font-size: 1rem;">E-WALLET</h4><br>
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "e-money")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>            
            </div>
            <div class="tab-pane fade" id="pills-streamingapp" role="tabpanel" aria-labelledby="pills-streamingapp-tab">
            <section class="px-2 item-skeleton-content d-none" style="">
                <h4 class="mb-2" style="font-size: 1rem;">STREAMING APP</h4><br>
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "streamingapp")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>            
            </div>
            <div class="tab-pane fade" id="pills-jasajoki" role="tabpanel" aria-labelledby="pills-jasajoki-tab">
            <section class="px-2 item-skeleton-content d-none" style="">
                <h4 class="mb-2" style="font-size: 1rem;">JASA MLBB</h4><br>
                <div class="product row">
                    
                    @foreach($kategori as $category)
                    
                    @if($category->tipe == "joki")
                    
                    <div class="col-4">
                        <a href="{{url('/order')}}/{{$category->kode}}" class="box">
                            <img class="shadow-sm" src="{{ $category->thumbnail  }}" alt="">
                            <span>{{ $category->sub_nama }}</span>
                            <p class="mb-0">{{ $category->nama }}</p>
                        </a>
                    </div>
                               
                    @endif
                             
                    @endforeach             
                            
                </div>
            </section>            
            </div>
        </div>    
            
            
            <section class="px-2 resultsearch d-none" style="padding-bottom: 2rem;">
                <h4 class="mb-2" style="font-size: 1rem;">Hasil Pencarian</h4><br>
                <div class="product productresultsearch row">
                    
   
                            
                </div>
            </section>
            
        </div>
        <div class="lb"></div>
        <div class="content-body">
            <div class="text-center py-3">
                <b>Metode Pembayaran</b>
            </div>
            <div class="owl-carousel metode-top owl-theme">
                @foreach($pay_method as $p)
                <div class="item">
                    <div class="metode">
                        <img src="{{$p->images}}" alt="" height="30">
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="owl-carousel metode-bottom owl-theme mb-4">
                @foreach($pay_method as $p)
                <div class="item">
                    <div class="metode">
                        <img src="{{$p->images}}" alt="" height="30">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="lb"></div>
                <div class="content-body pb-5">
            <div class="footer text-center pt-4">
                <img src="{{url('')}}{{ !$config ? '' : $config->logo_footer }}" alt="" width="176px" class="mb-3">
                <div class="sosmed">
                    <a href="{{ !$config ? '' : $config->url_wa }}" target="_blank">
                        <img src="/assets/icons/social-whatsapp.svg" alt="">
                    </a>
                    <a href="{{ !$config ? '' : $config->url_ig }}" target="_blank">
                        <img src="/assets/icons/social-instagram.svg" alt="">
                    </a>
                 </div>
                <p class="pb-4 text-copyright">&copy; 2022 {{ ENV('APP_NAME') }} - All Right Reserved</p>
            </div>
        </div>

        <div class="menu-bottom px-2">
            <div class="row">
                <div class="col-4">
                    <a href="{{url('/')}}" class="active">
                        <i class="mdi mdi-home"></i>
                        <p>Home</p>
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{url('/cari')}}">
                        <i class="mdi mdi-history"></i>
                        <p>Riwayat</p>
                    </a>
                </div>
                <div class="col-4">
                     @if(Auth::check())
                    @if(Auth()->user()->role == 'Member' || Auth()->user()->role == 'Platinum' || Auth()->user()->role == 'Gold')
                    <a href="{{url('/user/dashboard')}}">
                        <i class="mdi mdi-account-circle"></i>
                        <p>Akun</p>
                    </a>
                    @else
                    <a href="{{url('/dashboard')}}">
                        <i class="mdi mdi-account-circle"></i>
                        <p>Akun</p>
                    </a>
                    @endif
                    @else
                    <a href="{{url('/login')}}">
                        <i class="mdi mdi-account-circle"></i>
                        <p>Akun</p>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        






@push('custom_script')


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
            
            $('.search-input').keyup(function(){
               const data = $(this).val();
               if (data.length < 1) {
                     $('.skeleton-loader').removeClass('d-none');
                     $('.resultsearch').addClass('d-none');
                     $('.productresultsearch').empty();
                     setTimeout(() => {
                        $('.skeleton-loader').addClass('d-none');
                        $('.item-skeleton-content').removeClass('d-none');
                    }, 1000);
                }else{
                    
                    delay(function () {

                                            $.ajax({
                                                url: "{{url('/cari/index')}}",
                                                method: "POST",
                                                data: {
                                                    data: data
                                                },
                                                beforeSend: function () {
                                                    $('.item-skeleton-content').addClass('d-none');
                                                    $('.skeleton-loader').removeClass('d-none');
                                                    $('.resultsearch').addClass('d-none');
                                                    $('.productresultsearch').empty();
                                                },
                                                success: function (res) {
                                                    
                                                    setTimeout(() => {
                                                        $('.skeleton-loader').addClass('d-none');
                                                        $('.resultsearch').removeClass('d-none');
                                                        $('.productresultsearch').append(res);
                                                    }, 1000);
                                                }
                                            })

                                        }, 1000);
                    
                }
               
            });
            
        </script>


@endpush




@endsection