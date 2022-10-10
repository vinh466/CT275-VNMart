<?php

namespace App\Models;
use App\Models\LoaiSP;
use App\Models\PhanLoaiSP;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model {
    protected $table = 'sanpham';
    protected $primaryKey = 'SP_Ma';
    protected $filltable = [
        "SP_Ma",
        "Ten"	,
        "MoTa",
        "SoLuong",
        "DonGia",
        "GiamGia",
        "DonVi",
        "Anh",
        "TrangThai",
    ];


    public static function getAll () {
        return SanPham::all();
    }

    public static function getNew() {
        return  SanPham::orderby('created_at', 'desc')->take(5)->get();
    }
    public static function countProduct() {
        return SanPham::select()->count();
    }
    public static function outStockProduct () {
        return SanPham::select("*")->where("SoLuong","<", "10")->count();
    }
    public static function getCategory() {
        return
            SanPham::select('sanpham.SP_Ma', 'phanloai_sp.DM_Ma')
            ->join('phanloai_sp', 'sanpham.SP_Ma', '=', 'phanloai_sp.SP_Ma')
            // ->where('sanpham.SP_Ma', '=', 51)
            ->get()
            ->groupBy('SP_Ma');;
    }
    public static function addProduct (array $data = []) {
        return SanPham::insertGetId($data);
    }
    public static function editProduct($id, array $data = []) {
        SanPham::where("SP_Ma","=", $id)
            ->update($data);
    }
    public static function deleteProduct($id, $data = []) {
        PhanLoaiSP::where('SP_Ma', '=', $id)->delete();
        ChiTietDH::where('SP_Ma', '=', $id)->delete();
        SanPham::where('SP_Ma', '=', $id)->delete();
    }
    public function phanLoaiSP() {
        return $this->belongsTo(PhanLoaiSP::class, 'phanloai_sp', 'SP_Ma');
    }

    public static function searchProducts ($input) {
        return (SanPham::where('Ten', 'like', '%'.$input.'%')->get());
    }
    public static function searchOnCategory ($input) {
        return (PhanLoaiSP::where('DM_Ma', '=', $input)->get());
    }
    public static function searchOnID ($input) {
        return (SanPham::select()->whereIn('SP_Ma', $input)->get());
    }
}