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
                            //debuguear($user->admin);
                            
                            header('Location: /21232f297a57a5a743894a0e4a801fc3');
                            //header('Location: /1ebd87f94f5b252983dc86d628d17e7a');
                        } else {
                            date_default_timezone_set('America/Costa_Rica');
                            $registro = new Registro();
                            $registro->idempleado = $user->id;
                            //debuguear($_SESSION);
                            $HoraActual = date("H:i:s");
                            $fechaActual = date("Y-m-d");
                            $fechasEncontradas = $registro->findDate($user->id,$fechaActual);
                            $fechaEncontrada = $registro->findTodayDate($user->id,$fechaActual);
                            //debuguear($fechaEncontrada);
                            if($fechasEncontradas === null && $fechaEncontrada === null) {
                                //  debuguear($fechasEncontradas);
                                $registro->fechaEntrada = $fechaActual;
                                $registro->fechaSalida = '2000-01-01';
                                $registro->horaEntrada = $HoraActual;
                                $registro->horaSalida = '00:00:00';
                                $registro->horasExtra = 0;
                                //$registro->horaSalida = null;
                                $registro->save();
                                //debuguear($user);
                                header('Location: /login?2d5278b057566a696ccff8d31ae5895b=3547d44613ce711ad7e2bc1808012b23&07cc694b9b3fc636710fa08b6922c42b='.$HoraActual);
                                //User::setAlert('success', 'Hora de Entrada REGISTRADA '.$registro->horaEntrada);
                            } else {
                                $registro->id = $fechasEncontradas->id;
                                $registro->horaEntrada = $fechasEncontradas->horaEntrada;
                                $registro->fechaEntrada = $fechasEncontradas->fechaEntrada;
                                $registro->horaSalida = $HoraActual;
                                $registro->fechaSalida = $fechaActual;
                                if($fechasEncontradas->horaSalida == '00:00:00') {
                                    //debuguear($registro);
                                    $registro->save();
                                    //User::setAlert('success', 'Usuario encontrado');
                                    header('Location: /login?2d5278b057566a696ccff8d31ae5895b=cd5cedd385ce4e84e8405997c37a8e3d&07cc694b9b3fc636710fa08b6922c42b='.$HoraActual);
                                    //User::setAlert('success', 'Hora de Salida REGISTRADA '.$registro->horaSalida);
                                    //debuguear($fechasEncontradas->horaSalida);
                                } else {
                                    header('Location: /login?2d5278b057566a696ccff8d31ae5895b=4a0fa8dde5c48a5e6718f1068b0bfdf8');
                                    //User::setAlert('error', 'Horario ya registrado, contacte al administrador');
                                }
                            }
                            //debuguear($fechas);
                            
                            //$registro->fecha = $fechaYHoraActual;
                            
                            
                            //User::setAlert('success', 'Usuario encontrado');
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

    
    
}
