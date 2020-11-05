<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function view($id, Request $request)
    {
        $user = $id != 'create' ? $this->api('GET', 'user/'.$id) : [];
        $form = [
            [ 'name'    =>  'name',     'dom'    =>  'input',   'type' => 'text' ],
            [ 'name'    =>  'email',    'dom'    =>  'input',   'type' => 'email' ],
            [ 'name'    =>  'password', 'dom'    =>  'input',   'type' => 'password', 'options' => [ 'hide' => true ] ],
        ];
        return view('form', ['data' => $user, 'routename' => 'user', 'form' => $form]);
    }

    public function list(Request $request)
    {
        $users = $this->api('GET', 'user');
        $columns = [
            [ 'name'    =>  'name' ],
            [ 'name'    =>  'email' ],
        ];
        return view('list', ['listname' => 'Users', 'routename' => 'user', 'data' => $users['data'], 'columns' => $columns]);
    }

    public function store(Request $request)
    {
        $form = $request->all();
        $user = $this->api('POST', 'user', $form);
        return redirect()->route('user.view', ['id' => $user['id']]);
    }

    public function delete($id, Request $request)
    {
        $this->api('DELETE', 'user/'.$id);
        return redirect()->route('user.list');
    }
}
