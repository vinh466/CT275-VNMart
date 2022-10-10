<?php

namespace App\Controllers;

use App\Models\ChiTietDH;
use App\Models\LoaiSP;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\PhanLoaiSP;

class HomeController extends Controller {
    public $listCategory = null;

    function __construct() {
        Controller::__construct();
        $this->listCategory = LoaiSP::getAll();
    }
    function index () {
        // Call Models
        $products = SanPham::getAll();
        $productType = PhanLoaiSP::getProduct();
        // Call view
        Controller::render(page: 'home.index', data: [
            "productsData" => $products,
            "productsType" => $productType,
            "listData" => $this->listCategory,
        ]);
    }
    function cart($message = '') {
        // Call view
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        $idList = [];
        $cartList = [];
        if (isset($_SESSION['CartList'])) {
            $cartList = ($_SESSION['CartList']);
            foreach ($cartList as $key => $value) {
                array_push($idList, $key);
            }
        }
        // print_r($cartList);
        $products = (SanPham::searchOnID($idList));
        Controller::render(page: 'home.cart', data: [
            "message" => $message,
            "CartList" => $cartList,
            "products" => $products,
            "listData" => $this->listCategory,
        ]);
    }
    function paymentCart () {
        $listCart = $_POST;
        print_r($listCart);
        if (!Controller::isUserLoggedIn()) {
            Controller::redirect('/login');
        } else {
            $_SESSION['message'] = 'Giỏ hàng trống !';
            if (!empty($listCart)) {
                $id = DonHang::addBill(unserialize($_SESSION["user"])->Email);
                ChiTietDH::addDetailBill($id, $listCart);
                unset($_SESSION['CartList']);
                $_SESSION['message'] = 'Đặt hàng thành công !';
            }
            Controller::redirect('/cart');
        }
    }
    function lienhe() {
        // Call view
        Controller::render(page: 'home.lienhe', data: [
            "listData" => $this->listCategory,
        ]);
    }
    function tuyendung () {
        // Call view
        Controller::render(page: 'home.tuyendung', data: [
            "listData" => $this->listCategory,
        ]);
    }
    function removeItemCart() {
        if (isset($_POST['SP_Ma'])) {
            if (isset($_SESSION['CartList'])) {
                unset($_SESSION['CartList'][$_POST['SP_Ma']]);
                Controller::redirect('/cart');
            }
        }
    }
    function addItemCart () {
        if (isset($_POST['SP_Ma'])) {
            if (isset($_SESSION['CartList'])) {
                $data = $_SESSION['CartList'];
            } else {
                $data = [];
            }
            $data[$_POST['SP_Ma']] = $_POST['SoLuong'];
            $_SESSION['CartList'] = $data;
        }
    }

    function searchProcess () {
        $result = ((SanPham::searchProducts($_POST['searchProducts'])));
        Controller::render(page: 'home.search', data: [
            "products" => $result,
            "listData" => $this->listCategory,
        ]);
    }
    function categorySearch() {
        $listID = ((SanPham::searchOnCategory($_POST['DM_Ma'])));
        $listProductID = [];
        foreach ($listID as $key => $value) {
            array_push($listProductID, $value->SP_Ma);
        }
        $listProduct = (SanPham::searchOnID($listProductID));
        Controller::render(page: 'home.search', data: [
            "products" => $listProduct,
            "listData" => $this->listCategory,
        ]);
    }

    function error() {
        Controller::render(
            page: 'home.error',
            data: [
                "listData" => $this->listCategory,
            ]
        );
    }
}


