<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\LayananPpob;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\TriPayController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\digiFlazzController;
use Illuminate\Support\Facades\Http;

class IsiUlangController extends Controller
{
    public function create(Kategori $kategori)
    {
        $data = Kategori::where('kode', $kategori->kode)->where('tipe', 'pulsa')->select('nama', 'server_id', 'thumbnail', 'id', 'kode')->first();
        if ($data == null) return back();

        return view('components.order-ppob', [
            'title' => $data->nama,
            'kategori' => $data,
        ]);        
    }

    public function layanan(Request $request)
    {
        $jenisNomor = '';
        $link2      =    substr($request->target, 0, 4);

        if (($link2 == '0811') or ($link2 == '0812') or ($link2 == '0813') or ($link2 == '0821') or ($link2 == '0822') or ($link2 == '0823') or ($link2 == '0851') or ($link2 == '0852') or ($link2 == '0853')) {
            $jenisNomor = 'TELKOMSEL';
        } else if (($link2 == '0817') or ($link2 == '0818') or ($link2 == '0819') or ($link2 == '0859') or ($link2 == '0877') or ($link2 == '0878')) {
            $jenisNomor = 'XL';
        } else if (($link2 == '0896') or ($link2 == '0897') or ($link2 == '0898') or ($link2 == '0899') or ($link2 == '0895')) {
            $jenisNomor = 'TRI';
        } else if (($link2 == '0881') or ($link2 == '0882') or ($link2 == '0883') or ($link2 == '0884') or ($link2 == '0885') or ($link2 == '0886') or ($link2 == '0887') or ($link2 == '0888') or ($link2 == '0889') or ($link2 == '0895') or ($link2 == '0896') or ($link2 == '0897') or ($link2 == '0898') or ($link2 == '0899')) {
            $jenisNomor = 'SMART';
        } else if (($link2 == '0998') or ($link2 == '0999') or ($link2 == '0888') or ($link2 == '0883') or ($link2 == '0884') or ($link2 == '0885') or ($link2 == '0886') or ($link2 == '0887') or ($link2 == '0888') or ($link2 == '0889')) {
            $jenisNomor = 'BOLT';
        } else if (($link2 == '0828')) {
            $jenisNomor = 'CERIA';
        } else if (($link2 == '0838') or ($link2 == '0831') or ($link2 == '0832') or ($link2 == '0833')) {
            $jenisNomor = 'AXIS';
        } else if (($link2 == '0855') or ($link2 == '0856') or ($link2 == '0857') or ($link2 == '0858') or ($link2 == '0814') or ($link2 == '0815') or ($link2 == '0816')) {
            $jenisNomor = 'INDOSAT';
        } else {
            $jenisNomor = "tidak ada";
        }

        $data = LayananPpob::where('brand', $jenisNomor)->select('id', 'layanan')->get();
        if ($data == "[]") return response()->json(['status' => false, 'data' => 'Layanan tidak ada']);
        $dataHtml = '';
        foreach ($data as $layanan) {
            $dataHtml .= "<div class='col-md-4 col-6 mt-2'>" .
            "<input type='radio' class='btn-check' name='nominal' id='$layanan->id' autocomplete='off' value='$layanan->id'>" .
            "<label class='btn btn-secondary d-block fw-light but' for='$layanan->id'> $layanan->layanan" .
            "</label>" .
            "</div>";
        }

        return response()->json([
            'status' => true,
            'data' => $dataHtml
        ]);        
    }

    public function price(Request $request)
    {
        if(Auth::user()){
            $data = LayananPpob::where('id', $request->nominal)->select('harga_reseller AS harga')->first();
        }else{
            $data = LayananPpob::where('id', $request->nominal)->select('harga')->first();
        }

        return response()->json([
            'status' => true,
            'harga' => "Rp. " . number_format($data->harga, 0, '.', ',')
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'nomorTarget' => 'required|numeric',
            'service' => 'required|numeric',
            'captcha' => 'required',
            'payment_method' => 'required',
            'nomor' => 'required|numeric',
            'email' => 'required'
        ]);

        $data = "secret=" . ENV('CAPTCHA_SECRET') . "&response=" . $request->captcha;
        $ch = curl_init("https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $exec = json_decode(curl_exec($ch));

        if (!$exec->success) return response()->json(['status' => false, 'data' => 'Validasi recaptcha gagal harap reload halaman ini']);
        
        if(Auth::user()){
            $harga = LayananPpob::where('id', $request->service)->select('harga_reseller AS harga')->first();
        }else{
            $harga = LayananPpob::where('id', $request->service)->select('harga')->first();
        }

        $sendData = "Target : <span id='nick'>$request->nomorTarget</span><br>
                            Harga : Rp. " . number_format($harga->harga, 0, '.', ',') .
        "<br>Metode Pembayaran : " . strtoupper($request->payment_method) .
            "<br><br>Catatan : Harga diatas belum termasuk biaya admin";

        return response()->json([
            'status' => true,
            'data' => $sendData
        ]);        
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|numeric',
            'service' => 'required|numeric',
            'payment_method' => 'required',
            'email' => 'required'
        ]);

