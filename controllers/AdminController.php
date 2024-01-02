<?php

namespace Controllers;

use Model\AdminDate;
use Model\Registro;
use MVC\Router;
use Model\User;

class AdminController {
    public static function index( Router $router ) {
        session_start();
        $auth = $_SESSION;
        isAdmin();
        $empleados = new User();
        $perfiles = $empleados->all();
        $funtions = '/build/js/account.js';
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        $router->render('admin/index', [
            'perfiles' => $perfiles,
            'archive' => $funtions,
            'alertlink'=>$alertlink
        ]);
    }
    
    
    public static function showEmployeeTime( Router $router ) {
        $parametro = $_GET['id'];
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        $empleado = User::find($parametro);
        $fechaDesde = isset($_GET['fechaDesde']) ? $_GET['fechaDesde'] : date('Y-m-d', strtotime('last Monday'));
        $fechaHasta = isset($_GET['fechaHasta']) ? $_GET['fechaHasta'] : date('Y-m-d', strtotime('next Sunday'));
        $registros = Registro::findTimes($parametro,$fechaDesde,$fechaHasta);
        $router->render('admin/registroHoras', [
            'empleado' => $empleado,
            'registros' => $registros,
            'alertlink'=>$alertlink
        ]);

    }
    public static function editDateEmployee( Router $router ) {
        $parametro = $_GET['id'];
        $empleadoid = $_GET['uid'];
        $registro = Registro::find($parametro);
        $funtions = '/build/js/account.js';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $registroNuevo = new Registro();
            $registroNuevo->idempleado = $empleadoid;
            $registroNuevo->id = $parametro;
            $registroNuevo->horasExtra = 0;
            $registroNuevo->fechaEntrada = $_POST['fechaEntrada'];
            $registroNuevo->fechaSalida = $_POST['fechaSalida'];
            $registroNuevo->horaEntrada = $_POST['horaEntrada'];
            $registroNuevo->horaSalida = $_POST['horaSalida'];
            $registroNuevo->save();
            $registro = $registroNuevo;
            header('Location: /2885991af6301511c3ec390fec3fbceb?id='.$empleadoid);
        }
        $router->render('admin/editarRegistroHoras', [
            'registro' => $registro,
            'archive' => $funtions,
        ]);

    }
    public static function editEmployee( Router $router ) {
        $parametro = $_GET['id'];
        $usuario = User::find($parametro);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newUser = new User($_POST);
            $newUser->id = $parametro;
            isAdmin();
            $alerts = $newUser->validateNewAccount();
            if(empty($alerts)) {
                $newUser->hashPassword();
                $solved = $newUser->save();
                if($solved) {
                    header('Location: /21232f297a57a5a743894a0e4a801fc3');
                }
            }
        }
        $router->render('auth/edituser', [
            'usuario' => $usuario,
            'alerts' => $alerts,
        ]);
    }
}

