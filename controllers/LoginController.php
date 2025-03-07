<?php
namespace Controllers;

use Model\User;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Registro;

class LoginController {
    public static function login(Router $router) {
        $pageIndex = 7;
        $isClient = false;
        //$alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
        	
            $alerts = $auth->validateLogin();
            if(empty($alerts)) {
            	
                $user = User::where('dni', $auth->dni);
            	
                $validated = $auth->checkValidateUser($user->pass);
                //debuguear($validated);
                if($user && $validated) {
                    if($user->admin === "1") {
                        session_start();
                        $user->updateSession();
                        $_SESSION['admin'] = $user->admin ?? null;
                        //debuguear($user);
                        header('Location: /21232f297a57a5a743894a0e4a801fc3');
                    } else if($user->admin === "2") {
                        session_start();
                        $user->updateSession();
                        $_SESSION['admin'] = $user->admin ?? null;
                        header('Location: /21232f297a57a5a743894a0e4a801fc7');
                    } else {
                        date_default_timezone_set('America/Costa_Rica');
                        $registro = new Registro();
                        $registro->idempleado = $user->id;
                        $HoraActual = date("H:i:s");
                        $fechaActual = date("Y-m-d");
                        $fechasEncontradas = $registro->findDate($user->id,$fechaActual);
                        $fechaEncontrada = $registro->findTodayDate($user->id,$fechaActual);
                        if($fechasEncontradas === null && $fechaEncontrada === null) {
                            $registro->fechaEntrada = $fechaActual;
                            $registro->fechaSalida = '2000-01-01';
                            $registro->horaEntrada = $HoraActual;
                            $registro->horaSalida = '00:00:00';
                            $registro->horasExtra = 0;
                            $registro->save();
                            header('Location: /login?2d5278b057566a696ccff8d31ae5895b=3547d44613ce711ad7e2bc1808012b23&07cc694b9b3fc636710fa08b6922c42b='.$HoraActual);
                        } else {
                            $registro->id = $fechasEncontradas->id;
                            $registro->horaEntrada = $fechasEncontradas->horaEntrada;
                            $registro->fechaEntrada = $fechasEncontradas->fechaEntrada;
                            $registro->horaSalida = $HoraActual;
                            $registro->fechaSalida = $fechaActual;
                            if($fechasEncontradas->horaSalida == '00:00:00') {
                                $registro->save();
                                header('Location: /login?2d5278b057566a696ccff8d31ae5895b=cd5cedd385ce4e84e8405997c37a8e3d&07cc694b9b3fc636710fa08b6922c42b='.$HoraActual);
                            } else {
                                header('Location: /login?2d5278b057566a696ccff8d31ae5895b=4a0fa8dde5c48a5e6718f1068b0bfdf8');
                            }
                        }
                    }
                } else {
                    header('Location: /login?2d5278b057566a696ccff8d31ae5895b=4a0fa8dde5c48a5e6718f1068b0bfdf7');
                    User::setAlert('error', 'Usuario no encontrado');
                }
            }
        }
        $alerts = User::getAlert();
        $router->render('auth/login', [
            'alerts' => $alerts,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            //'alertlink'=>$alertlink
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /login');
    }
   
    public static function singup(Router $router) {
        isAdmin();
        $pageIndex = 7;
        $isClient = false;
        $users = null; // Initialize $users
        $alerts = null; // Initialize $alerts
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $users = new User($_POST);
            //$users->sync($_POST);
            
            $alerts = $users->validateNewAccount();
            if(empty($alerts)) {
                
                $solved = $users->userReadyExists();
                if($solved->num_rows) {
                    $alerts = User::getAlert();
                } else {
                    $users->hashPassword();
                    
                    $solved = $users->save();
                    
                   
                    if($solved) {
                        header('Location: /78e731027d8fd50ed642340b7c9a63b3');
                    }
                    
                }
            }
        }
        $router->render('auth/sing-up', [
            'users' => $users,
            'alerts' => $alerts,
            'isClient' => $isClient,
            'pageIndex' => $pageIndex,
        ]);
    }
    
    public static function message(Router $router) {
        isAdmin();
        $pageIndex = 7;
        $isClient = false;
        $router->render('auth/message',[
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }

    public static function changePassword(Router $router) {
        isAdmin();
        $pageIndex = 7;
        $isClient = false;
        $user = null; // Initialize $users
        $alerts = null; // Initialize $alerts
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $user->sync($_POST);
            $alerts = $user->validateChangePass();
            $user = User::where('id', $_SESSION['id']);
            //debuguear($user);
            $alerts = $user->checkValidateUserNewPass($_POST['old_password']);
            //debuguear($alerts);
            
            if(empty($alerts)) {
                $user->pass = $_POST['new_password'];
                //$solved = $user;
                $user->hashPassword();
                $user->save();
                if (!is_array($alerts)) {
                    $alerts = [];
                }
                
                if (!isset($alerts['success']) || !is_array($alerts['success'])) {
                    $alerts['success'] = [];
                }
                
                $alerts['success'][] = 'CONTRASEÑA CAMBIADA CORRECTAMENTE.';
                
                //debuguear($alerts);
                $router->render('admin/cambiarPass', [
                    'users' => $user,
                    'alerts' => $alerts,
                    'isClient' => $isClient,
                    'pageIndex' => $pageIndex,
                ]);
                //header('Location: /Y2hhbmdlUGFzc3dvcmQ');
                
            }
        }
        $router->render('admin/cambiarPass', [
            'users' => $user,
            'alerts' => $alerts,
            'isClient' => $isClient,
            'pageIndex' => $pageIndex,
        ]);
    }
    
}
