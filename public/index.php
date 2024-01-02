<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AccountController;
use Controllers\AdminController;
use Controllers\DateController;
use Controllers\LoginController;
use Controllers\APIController;
use Controllers\ClientController;
use Controllers\ServiceController;
use Controllers\APIAdminController;
use MVC\Router;
//require_once 'Router.php';
$router = new Router();

$router->get('/', [LoginController::class,'login']);


$router->get('/account', [AccountController::class,'index']);
$router->post('/account', [AccountController::class,'index']);


$router->get('/edit-account', [AccountController::class,'edit']);
$router->post('/edit-account', [AccountController::class,'edit']);
//log in and log out
$router->get('/login', [LoginController::class,'login']);
$router->post('/login', [LoginController::class,'login']);


$router->get('/4236a440a662cc8253d7536e5aa17942', [LoginController::class,'logout']);



//crea token para cambiar contraseña de manera segura
$router->get('/api/createtoken',[APIController::class,'createtoken']);
$router->post('/api/createtoken',[APIController::class,'createtoken']);






$router->post('/api/services', [APIController::class,'findMyServices']);
$router->post('/api/services/find', [APIController::class,'findServices']);
$router->get('/api/services/find', [APIController::class,'findServices']);
$router->post('/api/services/pictures', [APIController::class,'findMyPictures']);
$router->post('/api/services/tags', [APIController::class,'findMyTags']);
$router->get('/api/services/all', [APIController::class,'findAllServices']);


$router->post('/api/services/delete', [APIController::class,'deleteService']);





$router->post('/api/locations', [APIController::class,'getlocations']);
//recovery pass
$router->get('/forgot', [LoginController::class,'forgot']);
$router->post('/forgot', [LoginController::class,'forgot']);
$router->get('/recover', [LoginController::class,'recover']);
$router->post('/recover', [LoginController::class,'recover']);

//sing up
$router->get('/1ebd87f94f5b252983dc86d628d17e7a', [LoginController::class,'singup']);
$router->post('/1ebd87f94f5b252983dc86d628d17e7a', [LoginController::class,'singup']);
$router->get('/21232f297a57a5a743894a0e4a801fc3', [AdminController::class,'index']);
$router->get('/2885991af6301511c3ec390fec3fbceb', [AdminController::class,'showEmployeeTime']);
$router->post('/api/af4c266f3541aeb7d02f306d50a05f0e', [APIController::class,'deleteEmployee']);
$router->post('/api/b1d9310c2b7d91c2fcb59a30582dc00d', [APIController::class,'borrarRegistro']);
$router->get('/78e731027d8fd50ed642340b7c9a63b3', [LoginController::class,'message']);

$router->get('/4584073e4643fe782c06f2955569a966', [AdminController::class,'editDateEmployee']);
$router->post('/4584073e4643fe782c06f2955569a966', [AdminController::class,'editDateEmployee']);


$router->get('/b6f3f62dfe05b410e3f7f72e0d5db63a', [AdminController::class,'editEmployee']);
$router->post('/b6f3f62dfe05b410e3f7f72e0d5db63a', [AdminController::class,'editEmployee']);

$router->get('/confirm', [LoginController::class,'confirm']);


//admin section
$router->get('/api/services', [APIController::class,'index']);

//$router->get('/date', [DateController::class,'index']);


$router->get('/api/admin/services', [APIAdminController::class,'index']);
$router->post('/api/admin/services', [APIAdminController::class,'index']);
$router->post('/api/admin/services/confirm', [APIAdminController::class,'confirmService']);
$router->get('/api/admin/services/confirm', [APIAdminController::class,'confirmService']);



//service crud



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->checkRoutes();