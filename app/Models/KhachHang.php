<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model {
    protected $table = 'khachhang';
    protected $filltable = [
        "Email",
        "MatKhau",
        "Ho",
        "Ten",
        "SoDienThoai",
        "DiaChi",
        "AnhCaNhan",
    ];

    public static function getAll() {
        return KhachHang::all();
    }
    public static function getUser ($email){
        return KhachHang::select(
            "Email",
            "Ho",
            "Ten",
            "SoDienThoai",
            "DiaChi",
            "AnhCaNhan",
            "created_at"
        )->where("Email", "=", $email)->get();
    }
    public static function getNew () {
        return  KhachHang::orderby('created_at', 'desc')->take(5)->get();
    }
    public static function countCustomer () {
        return KhachHang::select()->count();
    }
    public static function addUser ( array $data = [] ) {
        KhachHang::insert([
            "Email" => $data['email'],
            "MatKhau" => $data['password'],
            "Ho" => $data['lastName'],
            "Ten" => $data['firstName'],
            "SoDienThoai" => $data['phone'],
            "AnhCaNhan" => $data['picture'],
            "Googleid" => $data['googleid'],
        ]);
    }
    public static function checkLoginUser($email, $pass) {
        $result = KhachHang::select("Email", "MatKhau")->where("Email", "=", $email)->get();
        if ($result->count() > 0) {
            if ($result[0]->MatKhau === $pass) {
                return static::getUser($email);
            } else {
                return "Mật khẩu không chính xác";
            }
        } else {
            return "Email không tồn tại";
        }
    }
    public static function checkLoginGoogle ($userData) {
        $result = KhachHang::select("Email", "GoogleId", "AnhCaNhan")->where("Email", "=", $userData->email)->get();
        if ($result->count() > 0) {
            if ($result[0]->GoogleId !== '') {
                if ($result[0]->GoogleId === $userData->id) {
                    return static::getUser($userData->email);
                } else {
                    return "Đăng nhập lỗi";
                }
            } else {
                KhachHang::where("Email", "=", $userData->email)->update([
                    "Googleid" => $userData->id,
                    "AnhCaNhan" => $userData->picture,
                ]);
                return static::getUser($userData->email);
            }
        } else {
            static::addUser([
                "email" => $userData->email,
                "firstName" => $userData->givenName,
                "lastName" => $userData->familyName,
                "phone" => "",
                "gender" => $userData->gender,
                "password" => "",
                "googleid" => $userData->id,
                "picture" => $userData->picture,
                "fbid" => "",
            ]);
            return static::getUser($userData->email);
        }
    
    }
    public static function addCustomer (array $data = []) {
        KhachHang::insert($data);
    }
    public static function editCustomer ($id, array $data = []) {
        KhachHang::where("email", "=", $id)
            ->update($data);
    }
    public static function deleteCustomer($id, $data = []) {
        KhachHang::where('SP_Ma', '=', $id)->delete();
    }
}
