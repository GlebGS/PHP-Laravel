<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use App\Services\ServiceController;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:12',
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

        User::register('users', $data);

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

        return redirect(route('login'))
            ->with('error', 'Неправильно введёные данные!');
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
            'new_password' => 'required|string|min:6|max:12',
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

    public function status(Request $request)
    {
        $data = [
          'status' => $request->option
        ];

        $id = $request->id;

        User::updateUserData($data, $id);

        return back()
            ->with('success', 'Статус успешно изменён!');
    }

    public function media(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);


        $file = $request->file('file');
        $directory = 'img/demo/avatars';
        $extension = $request->file('file')->getClientOriginalName();

        $data = [
            'img' => '/' . $directory . '/' . $extension,
        ];

        if ($file->move($directory, $extension)){
            User::file('user_data', $data, $id);
        }

        return back()->with('success', 'Изображение было успешно изменено!');
    }

    public function delete(Request $request){
        $id = $request->id;
        User::deleteUser($id);

        return back();
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:12',
        ]);

        $dataInOneTable = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        ServiceController::insertDataInOneTable('users', $dataInOneTable);

        $dataInSecondTable = [
            'user_id' => ServiceController::lastId('users'),
            'position' => $request->position,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ];

        ServiceController::insertDataInOneTable('user_data', $dataInSecondTable);

        return back()
            ->with('success', 'Пользователь был успешно добавлен!');
    }
}
