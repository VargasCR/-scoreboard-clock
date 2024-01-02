<?php
namespace Controllers;

use Classes\Email;
use Exception;
use Model\Service;
use Model\Appointment;
use Model\Appointmentservices;
use Model\Cantones;
use Model\Category;
use Model\Distritos;
use Model\PassToken;
use Model\Pictures;
use Model\Plan;
use Model\Provincias;
use Model\Registro;
use Model\Tags;
use Model\User;

class APIController {
    


public static function deleteEmployee() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = $_POST['idUsuario'];
        $user = User::find($id);

        $result = false;
        $registros = Registro::findAllWhere('idempleado',$id);
        if($user) {
            foreach ($registros as $registro) {
                $registro->delete();
            }
            $result = $user->delete();
            $result = true;
           // return;
            echo json_encode($result);
        }
        //$services = Service::findMyServices($_POST['userid']);
    }
}

public static function borrarRegistro() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = $_POST['idRegistro'];
        $registro = Registro::find($id);
        $result = false;
        if($registro) {
            $result = $registro->delete();
        }
        //$services = Service::findMyServices($_POST['userid']);
        echo json_encode($result);
    }
}



}

