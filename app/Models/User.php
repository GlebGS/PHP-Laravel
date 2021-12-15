<?php

namespace App\Models;

use App\Services\ServiceController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract
{

    use Authenticatable;
    use HasFactory;

    public function userData()
    {
        return $this->hasMany(UserData::class);
    }

    public static function register($table, $data)
    {
        return ServiceController::insertDataInOneTable($table, $data);
    }

    public static function findUser($data)
    {
        return ServiceController::findUserByData('users', $data);
    }

    public static function findUserOnID($data)
    {
        return ServiceController::findUserById('users', $data);
    }

    public static function findUserData($id){
        return ServiceController::findUserTwoTables('users', 'user_data', $id);
    }

    public static function updateUserData($data, $id){
        return ServiceController::updateUserDataTwoTables('users', 'user_data', $id, $data);
    }

    public static function changePassword($newPassword, $oldPassword){
        return Hash::check($newPassword, $oldPassword);
    }

    public static function updateUser($table, $data, $id){
        return ServiceController::updateUserData($table, $data, $id);
    }

    public static function file($table, $data, $id){
        return ServiceController::uploadingFile($table, $data, $id);
    }

    public static function deleteUser($id){
        return ServiceController::deleteUser('users', $id);
    }
}
