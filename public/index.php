<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AccountController;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\APIController;
use Controllers\ClientController;
use Controllers\SitemapController;
use MVC\Router;

//require_once 'Router.php';
$router = new Router();

$router->get('/firmador', [AdminController::class,'firmador']);
$router->post('/firmador', [AdminController::class,'firmador']);


$router->get('/terms', [ClientController::class,'terms']);

$router->get('/e0ba580ca07a56b26d44e88ee03b1abb', [AdminController::class,'menuPopUp']);
$router->post('/e0ba580ca07a56b26d44e88ee03b1abb', [AdminController::class,'menuPopUp']);

$router->get('/8ae4a90b2a7bc44f4217893f89e28f58', [AdminController::class,'agregarPopUpImg']);
$router->post('/8ae4a90b2a7bc44f4217893f89e28f58', [AdminController::class,'agregarPopUpImg']);
$router->post('/api/95ff27d16e904dccf0d9bc2f961e748d', [APIController::class,'findPopUpImg']);

$router->post('/api/585017aa4ee7d08060322deb77c9d74d', [APIController::class,'deletePopUpImg']);
$router->post('/api/55e926765c284cd9da07aea89bc9f753', [APIController::class,'changeProductState']);


$router->post('/api/ca9cfb11a71112c25d9e5de085a6217b', [APIController::class,'findDiscountCode']);
$router->post('/api/a27647d858aa93c09fc6a365b9054742', [APIController::class,'activarDiscountCode']);



$router->get('/e98d2f001da5678b39482efbdf5770dc', [AdminController::class,'crearPDFreport']);
$router->post('/e98d2f001da5678b39482efbdf5770dc', [AdminController::class,'crearPDFreport']);

$router->get('/sitemap', [SitemapController::class,'index']);


$router->get('/', [ClientController::class,'index']);
$router->get('/products', [ClientController::class,'products']);
$router->get('/rueda', [ClientController::class,'rueda']);
$router->get('/products-male', [ClientController::class,'productsMale']);
$router->get('/products-female', [ClientController::class,'productsFemale']);

$router->get('/products-aurum', [ClientController::class,'productsaurum']);
$router->get('/about', [ClientController::class,'about']);
$router->get('/reviews', [ClientController::class,'reviews']);
$router->get('/contact', [ClientController::class,'contact']);
$router->get('/cart', [ClientController::class,'cart']);


$router->post('/api/lastest-products',[APIController::class,'lastestProducts']);
$router->post('/api/find-product',[APIController::class,'findProduct']);
$router->post('/api/find-products',[APIController::class,'findproducts']);
$router->post('/api/find-products-words',[APIController::class,'findProductsWords']);
$router->post('/api/delete-product', [APIController::class,'deleteProduct']);
$router->get('/api/delete-product', [APIController::class,'deleteProduct']);

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




//recovery pass
$router->get('/forgot', [LoginController::class,'forgot']);
$router->post('/forgot', [LoginController::class,'forgot']);
$router->get('/recover', [LoginController::class,'recover']);
$router->post('/recover', [LoginController::class,'recover']);


//productos
$router->get('/286e18ee6617beaf7cfd0cb74b4b7824', [AdminController::class,'showProductIndex']);
$router->get('/75dec04d6b22b103f3626021ed748de9', [AdminController::class,'agregarProducto']);
$router->post('/75dec04d6b22b103f3626021ed748de9', [AdminController::class,'agregarProducto']);

$router->get('/d94a5da526ad85f8e50ca84d4be1defd', [AdminController::class,'editarProducto']);
$router->post('/d94a5da526ad85f8e50ca84d4be1defd', [AdminController::class,'editarProducto']);

//sing up
$router->get('/1ebd87f94f5b252983dc86d628d17e7a', [LoginController::class,'singup']);
$router->post('/1ebd87f94f5b252983dc86d628d17e7a', [LoginController::class,'singup']);
$router->get('/21232f297a57a5a743894a0e4a801fc7', [AdminController::class,'index']);
$router->get('/21232f297a57a5a743894a0e4a801fc3', [AdminController::class,'menuSeleccionar']);


$router->get('/2dae35a48d8dd4a168abb48b8ff3b209', [AdminController::class,'mostrarSuscriptores']);

$router->get('/1b64884ff1c612eaca3a0ece9a609116', [AdminController::class,'mostrarCategorias']);
$router->post('/1b64884ff1c612eaca3a0ece9a609116', [AdminController::class,'mostrarCategorias']);
$router->post('/api/delete-category', [APIController::class,'deleteCategory']);

$router->get('/054d19a00589bfb69c334a7e27a734b3', [AdminController::class,'mostrarCategoriasA']);
$router->post('/054d19a00589bfb69c334a7e27a734b3', [AdminController::class,'mostrarCategoriasA']);
$router->post('/api/delete-category-a', [APIController::class,'deleteCategoryA']);

$router->get('/2885991af6301511c3ec390fec3fbceb', [AdminController::class,'showEmployeeTime']);
$router->post('/api/af4c266f3541aeb7d02f306d50a05f0e', [APIController::class,'deleteEmployee']);
$router->post('/api/b1d9310c2b7d91c2fcb59a30582dc00d', [APIController::class,'borrarRegistro']);
$router->get('/78e731027d8fd50ed642340b7c9a63b3', [LoginController::class,'message']);

$router->get('/4584073e4643fe782c06f2955569a966', [AdminController::class,'editDateEmployee']);
$router->post('/4584073e4643fe782c06f2955569a966', [AdminController::class,'editDateEmployee']);


$router->get('/b6f3f62dfe05b410e3f7f72e0d5db63a', [AdminController::class,'editEmployee']);
$router->post('/b6f3f62dfe05b410e3f7f72e0d5db63a', [AdminController::class,'editEmployee']);

$router->get('/confirm', [LoginController::class,'confirm']);



$router->post('/api/new-suscribe', [APIController::class,'addNewSuscribe']);
$router->post('/api/delete-suscribe', [APIController::class,'deleteSuscriptor']);
//$router->get('/date', [DateController::class,'index']);



//service crud



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->checkRoutes();