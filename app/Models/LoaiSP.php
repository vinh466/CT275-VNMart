<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiSP extends Model
{
    protected $table = 'loai_sp';
    // protected $primaryKey = 'DM_Ma';
    protected $filltable = [
        "DM_Ma",	
        "Ten",	
        "MoTa"
    ];
    public $timestamps = true;

    public static function getAll() {
        return LoaiSP::all();
    }
    
}
