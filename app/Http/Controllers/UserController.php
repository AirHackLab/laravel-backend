<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $users = User::paginate(15);
        return response()->json($users);
    }

    public function view($id, Request $request) {
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request) {
        $id = $request->input('id', null);
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
        $user->save();
        return response()->json($user);
    }

    public function delete($id, Request $request) {
        $user = User::where('id', $id)->delete();
        return response()->json(['message' => 'deleted']);
    }
}
