<?php

namespace App\Controllers;

use App\Models\DB;
use App\Models\LoaiSP;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\KhachHang;
use App\Models\PhanLoaiSP;

class AdminController extends Controller {
    function __construct() {
        Controller::__construct();
        if (!isset($_SESSION['admin'])) {
            Controller::redirect('/admin/login');
        }
    }
    function index() {
        Controller::render(page: 'admin.index', data: [
            "title" => "Admin",
            "countCustomer" => DB::funcCall('tongkh'),
            "countOrder" => DB::funcCall('tongdh'),
            "countProduct" => DB::funcCall('tongsp'),
            "outStockProduct" => DB::funcCall('tonghethang'),
        ]);
    }
    function customer() {
        Controller::render(page: 'admin.customer', data: [
            "title" => "Khách hàng",
        ]);
    }
    function product() {
        Controller::render(page: 'admin.product', data: [
            "title" => "Sản phẩm",
            "category" => LoaiSP::getAll(),
        ]);
    }
    function orders() {
        Controller::render(page: 'admin.orders', data: [
            "title" => "Đơn hàng"
        ]);
    }
    function error () {
        Controller::render(page: 'admin.error', data: [
            "title" => "Lỗi"]
        );
    }
    function addProduct () {
        if (isset($_POST['addSubmit'])) {
            $id = SanPham::addProduct([
                "Ten" => $_POST['Ten'],
                "MoTa" => $_POST['MoTa'],
                "SoLuong" => $_POST['SoLuong'],
                "DonGia" => $_POST['DonGia'],
                "GiamGia" => $_POST['GiamGia'],
                "DonVi" => $_POST['DonVi'],
                "Anh" => $_POST['Anh'],
                "TrangThai" => $_POST['TrangThai'],
                "created_at" => "CURRENT_TIMESTAMP",
            ]);
            PhanLoaiSP::addCategoryProduct($id, $_POST['DM_Ma']);
        }
        Controller::redirect("./");
    }
    function editProduct() {
        if (isset($_POST['editSubmit'])) {
            SanPham::editProduct(
                $_POST['SP_Ma'], 
                [
                    "Anh" => $_POST['Anh'],
                    "DonGia" => $_POST['DonGia'],
                    "DonVi" => $_POST['DonVi'],
                    "GiamGia" => $_POST['GiamGia'],
                    "MoTa" => $_POST['MoTa'],
                    "SoLuong" => $_POST['SoLuong'],
                    "Ten" => $_POST['Ten'],
                    "TrangThai" => $_POST['TrangThai'],
                ]
            );
            PhanLoaiSP::addCategoryProduct($_POST['SP_Ma'], $_POST['DM_Ma']);
        }
        Controller::redirect("./");
    }
    function deleteProduct() {
        if (isset($_POST['deleteSubmit'])) {
            // print_r($_POST['SP_Ma']);
            SanPham::deleteProduct($_POST['SP_Ma']);
        }
        Controller::redirect("./");
    }
    function addCustomer() {
        if (isset($_POST['addSubmit'])) {
            KhachHang::addCustomer([
                "Email" => $_POST['Email'],
                "MatKhau" => $_POST['MatKhau'],
                "Ho" => $_POST['Ho'],
                "Ten" => $_POST['Ten'],
                "SoDienThoai" => $_POST['SoDienThoai'],
                "DiaChi" => $_POST['DiaChi'],
                "AnhCaNhan" => $_POST['AnhCaNhan'],
            ]);
        }
        Controller::redirect("./");
    }
    function editCustomer() {
        if (isset($_POST['editSubmit'])) {
            KhachHang::editCustomer(
                $_POST['Email'],
                [
                    "MatKhau" => $_POST['MatKhau'],
                    "Ho" => $_POST['Ho'],
                    "Ten" => $_POST['Ten'],
                    "SoDienThoai" => $_POST['SoDienThoai'],
                    "DiaChi" => $_POST['DiaChi'],
                    "AnhCaNhan" => $_POST['AnhCaNhan'],
                ]
            );
        }

        Controller::redirect("./");
    }
    function deleteCustomer() {
        if (isset($_POST['deleteSubmit'])) {
            KhachHang::deleteCustomer($_POST['Email']);
        }
        Controller::redirect("./");
    }
}
