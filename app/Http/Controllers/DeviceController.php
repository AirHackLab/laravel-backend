<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeviceController extends Controller
{
    public function list(Request $request)
    {
        $devices = Device::pagination(15);
        return response()->json($devices);
    }

    public function view($id, Request $request) {
        $device = Device::find($id);
        return response()->json($device);
    }
    public function store(Request $request) {
        $id = $request->input('id', null);
        if($id) {
            $device = Device::find($id);
        } else {
            $device = new Device();
        }
        $device->serial = $request->input('name');
        $device->password = $request->input('password');
        $device->save();
        return response()->json($device);
    }

    public function delete($id, Request $request) {
        $device = Device::where('id', $id)->delete();
        return response()->json(['message' => 'deleted']);
    }
}
