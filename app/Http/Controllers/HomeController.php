<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $users = User::all();

        $role = Auth::user()->role;
        $id = Auth::id();

        return view('users', [
            'users' => $users,
            'role' => $role,
            'id' => $id,
        ]);
    }

    public function create(){
        $id = Auth::id();

        return view('create', [
            'id' => $id,
        ]);
    }

    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function edit(Request $request){
        $role = Auth::user()->role;
        $id = $request->id;

        $user = User::findUserData($id);


        return view('edit', [
            'user' =>$user,
            'role' => $role,
            'id' => $id,
        ]);
    }

    public function security(Request $request){
        $id = $request->id;
        $user = User::findUserData($id);

        return view('security', [
            'user' => $user,
            'id' => $id,
        ]);
    }

    public function status(Request $request){
        $id = $request->id;
        $user = User::findUserData($id);

        return view('status', [
            'user' => $user,
            'id' => $id,
        ]);
    }

    public function media(Request $request){
        $id = $request->id;
        $user = User::findUserData($id);

        return view('media', [
            'user' => $user,
            'id' => $id,
        ]);
    }
}
