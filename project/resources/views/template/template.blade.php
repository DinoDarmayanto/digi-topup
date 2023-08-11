<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ !$config ? '' : $config->judul_web }}</title>
    
    <meta name="title" content="{{ !$config ? '' : $config->judul_web }}">
    <meta name="description" content="{{ !$config ? '' : $config->deskripsi_web }}">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ ENV('APP_URL') }}">
    <meta property="og:title" content="{{ !$config ? '' : $config->judul_web }}">
    <meta property="og:description" content="{{ !$config ? '' : $config->deskripsi_web }}">
    <meta name="twitter:image" content="{{ !$config ? '' : $config->logo_footer }}" />
    <meta property="og:image" content="{{ !$config ? '' : $config->logo_footer }}" />
    <meta name="robots" content="index, follow">
    <meta content="desktop" name="device">
    <meta name="author" content="{{ ENV('APP_NAME') }}">
    <meta name="coverage" content="Worldwide">
    <meta name="apple-mobile-web-app-title" content="{{ !$config ? '' : $config->judul_web }}">
    
    <link rel="shortcut icon" href="{{ url('') }}{{ !$config ? '' : $config->logo_favicon }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/themes/green/pace-theme-flash.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    
    
    <meta name="theme-color" content="#000000">
    <meta name="msapplication-navbutton-color" content="#000000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    
    <style>
        @import  url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.css');
        @import  url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        :root {
            --warna_1: <?= $config->warna1; ?>;
            --warna_2: <?= $config->warna2; ?>;
            --warna_3: <?= $config->warna3; ?>;
            --warna_4: <?= $config->warna4; ?>;
        }
        textarea:hover, 
        input:hover, 
        textarea:active, 
        input:active, 
        textarea:focus, 
        input:focus,
        button:focus,
        button:active,
        button:hover,
        label:focus,
        .btn:active,
        .btn.active
        {
            outline:0px !important;
            -webkit-appearance:none;
            box-shadow: none !important;
        }

        body {
            color: #fff;
            background: var(--warna_1);
            font-family: Roboto;
        }
        
        .bg-primary {
            background: var(--warna_2) !important;
        }
        .bg-secondary {
            background: var(--warna_3) !important;
        }
        .bg-white-custom {
            background: var(--warna_3) !important;
        }
        .bg-card {
            color: #fff;
            background: var(--warna_2);
        }
        
        .navbar {
            color: #fff;
            background: var(--warna_2);
        }
        .navbar-toggler {
            font-size: 32px;
        }
        .offcanvas.offcanvas-end {
            background: var(--warna_2);
        }
        .navbar-nav .nav-link {
            color: #fff;
        }
        .btn-login {
            color: #fff;
            background: #0d6efd!important;
        }
        
        .content-body {
            padding: 0 5px;
            padding-top: 80px;
        }
        @media (min-width: 576px){
            .content-body {
                margin: 0 auto;
                max-width: 1140px;
                padding-top: 80px;
            }
        }
        
        .resultsearch {
            width: 100%;
            inset: 0px auto auto 0px;
            margin: 0px;
            transform: translate(0px, 50px);
            background-color: #000000;
            border-color: rgba(0,0,0,.15);
            color: #fff;
            overflow-y: auto;
            max-height: 500px;
        }
        @media (min-width: 768px) {
            .resultsearch {
                width: 50%;
                max-height: 500px;
                transform: translate(220px, 50px);
            }
        }
        .resultsearch .dropdown-item:hover{
           background-color: #000000;
           color: #fff;
       }
       .search-bar input{
        border: none;
        color: rgb(156 163 175);
        background: #ffffff;
        border-radius: 9999px;
    }
    .search-bar span{
        border: none;
        border-radius: 9999px;
        color: rgb(156 163 175);
        background: #ffffff;
    }
    .search-bar ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: #878aad;
      opacity: 1; /* Firefox */
  }
  .input-box:focus {
    color: #000;
    background: #ffffff;
}
.img-search{
    padding-left: 15px;
}