        $request->nomor = preg_replace("/^0/", "62", $request->nomor);

        if(Auth::user()){
            $dataLayanan = LayananPpob::where('id', $request->service)->select('layanan', 'harga_reseller AS harga', 'kategori_id', 'provider_id')->first();
        }else{
            $dataLayanan = LayananPpob::where('id', $request->service)->select('layanan', 'harga', 'kategori_id')->first();
        }

        $order_id = Str::random('6');
        $rand = rand(1, 1000);
        $tripay = new TriPayController();

        if ($request->payment_method == "ovo" || $request->payment_method == "gopay") {

            $tripayRes['amount'] = $dataLayanan->harga + $rand;
        
            if ($request->payment_method == "ovo") {
                $tripayRes['no_pembayaran'] = ENV("OVO_ADMIN");
            } else {
                $tripayRes['no_pembayaran'] = ENV("GOPAY_ADMIN");
            }

        } else if ($request->payment_method == "QRISC") {

            $tripayRes = $tripay->request($order_id, $dataLayanan->harga, $request->payment_method, $request->email, $request->nomor);
        } else if (
            $request->payment_method == "MYBVA" || $request->payment_method == "BRIVA" || $request->payment_method == "BNIVA" ||
            $request->payment_method == "MANDIRIVA" || $request->payment_method == "BCAVA" || $request->payment_method == "CIMBVA" ||
            $request->payment_method == "MUAMALATVA" || $request->payment_method == "CIMBVA" || $request->payment_method == "BSIVA") {

            $tripayRes = $tripay->request($order_id, $dataLayanan->harga, $request->payment_method, $request->email, $request->nomor);

        } else if ($request->payment_method == "ALFAMART" || $request->payment_method == "INDOMARET") {

            $tripayRes = $tripay->request($order_id, $dataLayanan->harga, $request->payment_method, $request->email, $request->nomor);

        } else if($request->payment_method == "Saldo"){

            $tripayRes['amount'] = $dataLayanan->harga;

        } else {

            return response()->json([
                'status'     => false,
                'data'    => "Tipe pembayaran tidak sah"
            ]);

        }

        if ($request->payment_method == "ovo" || $request->payment_method == "gopay") {
            $pesan = "*TOPUP-$order_id*\n\n" .
            "Pembelian *$dataLayanan->layanan* telah berhasil dipesan, saat ini kami sedang menunggu pembayaran anda melalui *$request->payment_method* dengan jumlah *Rp. " . number_format($tripayRes['amount'], 0, '.', ',') . "*\n\n" .
                "Ke Nomor : " . $tripayRes['no_pembayaran'] . " (Tanpa Dikurangi/Ditambah)\n\n" .
                "Harap melakukan pembayaran sebelum 1x24 jam setelah pesanan anda dibuat.\n\n" .
                "Invoice : " . env("APP_URL") . "/pembelian/invoice/$order_id\n\n" .
                "INI ADALAH PESAN OTOMATIS";
        } else if ($request->payment_method == "Saldo") {
            $pesan = "Pembayaran Rp " . number_format($tripayRes['amount'], 0, '.', ',') . " Berhasil\n\n" .
            "*Estimasi Proses Pengisian*\n" .
            "- 1-15 Menit Max 24 Jam Untuk Top Up All Game\n" .
            "- 3-7 Jam Max 24 Jam Untuk Aplikasi Premium\n\n" .
            "INI ADALAH PESAN OTOMATIS";
        } else {
            $pesan = "*TOPUP-$order_id*\n\n" .
            "Pembelian *$dataLayanan->layanan* telah berhasil dipesan, saat ini kami sedang menunggu pembayaran anda melalui $request->payment_method dengan jumlah  *Rp. " . number_format($tripayRes['amount'], 0, '.', ',') . "*\n\n" .
                "Harap melakukan pembayaran sebelum 1x24 jam setelah pesanan anda dibuat.\n\n" .
                "*Invoice* : " . env("APP_URL") . "/pembelian/invoice/$order_id\n\n" .
                "INI ADALAH PESAN OTOMATIS";
        }

