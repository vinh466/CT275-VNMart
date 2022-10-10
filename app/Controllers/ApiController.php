<?php

namespace App\Controllers;
use App\Models\DB;
use App\Models\LoaiSP;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\KhachHang;
use App\Models\PhanLoaiSP;
use App\Models\TrangThaiDH;

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
    function getHotCustomers() {
        $customers = DB::procCall('thongkedonhang');
        echo json_encode($customers, JSON_UNESCAPED_UNICODE);
    }
    function getHotProduct() {
        $prducts = DB::procCall('thongkebanchay');
        echo json_encode($prducts, JSON_UNESCAPED_UNICODE);
    }
    function getOrders () {
        $orders = DonHang::getAll();
        $statuses  = TrangThaiDH::getAll();
        foreach ($orders as $key => $order) {
            foreach ($statuses as $status) {
                if ($order->TTDH_Ma == (string)($status->TTDH_Ma)) {
                    $orders[$key]['TTDH_Ma'] = $status;
                }
            }
        }
        echo json_encode($orders, JSON_UNESCAPED_UNICODE);
    }
}
