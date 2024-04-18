<?php
namespace Controllers;

use Model\Categoria;
use Model\Categoriaa;
use Model\User;
use Model\Suscriptor;
//use Model\ImgPopUp;
use MVC\Router;


class ClientController {

    public static function index(Router $router) {
        $functions = "encontrarProductosEnCarrito();createProduct();";
        $pageIndex = 0;
        $isClient = true;
      //  $imgsa = new ImgPopUp();
      //  $queryImgs = $imgsa::all();
      //  debuguear($queryImgs);
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        
        $router->render('client/index', [
            'function' => $functions,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }
    public static function rueda(Router $router) {
        $functions = "";
        $pageIndex = 0;
        $isClient = true;
      //  $imgsa = new ImgPopUp();
      //  $queryImgs = $imgsa::all();
      //  debuguear($queryImgs);
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        
        $router->render('client/rueda', [
            'function' => $functions,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }

    public static function products(Router $router) {
        if(isset($_GET['ea170e2cafb1337755c8b3d5ae4437f4'])) {
            $urlParam = $_GET['ea170e2cafb1337755c8b3d5ae4437f4'];
            $functions = "buscar('".$urlParam."');";
        } else {
            $functions = "buscar('0');";
        }
        //debuguear($_GET['ea170e2cafb1337755c8b3d5ae4437f4']);
        $pageIndex = 1;
        $isClient = true;
        $categorias = Categoria::all();
        //debuguear($categorias);
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
       // debuguear($categorias);
        $router->render('client/products', [
            'function' => $functions,
            'categorias' => $categorias,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }

    public static function productsMale(Router $router) {
        $urlParamPage = $_GET['89759e1284e2479b991d2669de104942'];
        //debuguear($urlParamPage);

        if(isset($_GET['4014baac2e585d86e97c81beb778c6c8'])) {
            $urlParam = $_GET['4014baac2e585d86e97c81beb778c6c8'];
            $functions = "encontrarPaginaDesdeUrl('".$urlParam."','".$urlParamPage."');";
            //debuguear($functions);
        } else {
            $functions = "findWords('');";
            //debuguear($functions);

        }
        //debuguear($_GET['ea170e2cafb1337755c8b3d5ae4437f4']);
        $pageIndex = 1;
        $isClient = true;
        $categorias = Categoria::findAllWhereOR('genero','0','genero','2');
       // debuguear($categorias);
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        $genero = '0';
        //debuguear($urlParam);
        $router->render('client/products', [
            'function' => $functions,
            'categorias' => $categorias,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            'genero' => $genero
        ]);
    }
    public static function productsFemale(Router $router) {
        $urlParamPage = $_GET['89759e1284e2479b991d2669de104942'];
        if(isset($_GET['4014baac2e585d86e97c81beb778c6c8'])) {
            $urlParam = $_GET['4014baac2e585d86e97c81beb778c6c8'];
            $functions = "encontrarPaginaDesdeUrl('".$urlParam."','".$urlParamPage."');";
            //debuguear($functions);
        } else {
            $functions = "findWords('');";
            //debuguear($functions);
        }
        $genero = '1';
        //debuguear($_GET['ea170e2cafb1337755c8b3d5ae4437f4']);
        $pageIndex = 1.5;
        $isClient = true;
        $categorias = Categoria::findAllWhereOR('genero','1','genero','2');
       // debuguear($categorias);
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
       // debuguear($categorias);
        $router->render('client/products', [
            'function' => $functions,
            'categorias' => $categorias,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            'genero' => $genero
        ]);
    }

    public static function productsaurum(Router $router) {
        if(isset($_GET['ea170e2cafb1337755c8b3d5ae4437f4'])) {
            $urlParam = $_GET['ea170e2cafb1337755c8b3d5ae4437f4'];
            $functions = "buscarA('".$urlParam."');buscarProductosCart();";
        } else {
            $functions = "buscarA('0');buscarProductosCart();";
        }
        
        $pageIndex = 2;
        $isClient = true;
        $categorias = Categoria::findAllCatWhere('aurum','1');
        //debuguear($urlParam);
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        
        $router->render('client/products-aurum', [
            'function' => $functions,
            'categorias' => $categorias,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }

    public static function about(Router $router) {
        $functions = "encontrarProductosEnCarrito();";
        $pageIndex = 3;
        $isClient = true;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        
        $router->render('client/about', [
            'function' => $functions,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }

    public static function terms(Router $router) {
        $functions = "encontrarProductosEnCarrito();";
        $pageIndex = 3.5;
        $isClient = true;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        
        $router->render('client/terms', [
            'function' => $functions,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }

    public static function reviews(Router $router) {
        $functions = "encontrarProductosEnCarrito();";
        $pageIndex = 4;
        $isClient = true;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        
        $router->render('client/reviews', [
            'function' => $functions,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }
    public static function contact(Router $router) {
        $functions = "encontrarProductosEnCarrito();";
        $pageIndex = 5;
        $isClient = true;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        
        $router->render('client/contact', [
            'function' => $functions,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }
    public static function cart(Router $router) {
        $functions = "buscarProductosCart();";
        $pageIndex = 6;
        $isClient = true;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        $router->render('client/cart', [
            'function' => $functions,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }
}
