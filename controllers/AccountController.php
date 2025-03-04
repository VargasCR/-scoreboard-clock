<?php
namespace Controllers;

use Model\User;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
class AccountController {
    public static function index(Router $router) {
        session_start();
        $auth = $_SESSION;
        $accountID = $_SESSION['id'];
        //debuguear($auth);
        $functions = 'findMyServices();findID();';
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        $router->render('account/index',[
            'auth' => $auth,
            'accountID' => $accountID,
            'function' => $functions,
            'alertlink'=>$alertlink
            //'id' => $_SESSION['id']
        ]);
    }


    
}