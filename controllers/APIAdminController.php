<?php
namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\Pictures;
use Model\Service;
use Model\Tags;

class APIAdminController extends ActiveRecord{

    public static function index() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            $services = Service::adminGetAll($code);
            if ($services) {
                foreach ($services as $service) {
                    $id = $service->id;
                    $tags[$id] = Tags::findIn('serviceid',$id);
                    $pictures[$id] = Pictures::findIn('serviceid',$id);
                }
            } 
           // echo json_encode(['services' => $services]);
            
                echo json_encode([
                    'services' => $services,
                    'tags' => $tags,
                    'pictures' => $pictures
                ]); 
        }
        
    }

   




}

?>