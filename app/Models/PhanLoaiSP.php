<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanLoaiSP extends Model
{
    protected $table = 'phanloai_sp';
    // protected $primaryKey = 'SP_Ma';
    protected $filltable = [
        "SP_Ma"	,
        "DM_Ma"	
    ];
    public $timestamps = false;

    public static function getAll() {
        return PhanLoaiSP::all();
    }
    public static function getCategory() {
        return
            PhanLoaiSP::select('phanloai_sp.SP_Ma', 'phanloai_sp.DM_Ma', 'loai_sp.Ten')
            ->join('loai_sp', 'phanloai_sp.DM_Ma', '=', 'loai_sp.DM_Ma')
            ->get()
            ->groupBy('SP_Ma');
    }
    public static function getProduct(){
        return
            PhanLoaiSP::select('phanloai_sp.SP_Ma', 'phanloai_sp.DM_Ma', 'sanpham.*')
            ->join('sanpham', 'phanloai_sp.SP_Ma', '=', 'sanpham.SP_Ma')
            ->get()
            ->groupBy('DM_Ma');
    }
    public static function addCategoryProduct($SP_Ma, $data) {
        PhanLoaiSP::where('SP_Ma', '=', $SP_Ma)->delete();
        foreach ($data as $key => $value) {
            PhanLoaiSP::insert(['SP_Ma' => $SP_Ma, 'DM_Ma' => $value]);
        }
    }
}
