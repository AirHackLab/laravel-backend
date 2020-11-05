<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class MosquittoController extends Controller
{
    public function list(Request $request)
    {
        $devices = Device::all();
        $array = [];
        foreach($devices as $device) {
            $array[] = $device->serial . ":" . $this->mosquitto_pw($device->password);
        }
        return response(implode("\n", $array), 200)->header('Content-Type', 'text/plain');
    }

    private static function mosquitto_pw($plain)
    {
        $salt_base64="mfJ0Eq3rIDLKG33r";
        $salt=base64_decode($salt_base64);
        $hash=hash("sha512",$plain.$salt, true);
        $hash_base64=base64_encode($hash);
        return "$6$".$salt_base64."$".$hash_base64;
    }
}
