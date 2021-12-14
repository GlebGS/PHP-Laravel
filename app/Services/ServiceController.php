<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ServiceController
{
    public static function lastId($table){
        return DB::table($table)->orderBy('id', 'DESC')->first()->id;
    }

    public static function insertDataInOneTable($table, $data){
        return DB::table($table)->insert($data);
    }

    public static function findUserByData($table, $data){
        return DB::table($table)->where([
            'email' => $data['email'],
        ])->first();
    }

    public static function findUserById($table, $data){
        return DB::table($table)->where([
            'id' => $data,
        ])->first();
    }

    public static function findUserTwoTables($table, $secondTable, $id){
        return DB::table($table)
            ->join($secondTable, "$table.id", '=', "$secondTable.user_id")
            ->where("$secondTable.user_id", '=', $id)
            ->select("$table.*", "$secondTable.*")
            ->first();
    }

    public static function updateUserDataTwoTables($table, $secondTable, $id, $data){
        return DB::table($table)
            ->join($secondTable, "$table.id", '=', "$secondTable.user_id")
            ->where("$secondTable.user_id", '=', $id)
            ->select("$table.*", "$secondTable.*")
            ->update($data);
    }

    public static function updateUserData($table, $data, $id){
        return DB::table($table)
            ->where("id", '=', $id)
            ->update($data);
    }

    public static function uploadingFile($table, $data, $id)
    {
        return DB::table($table)
            ->where("user_id", '=', $id)
            ->update($data);
    }

    public static function deleteUser($table, $id)
    {
        return DB::table($table)
            ->where('id', '=', $id)
            ->delete();
    }

    public static function createUser($table, $secondTable, $data)
    {

    }


}
