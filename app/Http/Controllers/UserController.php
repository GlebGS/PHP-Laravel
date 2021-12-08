<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable;

class UserController extends Controller
{
    public function register(Request $request){

        $validator = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$validator){
            return redirect(route('register'))
                ->with('error', 'Этот эл. адрес уже занят другим пользователем.');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];


        User::register($data);

        $id = DB::table('users')->orderBy('id', 'DESC')->first()->id;
        UserData::register($id);

        return redirect(route('login'))
            ->with('success', 'Регистрация успешна');
    }

    public function login(Request $request){
        $formField = $request->only(['email', 'password']);

        if (Auth::attempt($formField)){
            return redirect()->intended(route('main'));
        }

        if (!Auth::attempt($formField)){
            return redirect(route('login'))
                ->with('error', 'Неправильно введёные данные!');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