        if($request->payment_method != "Saldo"){
            $requestPesan = Http::post(ENV("WHATSAPP_GATEAWAY_URL") . "/chat/send/?id=" . ENV("APP_NAME"), ['receiver' => "+" . $request->nomor, 'message' => $pesan]);
            $responPesan = json_decode($requestPesan->getBody());

            $pembelian = new Pembelian();
            $pembelian->order_id = $order_id;
            $pembelian->user_id = $request->nomorTarget;
            $pembelian->nickname = $request->nomorTarget;
            $pembelian->layanan = $dataLayanan->layanan;
            $pembelian->harga = $tripayRes['amount'];
            $pembelian->profit = $tripayRes['amount'] * ENV("MARGIN_PROFIT");
            $pembelian->tipe_transaksi = 'ppob';
            $pembelian->status = 'Menunggu';
            $pembelian->save();
    
            $pembayaran = new Pembayaran();
            $pembayaran->order_id = $order_id;
            $pembayaran->harga = $tripayRes['amount'];
            $pembayaran->no_pembayaran = $tripayRes['no_pembayaran'];
            $pembayaran->no_pembeli = $request->nomor;
            $pembayaran->status = 'Belum Lunas';
            $pembayaran->metode = $request->payment_method;
            $pembayaran->reference = $tripayRes['reference'];
            $pembayaran->save();
        }else if($request->payment_method == "Saldo"){
            $user = User::where('username', Auth::user()->username)->first();
            
            if ($dataLayanan->harga > $user->balance) return response()->json(['status' => false, 'data' => 'Saldo anda tidak cukup']);

            $digi = new digiFlazzController;
            $provider_order_id = rand(1, 100000);
            $order = $digi->order($request->nomorTarget, null, $dataLayanan->provider_id, $provider_order_id);
            
            if ($order['data']['status'] == "Pending" || $order['data']['status'] == "Sukses") {
                $order['data']['status'] = true;
            } else {
                $order['data']['status'] = false;
            }   

            if($order['data']['status']){

                $pesanAdmin = "*PEMBAYARAN-$order_id* TELAH LUNAS\n\n" .
                    "LAYANAN : $dataLayanan->layanan\n" .
                    "USER ID : $request->user_id $request->zone\n" .
                    "NICKNAME : $request->nickname\n" .
                    "PEMBAYARAN : $request->payment_method\n" .
                    "HARGA : Rp. " . number_format($dataLayanan->harga, 0, '.', ',') . "\n\n" .
                    "*Kontak Pembeli*\n" .
                    "No HP : $request->nomor\n" .
                    "Invoice : " . env("APP_URL") . "/pembelian/invoice/$order_id";


                $requestPesan = Http::post(ENV("WHATSAPP_GATEAWAY_URL")."/chat/send/?id=".ENV("APP_NAME"), ['receiver' => "+" . $request->nomor, 'message' => $pesan]);
                $requestPesanAdmin = Http::post(ENV("WHATSAPP_GATEAWAY_URL") . "/chat/send/?id=" . ENV("APP_NAME"), ['receiver' => "+" . ENV("NOMOR_ADMIN"), 'message' => $pesanAdmin]);

                $user->update([
                    'balance' => $user->balance - $dataLayanan->harga
                ]);

                $pembelian = new Pembelian();
                $pembelian->order_id = $order_id;
                $pembelian->username = Auth::user()->username;
                $pembelian->user_id = $request->nomorTarget;
                $pembelian->nickname = $request->nomorTarget;
                $pembelian->layanan = $dataLayanan->layanan;
                $pembelian->harga = $dataLayanan->harga;
                $pembelian->profit = $dataLayanan->harga * ENV("MARGIN_PROFIT");
                $pembelian->status = 'Pending';
                $pembelian->provider_order_id = $provider_order_id;
                $pembelian->log = $order['data']['message'];
                $pembelian->tipe_transaksi = 'ppob';
                $pembelian->save();

                $pembayaran = new Pembayaran();
                $pembayaran->order_id = $order_id;
                $pembayaran->harga = $dataLayanan->harga;
                $pembayaran->no_pembayaran = "SALDO";
                $pembayaran->no_pembeli = $request->nomor;
                $pembayaran->status = 'Lunas';
                $pembayaran->metode = $request->payment_method;
                $pembayaran->reference = '';
                $pembayaran->save();                     
            }else{
                return response()->json([
                    'status' => false,
                    'data' => 'Layanan saat ini sedang gangguan'
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'order_id' => $order_id
        ]);        
    }
}
