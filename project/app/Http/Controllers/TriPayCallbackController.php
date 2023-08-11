<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use App\Models\Layanan;
use App\Models\Kategori;
use App\Models\Voucher;
use App\Http\Controllers\digiFlazzController;
use App\Http\Controllers\VipResellerController;
use App\Http\Controllers\ApiGamesController;
use App\Http\Controllers\SmileOneController;

class TriPayCallbackController extends Controller
{

    protected $api;

    public function __construct()
    {
        $this->api = \DB::table('setting_webs')->where('id',1)->first();
    }
    

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->api->tripay_private_key);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $uniqueRef = $data->reference;
        $status = strtoupper((string) $data->status);


        if ($data->is_closed_payment === 1) {
            $invoice = Pembayaran::where('reference', $uniqueRef)
                ->where('status', 'Belum Lunas')
                ->first();

            if (! $invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $uniqueRef,
                ]);
            }


            $order_id = $invoice->order_id;
            $dataPembeli = Pembelian::where('order_id', $order_id)->first();
            $dataLayanan = Layanan::where('layanan', $dataPembeli->layanan)->first();
            $dataKategori = Kategori::where('id', $dataLayanan->kategori_id)->first();

            $pesanPembeli = 
            "*Pembayaran Berhasil*\n\n" .
            "No Invoice: *$order_id*\n" .
            "Layanan : *$dataPembeli->layanan*\n" .
            "ID : *$dataPembeli->user_id*\n" .
            "Server : *$dataPembeli->zone*\n" .
            "Nickname : *$dataPembeli->nickname*\n" .
            "Harga : *Rp. " . number_format($dataPembeli->harga, 0, '.', ',') . "*\n" .
            "Status Pembelian: *Diproses*\n" .
            "Estimasi Proses: *1-5 Menit Max 24 Jam*\n\n" .
            "INI ADALAH PESAN OTOMATIS";

            $zoneSend = $dataPembeli->zone == null ? "" : "($dataPembeli->zone)\n";
            $nickname = $dataPembeli->nickname == null ? '' : "Nickname : $dataPembeli->nickname\n";

            $pesanAdmin = 
            "*Pembayaran Berhasil*\n\n" .
            "No Invoice: *$order_id*\n" .
            "Layanan : $dataPembeli->layanan\n" .
            "ID : $dataPembeli->user_id\n" .
            "Server : $dataPembeli->zone\n" .
            $nickname .
                "Metode Pembayaran : $invoice->metode\n" .
                "Harga : Rp. " . number_format($invoice->harga, 0, '.', ',') . "\n\n" .
                "*Kontak Pembeli*\n" .
                "No HP : $invoice->no_pembeli\n" .
                "Invoice : " . env("APP_URL") . "/pembelian/invoice/$order_id";

            $uid = $dataPembeli->user_id;
            $zone = $dataPembeli->zone;
            $provider_id = $dataLayanan->provider_id;

            switch ($status) {
                case 'PAID':

                    $requestPesan = $this->msg($this->api->nomor_admin, $pesanAdmin);
                    $pesanPembeli = $this->msg($invoice->no_pembeli, $pesanPembeli);
            
                    if($dataLayanan->provider == "digiflazz"){
                        $provider_order_id = rand(1, 10000);
                        $digiFlazz = new digiFlazzController;
                        $order = $digiFlazz->order($uid, $zone, $provider_id, $provider_order_id);
        
                        if ($order['data']['status'] == "Pending" || $order['data']['status'] == "Sukses") {
                            $order['data']['status'] = true;
                            $order['transactionId'] = $provider_order_id;
                        } else {
                            $order['data']['status'] = false;
                        }
                    }else if($dataLayanan->provider == "vip"){
                        $vip = new VipResellerController;
                        $order = $vip->order($uid, $zone, $provider_id);
                        
                        if($order['result']){
                            $order['data']['status'] = $order['result'];
                            $order['transactionId'] = $order['data']['trxid'];
                        }else{
                            $order['data']['status'] = false;
                        }
                    }else if($dataLayanan->provider == "apigames"){
                        $provider_order_id = rand(1, 10000);
                        $apigames = new ApiGamesController;
                        $order = $apigames->order($uid, $zone, $provider_id, $provider_order_id);
        
                        if($order['data']['status'] == "Sukses"){
                            $order['transactionId'] = $provider_order_id;
                            $order['data']['status'] = true;
                        }else{
                            $order['data']['status'] = false;
                        }
                    }else if($dataLayanan->provider == "joki"){
                        $order['data']['status'] = true;
                    }
                
                    if ($order['data']['status']) { // Jika pembelian sukses
                    
                    if($dataPembeli->tipe_transaksi !== 'joki'){
                        
                        
                        $pesanSukses = 
                        "*Pembelian Sukses*\n\n" .
                        "No Invoice: *$order_id*\n" .
                        "Layanan: *$dataPembeli->layanan*\n" .
                        "ID : *$dataPembeli->user_id*\n" .
                        "Server : *$dataPembeli->zone*\n" .
                        "Nickname : *$dataPembeli->nickname*\n" .
                        "Harga: *Rp. " . number_format($invoice->harga, 0, '.', ',') . "*\n" .
                        "Status Pembelian: *Sukses*\n" .
                    "*Invoice* : " . env("APP_URL") . "/pembelian/invoice/$order_id\n\n" .
                    "INI ADALAH PESAN OTOMATIS";
                    
                    $pesanSuksesAdmin = 
                        "*Pembelian Sukses*\n\n" .
                        "No Invoice: *$order_id*\n" .
                        "Layanan: *$dataPembeli->layanan*\n" .
                        "ID : *$dataPembeli->user_id*\n" .
                        "Server : *$dataPembeli->zone*\n" .
                        "Nickname : *$dataPembeli->nickname*\n" .
                        "Harga: *Rp. " . number_format($invoice->harga, 0, '.', ',') . "*\n" .
                        "Status Pembelian: *Sukses*\n\n" .
                        "*Kontak Pembeli*\n" .
                        "No HP : $invoice->no_pembeli\n" .
                    "*Invoice* : " . env("APP_URL") . "/pembelian/invoice/$order_id\n\n" .
                    "INI ADALAH PESAN OTOMATIS";
        
                        $requestSuksesAdmin = $this->msg($this->api->nomor_admin, $pesanSuksesAdmin);
                        $requestSukses = $this->msg($invoice->no_pembeli, $pesanSukses);

                    

                        $dataPembeli->update([
                            'provider_order_id' => isset($order['transactionId']) ? $order['transactionId'] : 0,
                            'status' => 'Sukses',
                            'log' => json_encode($order)
                        ]);
                        
                        
                        
                    }else{
                        
                        
                        $pesanSukses = 
                        "*Pembelian Sukses*\n\n" .
                        "No Invoice: *$order_id*\n" .
                        "Layanan: *$dataPembeli->layanan*\n" .
                        "ID : *$dataPembeli->user_id*\n" .
                        "Server : *$dataPembeli->zone*\n" .
                        "Nickname : *$dataPembeli->nickname*\n" .
                        "Harga: *Rp. " . number_format($invoice->harga, 0, '.', ',') . "*\n" .
                        "Status Pembelian: *Sukses*\n" .
                    "*Invoice* : " . env("APP_URL") . "/pembelian/invoice/$order_id\n\n" .
                    "INI ADALAH PESAN OTOMATIS";
                    
                    $pesanSuksesAdmin = 
                        "*Pembelian Sukses*\n\n" .
                        "No Invoice: *$order_id*\n" .
                        "Layanan: *$dataPembeli->layanan*\n" .
                        "ID : *$dataPembeli->user_id*\n" .
                        "Server : *$dataPembeli->zone*\n" .
                        "Nickname : *$dataPembeli->nickname*\n" .
                        "Harga: *Rp. " . number_format($invoice->harga, 0, '.', ',') . "*\n" .
                        "Status Pembelian: *Sukses*\n\n" .
                        "*Kontak Pembeli*\n" .
                        "No HP : $invoice->no_pembeli\n" .
                    "*Invoice* : " . env("APP_URL") . "/pembelian/invoice/$order_id\n\n" .
                    "INI ADALAH PESAN OTOMATIS";
        
                        $requestSuksesAdmin = $this->msg($this->api->nomor_admin, $pesanSuksesAdmin);
                        $requestSukses = $this->msg($invoice->no_pembeli, $pesanSukses);
        
                        
        
                        
                        
                    }
                    
                    
                

                    } else { //jika pembelian gagal

                    if($dataPembeli->tipe_transaksi !== 'joki'){
                        
                            $dataPembeli->update([
                            'status' => 'Batal',
                            'log' => json_encode($order)
                            ]);
                            
                    }

                    }
        


                    $invoice->update(['status' => 'PAID']);
                    break;

                case 'EXPIRED':
                    $invoice->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $invoice->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }
    }

    public function msg($nomor, $msg)
    {
        
        $data = [
            'token' => $this->api->wa_key,
            'phone'  => "$nomor",
            'message' => "$msg"
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://wa2.wisender.link/send-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array('Content-Type: application/json')
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
    }    

}
