<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JulyhyusController extends Controller
{
    public function order($uid = null, $zone = null, $service = null)
    {
        $sign = md5(env("JULY_APIID").env("JULY_APIKEY"));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://julyhyus.id/api/game-feature');
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".env("JULY_APIKEY")."&sign=$sign&type=order&service=$service&data_no=$uid&data_zone=$zone");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $res = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if($err){
            return $err;
        }else{
            return $res;
        }
    }

    public function status($poid = null)
    {
        $sign = md5(env("JULY_APIID").env("VIP_APIKEY"));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://julyhyus.id/api/game-feature');
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".env("JULY_APIKEY")."&sign=$sign&type=status&trxid=$poid");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $res = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $res;
    }
}