.swiper-container {
  width: 100%;
  overflow: hidden;
}

.swiper-slide {
  background-position: center;
  background-size: cover;
  width: 80%;
  height: 100%;
}

.swiper-slide img {
  display: block;
  width: 100%;
  border-radius: 12px;
}
@media (max-width: 576px){
    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%!important;
      border-radius: 12px;
  }
}
.swiper-pagination {
    margin-top: 30px!important;
}

.content-body form input {
    outline: none;
    margin-top: -30px;
    border: none !important;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
}

.row {
    --bs-gutter-x: 0.5rem;
}
.product .box{
    margin-bottom:40px;
}

@media (max-width: 576px){
    .product .box {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border-radius: 0.75rem;
        text-align: center;
        background: #646464;
        display: block;
        text-decoration: none;
        color: #fff;
        height: 10rem;
    }
}
@media (min-width: 576px){
  .product .box {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border-radius: 0.75rem;
    text-align: center;
    background: #646464;
    display: block;
    text-decoration: none;
    color: #fff;
    height: 15rem;
}
}

.card-product {
    
    margin-bottom: -30px;
    gap: 0.5rem;
}

@media (max-width: 576px) {
    .product p {
        font-size: 12px!important;
    }
}

.product .box img {
    width: 100%;
    height: 100%;
    display: block;
    margin: auto;
    object-fit: cover;
    border-radius: 0.75rem;
}

.card {
    cursor: pointer;
}

.kbrstore-pgimg {
  background-color: white;
  border-radius: 3px;
  border: 1px solid white;
  height: 15px;
}

.footer img {
    padding-top: 2.5rem 0;
}
.text-copyright {
    color: #718096;
    font-size: 0.875rem;
}

.sosmed {
    margin-bottom: 20px;
}
.sosmed a {
    margin: 0 10px;
    text-decoration: none;
    color: #fff;
}
.sosmed i {
    font-size: 24px;
}


.item .metode {
    margin: 5px 0;
    background: #fff;
    border-radius: 8px;
    padding: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
}
.my-form label {
    font-size: 1rem;
}
.my-form .form-control {
    background: #fefefe;
    margin-top: 6px;
    border: 2px solid #fefefe !important;
}
.my-form .form-control:active, .my-form .form-control:focus {
    border-color: #fefefe !important;
    box-shadow: none !important;
    outline: none !important;
}

.method-list {
    overflow: hidden;
    cursor: pointer;
}
.method-list.active {
    border-color: var(--warna_2) !important;
}
.method-list.active:before {
    display: inline-block;
    content: 'L';
    position: relative;
    background: var(--warna_2);
    margin-left: -12px;
    height: 53px;
    line-height: 40px;
    width: 20px;
    text-align: center;
    color: #fff;
    top: -23px;
    transform: rotate(45deg) scaleX(-1);;
}
.method-list.active table {
    margin-top: -53px;
}
.search-item {
    width: 50%;
}
@media (min-width: 768px) {
    .search-item {
        width: 50%;
        margin-left: 100px;
    }
}

.swal2-popup {
    display: none;
    position: relative;
    box-sizing: border-box;
    grid-template-columns: minmax(0, 100%);
    width: 32em;
    max-width: 100%;
    padding: 0 0 1.25em;
    border: none;
    border-radius: 5px;
    background: #ffffff!important;
    color: #000!important;
    font-family: inherit;
    font-size: 1rem;
}
.swal2-html-container {
    z-index: 1;
    justify-content: center;
    margin: 1em 1.6em 0.3em;
    padding: 0;
    overflow: auto;
    color: inherit;
    font-size: 1.125em;
    font-weight: normal;
    line-height: normal;
    text-align: left!important;
    word-wrap: break-word;
    word-break: break-word;
}
.flex-1 {
    flex: 1 1 0%;
}


.fab-container {
    position: fixed;
    bottom: 70px;
    right: 10px;
    z-index: 999;
    cursor: pointer;
}

