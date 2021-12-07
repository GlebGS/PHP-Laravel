<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
}
