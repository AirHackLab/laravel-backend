<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    public function list(Request $request)
    {
        $devices = Device::paginate(15);
        return response()->json($devices);
    }

    public function view($id, Request $request) {
        $device = Device::find($id);
        return response()->json($device);
    }

    public function store(Request $request) {
        $id = $request->input('id', null);
        $data = [];
        if($id) {
            $device = Device::find($id);
            $data['id'] = $id;
        } else {
            $device = new Device();
            $data['password'] = Str::random(13);
        }
        $data['serial'] = $request->input('serial');
        $device->upsert($data);
        return response()->json($device);
    }

    public function delete($id, Request $request) {
        $device = Device::where('id', $id)->delete();
        return response()->json(['message' => 'deleted']);
    }
}
