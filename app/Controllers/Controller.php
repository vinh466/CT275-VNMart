<?php

namespace App\Controllers;

use App\Models\KhachHang;
use App\Models\QuanTriVien;
use Jenssegers\Blade\Blade;

use function Opis\Closure\unserialize;

class Controller {
    protected $viewBlade;
    private $viewDir  = ROOTDIR . 'resources/views/';
    private $cacheDir = ROOTDIR . 'resources/cache/';

    public static $currentUser;
    public static $currentAdmin;

    public function __construct() {
        $this->viewBlade = new Blade($this->viewDir, $this->cacheDir );

        $this->viewBlade->directive('vnd', function ($amount) {
            if (!empty($amount)) {
                return "<?php echo number_format($amount) . ' đ'; ?>";
            }
        });

        static::user();
    }
    // Hiển thị View
    public function render($page, array $data = []) {
        exit ($this->viewBlade->render($page, $data));
    }
    // Chuyển hướng đến một trang khác
    function redirect($location, array $data = []) {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
        header('Location: ' . $location);
        exit();
    }
    // Đọc và xóa một biến trong $_SESSION
    function session_get_once($name, $default = null) {
        $value = $default;
        if (isset($_SESSION[$name])) {
            $value = $_SESSION[$name];
            unset($_SESSION[$name]);
        }
        return $value;
    }
    // Kiểm tra người dùng hiện tại
    public static function user () {
        if (!static::$currentUser && static::isUserLoggedIn()) {
            try {
                static::$currentUser = ((KhachHang::where('Email', '=', unserialize($_SESSION["user"])->Email)->get())[0]);
            } catch (\Throwable $th) {
                static::$currentUser = null;
            }
        }
        if (!static::$currentAdmin && static::isAdminLoggedIn()) {
            try {
                static::$currentAdmin = ((QuanTriVien::where('TaiKhoan', '=', unserialize($_SESSION["admin"])->TaiKhoan)->get())[0]);
            } catch (\Throwable $th) {
                static::$currentAdmin = null;
            }
        }
    }
    // Đăng xuất
    public static function logout() {
        session_unset();
        session_destroy();
    }
    // Kiểm tra khách hàng có đăng nhập
    public static function isUserLoggedIn() {
        return isset($_SESSION['user']);
    }
    // Kiểm tra quản trị viên có đăng nhập
    public static function isAdminLoggedIn() {
        return isset($_SESSION['admin']);
    }
}