.fab-icon-holder {
    width: 45px;
    height: 45px;
    bottom: 140px;
    left: 10px;
    color: #FFF;
    background: #FFF;
    /* padding: 1px; */
    border-radius: 10px;
    text-align: center;
    font-size: 30px;
    z-index: 99999;
}

.fab-icon-holder:hover {
    opacity: 0.8;
}

.fab-icon-holder i {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-size: 25px;
    color: #ffffff;
}

.fab-options {
    list-style-type: none;
    margin: 0;
    position: absolute;
    bottom: 48px;
    left: -37px;
    opacity: 0;
    transition: all 0.3s ease;
    transform: scale(0);
    transform-origin: 85% bottom;
}

.fab:hover+.fab-options,
.fab-options:hover {
    opacity: 1;
    transform: scale(1);
}

.fab-options li {
    display: flex;
    justify-content: flex-start;
    padding: 5px;
}



</style>



@yield('custom_style')



<body>
    <div class="content">
    	
        @yield('content')
        <div class="content-body">
          <footer class="footer mt-3">
            <div class="">
              <div class="row">
                <div class="col-md-3 col-lg-4 p-4">
                    <img src="{{url('')}}{{ !$config ? '' : $config->logo_footer }}" alt="LOGO" class="logo-bawah w-50">
                    <div class="mt-2 ratakirikanan">
                        <p>Top Up Game Favoritmu termurah hanya di {{ ENV('APP_NAME') }}, seperti Top Up Mobile Legends, Top Up FF (Free Fire) dan Top Up Game Favoritmu lainnya dengan proses cepat dan otomatis</p>
                    </div>
                </div>
                

                
                <div class="col-md-3 col-lg-4 p-4">
                  <h5 class="mt-2 mb-1">Metode Pembayaran</h5>
                  <div class="mt-3">
                    <img src="/assets/payment/qris.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/OVO.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/Shopeepay.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/Linkaja.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/alfamart.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/indomaret.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/bncva.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/briva.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/bni.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/cimbva.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/danamonva.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/mandiri.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/maybankva.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/permatava.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/sinarmasva.webp" class="kbrstore-pgimg">
                    <img src="/assets/payment/dana.png" class="kbrstore-pgimg">
                    <img src="/assets/payment/Gopay.webp" class="kbrstore-pgimg">
                    
                </div>
            </div>
            <div class="col-md-3 col-lg-2 p-4">
              <h5 class="mt-2 mb-1">Site Map</h5>
              <div class="mt-3">
                 @if(Auth::check())
                 @if(Auth()->user()->role == 'Member' || Auth()->user()->role == 'Platinum' || Auth()->user()->role == 'Gold')
                 <i class="fa-solid fa-house"></i><a href="{{url('')}}" class="text-white text-decoration-none active"> Home</a><br>
                 <i class="fa-solid fa-magnifying-glass"></i><a href="{{url('/cari')}}" class="text-white text-decoration-none ">
                 Cek Pesanan</a><br>
                 
                 <i class="fa fa-list"></i><a href="{{url('/daftar-harga')}}" class="text-white text-decoration-none ">
                 Daftar Harga</a><br>
                 
                 <i class="fa-solid fa-clock-rotate-left"></i><a href="{{url('/riwayat-pembelian')}}" class="text-white text-decoration-none ">
                 Riwayat Pembelian</a><br>
                 <i class="fa-solid fa-wallet"></i><a href="{{url('/deposit')}}" class="text-white text-decoration-none ">
                 Top Up Saldo</a><br>
                 <i class="fa-solid fa-user-pen"></i><a href="{{url('/user/edit/profile')}}" class="text-white text-decoration-none ">
                 Edit Profile</a><br>
                 <i class="fa-solid fa-circle-up"></i><a href="{{url('/membership')}}" class="text-white text-decoration-none ">
                 Upgrade Membership</a><br>
                 @else
                 <i class="fa-solid fa-house"></i><a href="{{url('')}}" class="text-white text-decoration-none active"> Home</a><br>
                 <i class="fa-solid fa-magnifying-glass"></i><a href="{{url('/cari')}}" class="text-white text-decoration-none ">
                 Cek Pesanan</a><br>
                 <i class="fa fa-list"></i><a href="{{url('/daftar-harga')}}" class="text-white text-decoration-none ">
                 Daftar Harga</a><br>
                 @endif
                 @else
                 <i class="fa-solid fa-house"></i><a href="{{url('')}}" class="text-white text-decoration-none active"> Home</a><br>
                 <i class="fa-solid fa-magnifying-glass"></i><a href="{{url('/cari')}}" class="text-white text-decoration-none ">
                 Cek Pesanan</a><br>
                 <i class="fa fa-list"></i><a href="{{url('/daftar-harga')}}" class="text-white text-decoration-none ">
                 Daftar Harga</a><br>
                 @endif
             </div>
         </div>
         <div class="col-md-3 col-lg-2 p-4">
          <h5 class="mt-2 mb-1">Hubungi Kami</h5>
          <div class="mt-3">
           <i class="fab fa-whatsapp"></i><a href="{{ !$config ? '' : $config->url_wa }}" target="_blank" class="text-white text-decoration-none"> WhatsApp</a><br>
           <i class="fab fa-instagram"></i><a href="{{ !$config ? '' : $config->url_ig }}" target="_blank" class="text-white text-decoration-none"> Instagram</a><br>
           <i class="fab fa-facebook"></i><a href="{{ !$config ? '' : $config->url_fb }}" target="_blank" class="text-white text-decoration-none"> Facebook</a><br>
       </div>
   </div>
