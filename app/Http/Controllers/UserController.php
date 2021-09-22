<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $is_admin = auth()->user()->is_admin;
        if(!$is_admin) abort(403);
        $users = User::paginate(15);
        return response()->json($users);
    }

    public function view($id, Request $request) {
        $is_admin = auth()->user()->is_admin;
        if(!$is_admin) abort(403);
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request) {
        $is_admin = auth()->user()->is_admin;
        if(!$is_admin) abort(403);
        $id = $request->input('id', null);
        $id = $id != '' ? $id : null;
        if($id) {
            $user = User::find($id);
        } else {
            $user = new User();
            $user->api_token = Str::random(60);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if($password = $request->input('password', null)) {
            $user->password = Hash::make($password);
        }
        $id ? $user->update() : $user->save();
        return response()->json($user);
    }

    public function delete($id, Request $request) {
        $is_admin = auth()->user()->is_admin;
        if(!$is_admin) abort(403);
        $user = User::where('id', $id)->delete();
        return response()->json(['message' => 'deleted']);
    }
}
