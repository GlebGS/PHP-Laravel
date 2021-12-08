<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{

    use Authenticatable;
    use HasFactory;

    public static function register($data)
    {
        DB::table('users')->insert($data);
    }

    public static function findUser($data)
    {
        return DB::table('users')->where([
            'email' => $data['email'],
        ])->first();
    }
}
