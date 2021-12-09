<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        $user = User::all();

        $role = Auth::user()->role;
        $id = Auth::id();

        return view('users', [
            'users' => $user,
            'role' => $role,
            'id' => $id,
        ]);
    }

    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }
}
