<?php
use Bramus\Router\Router;
use App\Controllers\Controller;

$route = new Router();
$route->setNamespace('\App\Controllers');
//Route:

//Home
$route->get('/', function () { header('location: /Home'); });
$route->get('/[Hh]ome', 'HomeController@index');

$route->post('/[Hh]ome/search', 'HomeController@searchProcess');
$route->post('/[Hh]ome/category', 'HomeController@categorySearch');

//Cart
$route->get('/[Cc]art', 'HomeController@cart');
$route->post('/[Cc]art/add-item', 'HomeController@addItemCart');
$route->post('/[Cc]art/payment', 'HomeController@paymentCart');

//Recruitment
$route->get('/lienhe', 'HomeController@lienhe');

$route->get('/tuyendung', 'HomeController@tuyendung');
// Error home
$route->get('/[Hh]ome/{[^/]+}', 'HomeController@error');

// /Admin/
$route->mount('/[Aa]dmin', function () use ($route) {
    $route->get('/', 'AdminController@index');
    $route->get('/dashboard', 'AdminController@index');
    // /Admin/customer/
    $route->mount('/customer', function () use ($route) {
        $route->get('/', 'AdminController@customer');
        $route->post('/edit', 'AdminController@editCustomer');
        $route->get('/add', 'AdminController@addCustomer');
        $route->get('/delete', 'AdminController@deleteCustomer');
    });
    // /Admin/product/
    $route->mount('/product', function () use ($route) {
        $route->get('/', 'AdminController@product');
        $route->post('/edit', 'AdminController@editProduct');
        $route->post('/add', 'AdminController@addProduct');
        $route->post('/delete', 'AdminController@deleteProduct');
    });
    // /Admin/orders/
    $route->mount('/orders', function () use ($route) {
        $route->get('/', 'AdminController@orders');
        $route->post('/edit', 'AdminController@editOrders');
        $route->post('/add', 'AdminController@addOrders');
        $route->post('/delete', 'AdAdminController@deleteOrders');
    });
    $route->get('/login', 'LoginController@loginAdmin');
    $route->get('/{[^/]+}', 'AdminController@error');
});

//Account
$route->get('/[Ll]ogin', 'LoginController@login');


$route->post('/[Ll]ogin/google', 'LoginController@loginWithGoogle');
$route->get('/[Ll]ogin/google', 'LoginController@loginWithGoogleProcess');


$route->get('/[Rr]egister', 'LoginController@register');
$route->get('/[Ff]orgot-password', 'LoginController@forgotPassword');
$route->get('/logout', 'LoginController@logoutProcess');
$route->post('/login', 'LoginController@loginProcess');
$route->post('/admin/login', 'LoginController@loginAdminProcess');
$route->post('/register', 'LoginController@registerProcess');

//API
$route->post('/api/get-customers', 'ApiController@getCustomers');
$route->post('/api/get-products', 'ApiController@getProducts');
$route->post('/api/get-new-customer', 'ApiController@getNewCustomer');
$route->post('/api/get-new-order', 'ApiController@getNewOrder');

//404
$route->set404(function () {
    (new Controller)->render(page: '404Page', data: [
        "title" => "Home"
    ]);
});
$route->run(); 