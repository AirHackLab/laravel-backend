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
        $is_admin = auth()->user()->is_admin;
        $user_id = auth()->user()->id;
        $devices = $is_admin ? Device::paginate(15) : Device::where('user_id', $user_id)->paginate(15);
        return response()->json($devices);
    }

    public function view($id, Request $request) {
        $is_admin = auth()->user()->is_admin;
        $user_id = auth()->user()->id;
        $device = $is_admin ? Device::find($id) : Device::where('user_id', $user_id)->where('id', $id)->firstOrFail();
        return response()->json($device);
    }

    public function store(Request $request) {
        $is_admin = auth()->user()->is_admin;
        $user_id = auth()->user()->id;
        $id = $request->input('id', null);
        $id = $id != '' ? $id : null;
        if($id) {
            $device = $is_admin ? Device::find($id) : Device::where('user_id', $user_id)->where('id', $id)->firstOrFail();
        } else {
            $device = new Device();
            $device->password = Str::random(13);
            $device->user_id = auth()->user()->id;
        }
        $device->serial = $request->input('serial');
        $id ? $device->update() : $device->save();
        return response()->json($device);
    }

    public function delete($id, Request $request) {
        $is_admin = auth()->user()->is_admin;
        $user_id = auth()->user()->id;
        $device = $is_admin ? Device::where('id', $id)->delete() : Device::where('user_id', $user_id)->where('id', $id)->delete();
        return response()->json(['message' => 'deleted']);
    }
}
