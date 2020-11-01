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
        return response(implode("\n", $array), 200)
        ->header('Content-Type', 'text/plain');
    }

    private function mosquitto_pw($plain, $algo = 'sha256', $iterations = 901, $saltlen = 12, $keylen = 24)
    {
        $salt = base64_encode(openssl_random_pseudo_bytes($saltlen));
        $hash = hash_pbkdf2($algo, $plain, $salt, $iterations, $keylen, true);
        return sprintf('PBKDF2$%s$%d$%s$%s', $algo, $iterations, $salt, base64_encode($hash));
    }
}
