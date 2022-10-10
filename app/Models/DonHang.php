<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model {
    protected $table = 'donhang';
    protected $filltable = [
        "DH_Ma",
        "Email",
        "NgayNhanHang",
        "DiaChiNhan",
        "TTDH_Ma",
    ];
    public static function getAll() {
        return DonHang::orderBy('created_at', 'DESC')->get();
    }
    public static function addBill($email) {
        return DonHang::insertGetId([
            "Email" => $email,
            "TTDH_Ma" => '1',
        ]);
    }
    public static function countOrder () {
        return DonHang::select()->count();
    }
}