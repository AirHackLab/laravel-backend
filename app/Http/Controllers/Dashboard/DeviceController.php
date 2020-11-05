<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function view($id, Request $request)
    {
        $device = is_int($id) ? $this->api('GET', 'device/'+$id) : [];
        $forms = [
            [ 'name'    =>  'serial',   'method'    =>  'input-text' ],
            [ 'name'    =>  'password', 'method'    =>  'input-text',       'options'   =>  [ 'disabled' => true ] ],
        ];
        return view('form', ['data' => $device, 'form' => $forms]);
    }

    public function list(Request $request)
    {
        $devices = $this->api('GET', 'device');
        $columns = [
            [ 'name'    =>  'serial' ],
        ];
        return view('list', ['data' => $devices, 'columns' => $columns]);
    }

    public function store(Request $request)
    {
        $form = $request->all();
        $device = $this->api('POST', 'device', $form);
        return redirect()->route('device.view', ['id' => $device->id]);
    }

    public function delete($id, Request $request)
    {
        $this->api('DELETE', 'device/'+$id);
        return redirect()->route('device.list');
    }
}