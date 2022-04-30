<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanTriVien extends Model {
    protected $table = 'quantrivien';
    protected $filltable = [
        "TaiKhoan",
        "MatKhau"
    ];


    public static function getAll() {
        return QuanTriVien::all();
    }

    public static function checkLoginAdmin ($account, $pass) {
        $result = QuanTriVien::select("TaiKhoan", "MatKhau")->where("TaiKhoan", "=", $account)->get();
        if ($result->count() > 0) {
            if ($result[0]->MatKhau === $pass) {
                return QuanTriVien::select(
                    "TaiKhoan",
                    "MatKhau",
                )->where("TaiKhoan", "=", $account)->get();
            } else {
                return "Mật khẩu không chính xác";
            }
        } else {
            return "Tài khoản không tồn tại";
        }
    }
}
