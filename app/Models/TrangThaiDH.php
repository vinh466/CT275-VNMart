<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrangThaiDH extends Model {
    protected $table = 'trangthai_dh';
    protected $filltable = [
        "TTDH_Ma",
        "Ten",
        "MoTa"
    ];
    public $timestamps = true;

    public static function getAll() {
        return TrangThaiDH::all();
    }
}
