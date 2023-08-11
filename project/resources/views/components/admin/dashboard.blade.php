@extends('main-admin')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Admin Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Admin/</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<!-- stats with icon -->
<div class="text-center">
    <h4 class="page-title">Transaksi Hari Ini</h4>
</div>
<div class="row mt-2">
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TOTAL TRANSAKSI HARI INI</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_pembelian, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_pembelian }}x pemesanan</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-primary" data-feather="shopping-bag"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TRANSAKSI BERHASIL</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_pembelian_success, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_pembelian_success }}x pemesanan</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-success" data-feather="shopping-bag"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TRANSAKSI PENDING</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_pembelian_pending, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_pembelian_pending }}x pemesanan</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-info" data-feather="shopping-bag"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TRANSAKSI BATAL</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_pembelian_batal, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_pembelian_batal }}x pemesanan</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-danger" data-feather="shopping-bag"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TOTAL DEPOSIT</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_deposit, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_deposit }}x pembayaran</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-warning" data-feather="dollar-sign"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <h4 class="page-title">Laporan Keseluruhan</h4>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TOTAL SELURUH TRANSAKSI</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_keseluruhan_pembelian, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_keseluruhan_pembelian }}x pemesanan</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-primary" data-feather="shopping-bag"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TOTAL SELURUH TRANSAKSI BERHASIL</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_keseluruhan_pembelian_berhasil, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_keseluruhan_pembelian_berhasil }}x pemesanan</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-success" data-feather="shopping-bag"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TOTAL SELURUH TRANSAKSI PENDING</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_keseluruhan_pembelian_pending, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_keseluruhan_pembelian_pending }}x pemesanan</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-info" data-feather="shopping-bag"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TOTAL SELURUH TRANSAKSI BATAL 
                        </span>
                        <h3 class="mb-0">Rp. {{ number_format($total_keseluruhan_pembelian_batal, '0', '.', ',') }}</h3>
                        <small>Dengan total {{ $banyak_keseluruhan_pembelian_batal }}x pemesanan</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-danger" data-feather="shopping-bag"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TOTAL SELURUH DEPOSIT</span>
                        <h3 class="mb-0">Rp. {{ number_format($total_keseluruhan_deposit, '0','.',',') }}</h3>
                        <small>Dengan total {{ $banyak_keseluruhan_deposit }}x pembayaran</small>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-warning" data-feather="dollar-sign"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">TOTAL KEUNTUNGAN BERSIH</span>
                        <h3 class="mb-0">Rp. {{ number_format($keuntungan_bersih, '0','.',',') }}</h3>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <span class="icon-lg icon-dual-info" data-feather="trending-up"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <span class="text-muted text-uppercase fs-12 fw-bold">GRAFIK PESANAN 7 HARI TERAKHIR</span>

        <div id="order-chart"></div>
    </div>
</div>
<!-- icon end -->
<script type="text/javascript">
    $(function() {
        new Morris.Area({
            element: 'order-chart',
            data: <?php echo $morris_data; ?>,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Pesanan'],
            lineColors: ['#188ae2'],
            gridLineColor: '#eef0f2',
            pointSize: 0,
            lineWidth: 0,
            resize: true,
            parseTime: false,
        });
    });
</script>
@endsection