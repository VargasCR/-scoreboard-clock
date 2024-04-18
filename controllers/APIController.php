<?php
namespace Controllers;

use Classes\Email;
use Model\Categoria;
use Model\Categoriaa;
use Model\Registro;
use Model\User;
use Model\Producto;
use Model\Suscriptor;
use Model\ImgPopUp;
use Model\DiscountCode;

class APIController {

    public static function findProductsWords() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $palabras = $_POST['palabras'];
            $genero = $_POST['genero'];
            if($palabras != '') {
                $result = Producto::findProductWord($palabras,$genero);
            } else {
                $result = Producto::findAllWhereAND('genero',$genero,'activo','1');
            }
            echo json_encode($result);
        }
    }

    public static function findDiscountCode() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // echo json_encode('result');
            //$result = 'hecho';
            $result = DiscountCode::findCode($_POST['code']);
            //echo $result;
            echo json_encode($result);
        }
    }
    public static function activarDiscountCode() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // echo json_encode('result');
            //$result = 'hecho';
            
            $result = DiscountCode::find($_POST['id']);
            $ticket = new DiscountCode();
            $ticket->sync($result);
            $ticket->activado = '1';
            $ticket->save();
            echo json_encode($ticket);

        }
    }

public static function changeProductState() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product = Producto::find($_POST['id']);
        if($_POST['estado'] == '0' || $_POST['estado'] == null) {
            $product->activo = '1';
        } else {
            $product->activo = '0';
        }
        $result = $product->save();
        echo json_encode($result);
    }
}
public static function lastestProducts() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = Producto::findAllWhereAAND('new',1,'activo','1');
        echo json_encode($result);
    }
}

public static function findPopUpImg() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
       // echo json_encode('result');
        $result = ImgPopUp::all();
        echo json_encode($result);
    }
}


public static function findProduct() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $result = Producto::where('codigo',$id);
        echo json_encode($result);
    }
}

public static function findproducts() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $class = $_POST['class'];
        $tipo = $_POST['tipo'];
        $aurum = $_POST['aurum'];
        if($class == '0') {
            if($_POST['categoria']) {
                $result = Producto::findAllWhereANDAND('category',$_POST['categoria'],'genero',$tipo,'activo','1');
            } else {
                $result = Producto::findAllWhereAND('genero',$tipo,'activo','1');
            }
        } elseif($class == '1') {
            if($_POST['categoria']) {
                $result = Producto::findAllWhereAAND('category',$_POST['categoria'],'aurum','1');
            } else {
                $result = Producto::findAllWhereAND('aurum','1','activo','1');
                
            }
        }

        echo json_encode($result);
    }
}

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
public static function deleteSuscriptor() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = $_POST['id'];
        $suscriptor = Suscriptor::find($id);

        $result = false;
        //$registros = Registro::findAllWhere('idempleado',$id);
        if($suscriptor) {
            $result = $suscriptor->delete();
            $result = true;
           // return;
            echo json_encode($result);
        }
        //$services = Service::findMyServices($_POST['userid']);
    }
}



public static function deleteCategory() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = $_POST['id'];
        $categoria = Categoria::find($id);

        $result = false;
        //$registros = Registro::findAllWhere('idempleado',$id);
        if($categoria) {
            $result = $categoria->delete();
            $result = true;
           // return;
            echo json_encode($result);
        }
        //$services = Service::findMyServices($_POST['userid']);
    }
}
public static function deleteCategoryA() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = $_POST['id'];
        $categoria = Categoriaa::find($id);

        $result = false;
        //$registros = Registro::findAllWhere('idempleado',$id);
        if($categoria) {
            $result = $categoria->delete();
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
            $result = true;
        }
        //$services = Service::findMyServices($_POST['userid']);
        echo json_encode($result);
    }
}

public static function deletePopUpImg() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $img = ImgPopUp::find($id);
        $result = false;
        if($img) {
            $result = $img->delete();
            $result = true;
        }
        if($result) {
            $images = ImgPopUp::all();
            usort($images, function($a, $b) {
                return intval($a->index) - intval($b->index);
            });
            $newIndex = 0;
            foreach ($images as $item) {
                $item->index = $newIndex;
                $item->save();
                $newIndex++;
            }
        }
        //$services = Service::findMyServices($_POST['userid']);
        echo json_encode($result);
    }
}


public static function deleteProduct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = $_POST['id'];
        $registro = Producto::find($id);
        $result = false;
        $arrayImagenes = [];

        if ($registro) {
            //$result = $registro->delete();
            $imagenPrincipal = $registro->imagen;
            $arrayImagenes = $registro->colores;

            // Iterar sobre cada elemento en $arrayImagenes
            foreach ($arrayImagenes as $color) {
                // Acceder a la información de cada color
                $imagenDel = $color['imagen'];
                echo json_encode($imagenDel); 
                $registro->deleteImage($imagenDel);
            }
            $registro->id = $id;
            $result = $registro->delete();
        }
        echo json_encode($arrayImagenes); 
    }
}

public static function addNewSuscribe() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        //$registro = Suscriptor::find($mail);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //echo json_encode('suscriptor');
            //$suscriptor = new Suscriptor();
            $suscriptor = new Suscriptor();
            $suscriptor->email = $email;
            $suscriptor->save();
            // debuguear($suscriptor);
            echo json_encode(true);
            //echo "La dirección de correo electrónico es válida.";
        } else {
            echo json_encode(false);
            //echo "La dirección de correo electrónico no es válida.";
        }
        
        //$services = Service::findMyServices($_POST['userid']);
    }
}

}