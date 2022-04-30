<?php

namespace App\Controllers;
use App\Models\SanPham;
use App\Models\KhachHang;
use App\Models\PhanLoaiSP;

class ApiController {

    function getCustomers () {
        echo json_encode(KhachHang::getAll(), JSON_UNESCAPED_UNICODE);
    }
    function getProducts () {
        // echo json_encode(SanPham::getAll(), JSON_UNESCAPED_UNICODE);
        $products = SanPham::getAll();
        $category = PhanLoaiSP::getCategory();

        foreach ($products as $key => $product) {
            if (isset($category[$product->SP_Ma])) {
                $products[$key]['category'] =  ($category[$product->SP_Ma]);
            } else $products[$key]['category'] = [];
        }
        echo json_encode($products, JSON_UNESCAPED_UNICODE);
    }
    function getNewCustomer () {
        echo json_encode(KhachHang::getNew(), JSON_UNESCAPED_UNICODE);
    }
}
