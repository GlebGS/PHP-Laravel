<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use App\Services\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$validator) {
            return redirect(route('register'))
                ->with('error', 'Этот эл. адрес уже занят другим пользователем.');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        User::register($data);

        $id = ServiceController::lastId('users');
        UserData::register($id);

        return redirect(route('login'))
            ->with('success', 'Регистрация успешна');
    }

    public function login(Request $request)
    {
        $formField = $request->only(['email', 'password']);
        $id = User::findUser($formField)->id;

        if (Auth::attempt($formField)) {
            return redirect()->intended("/user/id=$id");
        }

        if (!Auth::attempt($formField)) {
            return redirect(route('login'))
                ->with('error', 'Неправильно введёные данные!');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        User::updateUserData($data, $id);

        return back()
            ->with('success', 'Данные успешно изменён!');
    }

    public function security(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->new_password),
        ];

        $id = $request->id;
        $user = User::findUserOnID($id);

        if (User::changePassword($request->password, $user->password)) {
            User::updateUser('users', $data, $id);

            return back()
                ->with('success', 'Данные успешно изменён!');
        }

        return back()
            ->with('error', 'Не верно введёный пароль!');
    }
}
