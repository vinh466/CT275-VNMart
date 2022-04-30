<?php

namespace App\Controllers;

use Google\Client;
use Google\Service\Oauth2;
use App\Models\KhachHang;
use App\Models\QuanTriVien;

class LoginController extends Controller {
    function __construct() {
        Controller::__construct();
    }
    // Hiển thị trang login
    function login(array $data = []) {
        $data["title"]= "Đăng nhập";
        Controller::render(page: 'login.login', data: $data);
    }
    // Hiển thị trang login admin
    function loginAdmin ($data = []) {
        $data["title"]= "Đăng nhập QTV";
        Controller::render(page: 'login.loginAdmin', data: $data);
    }
    // Hiển thị trang đăng ký
    function register (){
        Controller::render(page: 'login.register', data: []);
    }
    // Hiển thị trang quên mật khẩu
    function forgotPassword() {
        Controller::render(page: 'login.forgot', data: []);
    }
    // Xử lý đăng xuất
    function logoutProcess () {
        Controller::logout();
        Controller::redirect("/login");
    }
    // Xử lý đăng ký tại khoản khách hàng
    function registerProcess () {
        if(isset($_POST['submitRegister'])) {
            KhachHang::addUser([
                "email" => $_POST['emailRegister'],
                "firstName" => $_POST['firstNameRegister'],
                "lastName" => $_POST['lastNameRegister'],
                "phone" => $_POST['phoneRegister'],
                "gender" => $_POST['genderRegister'],
                "password" => $_POST['passwordRegister'],
                "picture" => "",
                "googleid" => "",
                "fbid" => "",
            ]);
        } else {
            echo "@@@@@@@";
        }
        Controller::redirect("/login");
    }
    // Xử lý đăng nhập khách hàng
    function loginProcess () {
        if (isset($_POST['submitLogin'])) {
            $result = KhachHang::checkLoginUser($_POST['emailLogin'], $_POST['passwordLogin']);
            if (is_object($result)) {
                $_SESSION["user"] = serialize($result[0]);
                Controller::redirect("/home");
            } else {
                $this->login(["ErrorLogin" => $result]);
            }
        } else {
            Controller::redirect("/");
        }
    }

    function clientGoogle () {
        $client = new Client();
        $client->setAuthConfig('../client_google.json');
        $client->addScope("email");
        $client->addScope("profile");
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/login/google');
        $client->setAccessType('offline');        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        return $client;
    }

    function loginWithGoogle () {
        $client = $this->clientGoogle();

        if (!isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/login/google';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }

    function loginWithGoogleProcess () {
        $client = $this->clientGoogle();
        
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $objOAuthService = new Oauth2($client);
            $client->setAccessToken($_SESSION['access_token']);
            $userData = $objOAuthService->userinfo->get();

            $result = Khachhang::checkLoginGoogle($userData);
            
            if (is_object($result)) {
                $_SESSION["user"] = serialize($result[0]);
                Controller::redirect("/home");
            } else {
                $this->login(["ErrorLogin" => $result]);
            }
            
        } else {
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/login';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }

    // Xử lý đăng nhập quản trị viên
    function loginAdminProcess () {
        if (isset($_POST['submitLoginAdmin'])) {
            $result = QuanTriVien::checkLoginAdmin($_POST['accountLogin'], $_POST['passwordLogin']);
            if (is_object($result)) {
                $_SESSION["admin"] = serialize($result[0]);
                Controller::redirect("/admin");
            } else {
                $this->loginAdmin(["ErrorLogin" => $result]);
            }
        } else {
            Controller::redirect("/");
        }
    }
}