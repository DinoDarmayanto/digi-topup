<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class digiFlazzController extends Controller
{
    public function order($uid = null, $zone = null, $service = null, $order_id = null)
    {
        
        $api = \DB::table('setting_webs')->where('id',1)->first();
        
        $target = $uid . $zone;
        $sign = md5($api->username_digi.$api->api_key_digi . strval($order_id));
        $api_postdata = array(
            'username' => $api->username_digi,
            'buyer_sku_code' => $service,
            'customer_no' => "$target",
            'ref_id' => strval($order_id),
            'sign' => $sign,
        );

        $header = array(
            'Content-Type: application/json',
        );

        return $this->connect("/v1/transaction", $api_postdata, $header);
    }

    public function status($poid = null, $pid = null, $uid = null, $zone = null)
    {
        $api = \DB::table('setting_webs')->where('id',1)->first();
        
        $target = $uid . $zone;
        $sign = md5($api->username_digi.$api->api_key_digi . strval($poid));
        $header = array(
            'Content-Type: application/json',
        );

        $data = array(
            'command' => 'status-pasca',
            'username' => $api->username_digi,
            'buyer_sku_code' => $pid,
            'customer_no' => $target,
            'ref_id' => $poid,
            'sign' => $sign
        );        

        return $this->connect("/v1/transaction", $data, $header);
    }

    public function harga()
    {
        $api = \DB::table('setting_webs')->where('id',1)->first();
        
        $sign = md5($api->username_digi.$api->api_key_digi."pricelist");
        $data = array(
            'username' => $api->username_digi,
            'sign' => $sign
        );
        $header = array(
            'Content-Type: application/json',
        );

        return $this->connect('/v1/price-list', $data, $header);
    }

    public function connect($url, $data, $header)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.digiflazz.com".$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $chresult = curl_exec($ch);
        curl_close($ch);
        $json_result = json_decode($chresult, true);
        return $json_result;        
    }
}
