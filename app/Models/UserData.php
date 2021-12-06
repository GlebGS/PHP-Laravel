<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserData extends Model
{
    use HasFactory;

  public static function register ($data)
  {
      DB::table('user_data')->insert($data);
  }
}