</div>
</div>
<div class="container-fluid mt-2">
    <div class="row" id="footer-credit">
      <div class="col">
        <div class="container mt-2 mb-2 text-center">
          <small>Copyright © 2023 <a href="{{url('')}}" class="text-white text-decoration-none">{{ ENV('APP_NAME') }}</a> All Rights Reserved</small>
      </div>
  </div>
</div>
</div>

<!---live chat-->
<div class="fab-container">
    <div class="fab fab-icon-holder"  style="background-color: #fff;">
        <img src="assets/image/call-center.png" style="width: 100%; height: auto; display: block; margin: 0 auto;">
    </div>
    <ul class="fab-options">
        <li>
            <a href="{{ !$config ? '' : $config->url_ig }}" class="text-decoration-none" target="_blank">
                <div class="fab-icon-holder" style="background-color: #e61c6d;">
                    <i class="fa-brands fa-instagram"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ !$config ? '' : $config->url_wa }}" class="text-decoration-none" target="_blank">
                <div class="fab-icon-holder" style="background-color: #25D366;">
                    <i class="fab fa-whatsapp"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ !$config ? '' : $config->url_fb }}" class="text-decoration-none" target="_blank">
                <div class="fab-icon-holder" style="background-color: #1877f2;">
                    <i class="fab fa-facebook"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="act-btn-top text-decoration-none" target="_blank" style="display: none; background-color: #bd4cae; bottom: 19px;">
                <i class="fas fa-angle-up mt-2"></i>
            </a>
        </li>
        <!--end-->
        
    </footer>
</div>
</div>
<div class="modal fade" tabindex="-1" id="modal-logout">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-card">
          <div class="modal-header border-bottom-0">
              <h5 class="modal-title">Logout</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p>Apakah anda yakin untuk keluar dari akun ?</p>
              <div class="text-end">
                  <form method="POST" action="{{url('/logout')}}">
                     @csrf		                   
                     <button type="button" class="btn btn-default text-white" data-bs-dismiss="modal">No</button>
                     <button type="submit" class="btn btn-danger">Yes</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    var modal_logout = new bootstrap.Modal(document.getElementById('modal-logout'));
    function logout() {
        modal_logout.show();
    }
</script>
<script>
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
        } else { delay(function () {

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

<script>
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>


@stack('custom_script')

</body>
</html>