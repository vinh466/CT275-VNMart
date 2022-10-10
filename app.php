<?php
//Khoi dong SESSION
if (session_id() === '') session_start();
define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);
require_once ROOTDIR . "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

// Load ENV file
$dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
$dotenv->load();

//Database connect
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'port'      => $_ENV['DB_PORT'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USER'],
    'password'  => $_ENV['DB_PASS'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

require_once ROOTDIR . "app/route.php";
