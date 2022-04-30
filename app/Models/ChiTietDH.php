<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDH extends Model
{
    protected $table = 'chitiet_dh';
    protected $filltable = [
        "DH_Ma",
        "SP_Ma",
        "SoLuong",
    ];

    public static function getAll() {
        return ChiTietDH::all();
    }
    public static function addDetailBill($id, $data = []) {
        foreach ($data as $key => $value) {
            ChiTietDH::insert([
                "DH_Ma" => $id,
                "SP_Ma" => $key,
                "SoLuong" => $value,
            ]);
        }
    }
}
