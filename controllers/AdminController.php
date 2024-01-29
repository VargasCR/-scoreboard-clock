<?php

namespace Controllers;

use Model\Producto;
use Model\Registro;
use Model\Categoria;
use Model\Categoriaa;
use MVC\Router;
use Model\User;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Suscriptor;

class AdminController {
    public static function index( Router $router ) {
        //session_start();
        //$auth = $_SESSION;
        //debuguear('2');
        $pageIndex = 7;
        $isClient = false;
        isAdmin();
        $empleados = new User();
        $perfiles = $empleados->all();
        $funtions = '/build/js/account.js';
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        $router->render('admin/empleados', [
            'perfiles' => $perfiles,
            'archive' => $funtions,
            'alertlink'=>$alertlink,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }
    public static function menuSeleccionar( Router $router ) {
        //session_start();
        //$auth = $_SESSION;
        //debuguear('2');
        $pageIndex = 7;
        $isClient = false;
        isAdmin();
        
        $router->render('admin/seleccionarMenu', [
            
        ]);
    }
    
    
    public static function showEmployeeTime( Router $router ) {
        $parametro = $_GET['id'];
        $pageIndex = 7;
        $isClient = false;
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        $empleado = User::find($parametro);
        $fechaDesde = isset($_GET['fechaDesde']) ? $_GET['fechaDesde'] : date('Y-m-d', strtotime('last Monday'));
        $fechaHasta = isset($_GET['fechaHasta']) ? $_GET['fechaHasta'] : date('Y-m-d', strtotime('next Sunday'));
        $registros = Registro::findTimes($parametro,$fechaDesde,$fechaHasta);
        $router->render('admin/registroHoras', [
            'empleado' => $empleado,
            'registros' => $registros,
            'alertlink'=>$alertlink,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);

    }

    public static function mostrarSuscriptores( Router $router ) {
        $parametro = $_GET['id'];
        $pageIndex = 7;
        $isClient = false;
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        
        $registros = Suscriptor::all();
        
        //debuguear($registros);
        $router->render('admin/suscriptores', [
            'registros' => $registros,
            'alertlink'=>$alertlink,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);

    }
    public static function mostrarCategorias( Router $router ) {
        $parametro = $_GET['id'];
        $pageIndex = 7;
        $isClient = false;
        //$registro = Categoria::all();
        //debuguear($registro);
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria = new Categoria($_POST);
            $categoria->save();
        }
        $registros = Categoria::all();
        $router->render('admin/categorias', [
            'registros' => $registros,
            'alertlink'=>$alertlink,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);

    }
    public static function mostrarCategoriasA( Router $router ) {
        $parametro = $_GET['id'];
        $pageIndex = 7;
        $isClient = false;
        //$registro = Categoriaa::find(0);
        //debuguear('registro');
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria = new Categoriaa($_POST);
            $categoria->save();
        }
        $registros = Categoriaa::all();
        $router->render('admin/categoriasa', [
            'registros' => $registros,
            'alertlink'=>$alertlink,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);

    }
    public static function editDateEmployee( Router $router ) {
        $parametro = $_GET['id'];
        $empleadoid = $_GET['uid'];
        $pageIndex = 7;
        $isClient = false;
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
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);

    }
    public static function editEmployee( Router $router ) {
        $users = null; // Initialize $users
        $alerts = null; // Initialize $alerts
        $parametro = $_GET['id'];
        $pageIndex = 7;
        $isClient = false;
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
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }
    
    

    public static function showProductIndex( Router $router ) {
        
        $pageIndex = 7;
        $isClient = false;
        $producto = new Producto();

        $pagina = isset($_GET['page']) ? $_GET['page'] : '1';
        if($pagina == '') {
            $pagina = 1;
        }
        $resultadosPorPagina = 10;
        $productos = $producto->allFromPage($pagina,$resultadosPorPagina);
        $cantProductos = $producto->counter();

        // Calcular la cantidad de páginas necesarias
        $totalPaginas = ceil($cantProductos / $resultadosPorPagina);

        $categoria = new Categoria();
        $categorias = $categoria->all();

       // debuguear($productos);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        //debuguear($productos);
        $router->render('admin/productos', [
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            'productos' => $productos,
            'categorias' => $categorias,
            'cantProductos' => $cantProductos,
            'pagina' => $pagina,
            'totalPaginas' => $totalPaginas,

        ]);
    }
    public static function agregarProducto( Router $router ) {
        
        $pageIndex = 7;
        $isClient = false;
        $producto = new Producto();
        $categoria = new Categoria();
        $categorias = $categoria->all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_FILES['imagen']['tmp_name']);
        //$alerts = $producto->validateProduct($_POST,$_FILES['imagenColor']['tmp_name'],$_FILES['imagen']['tmp_name']);
            //debuguear($_POST);
            if(empty($alerts)) {
                $producto->sync($_POST);
                $alerts = [];
                $producto->desc = $producto->convertirTextAJSON($_POST['desc']);
                if (!is_dir(IMAGE_FOLDER)) {
                    mkdir(IMAGE_FOLDER);
                }
                $imagenesJSON = [];
                //debuguear('$');
                foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
                    $image_name = md5( uniqid( rand(), true ) ) . '.jpg';
                    $imagen = Image::make ($tmp_name)->fit(600,740);
                   // debuguear($image_name);
                    //debuguear(0);

                    if ($imagen->save(IMAGE_FOLDER . $image_name)) {
                        // Asignar el nombre de la imagen al producto o almacenar en un array si es necesario
                        // Almacenar información relevante en el array $imagenesJSON
                        $imagenesJSON[] = $image_name;
                        //  $producto->addImage($image_name);--------
                    } else {
                        // Manejar el caso en el que no se pudo guardar la imagen
                        $alerts[] = 'Error al guardar la imagen ' . $key;
                    }
                }
                $imagenes = json_encode($imagenesJSON);
                $producto->setImage($imagenes);
                
                //debuguear($producto);
                $tallasArray = explode(',', $_POST['tallas']);
                $tallasJson = json_encode($tallasArray);
                $producto->tallas = $tallasJson;
                $countImages = 0;
                $imagenesJSON = [];
                $nombre = '';
                $rgb = '';
               // debuguear('$');




                $colorFileCountValue = $_POST['colorFileCount'];

// Convierte la cadena en un array utilizando explode
$colorFileCountArray = explode(',', $colorFileCountValue);
//debuguear($_POST);
// Realiza un bucle foreach en el array
foreach ($colorFileCountArray as $value => $key) {
    // $value ahora contiene cada número del array
    // Realiza las operaciones necesarias aquí
    $imagenJSON = [];
    foreach ($_FILES['imagenColor_'.$value]['tmp_name'] as $key => $tmp_name) {
        $image_name = md5(uniqid(rand(), true)) . '.jpg';

        $imagen = Image::make($tmp_name)->fit(400, 540);
        
        // Guardar la imagen
        if ($imagen->save(IMAGE_FOLDER . $image_name)) {
            // Asignar el nombre de la imagen al producto o almacenar en un array si es necesario
            // Almacenar información relevante en el array $imagenesJSON
            $imagenJSON[] = $image_name;
            
            //  $producto->addImage($image_name);--------
        } else {
            // Manejar el caso en el que no se pudo guardar la imagen
            $alerts[] = 'Error al guardar la imagen ' . $key;
        }
    }
    $nombre = $_POST['color'][$countImages];
        $rgb = $_POST['rgb'][$countImages];
        $countImages++;
    //debuguear($nombre);
    $imagenesJSON[] = [
        'rgb' => $rgb,
        'color' => $nombre,
        'imagen' => $imagenJSON
    ];
    $imagenesColores[] = $imagenesJSON;
    
}

$ColoresjsonResult = json_encode($imagenesJSON);
//debuguear($ColoresjsonResult);
                $producto->colores = $ColoresjsonResult;

                $producto->save();
            }
            //debuguear($_FILES['imagenColor']);
        }
        //$producto->imagen = $image_name;
        $router->render('admin/agregarRegistroProducto', [
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            'categorias' => $categorias,
            'alerts' => $alerts,

        ]);
    }



    public static function editarProducto( Router $router ) {
        $users = null; // Initialize $users
        $alerts = null; // Initialize $alerts
        $parametro = $_GET['b80bb7740288fda1f201890375a60c8f'];
        $pageIndex = 7;
        $isClient = false;
        $producto = Producto::find($parametro);
        $function = 'encontrarTotalColores()';
        
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //$newPrdoucto->sync($_POST);
            $newPrdouct = new Producto($_POST);
            //$alerts = $newPrdouct->validateOldProduct($_POST,$_FILES['imagenColor']['tmp_name'],$_FILES['imagen']['tmp_name']);
            
            $newPrdouct->id = $parametro;
            $producto = Producto::find($parametro);
            $alerts = [];

            $newPrdouct->desc = $newPrdouct->convertirTextAJSON($_POST['desc']);
           
            if (!is_dir(IMAGE_FOLDER)) {
                mkdir(IMAGE_FOLDER);
            }
            
            
          //  debuguear(!empty(array_filter($_FILES['imagen']['tmp_name'])));
             // debuguear(!empty(array_filter($_FILES['imagen']['tmp_name'])));
            if (!empty(array_filter($_FILES['imagen']['tmp_name']))) {
                //debuguear($_FILES['imagen']['tmp_name']);
                $imagenesJSON = [];
                $imagenesJSON = json_decode($producto->imagen, true);
                foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
                    if($tmp_name != '') {
                        $image_name = md5( uniqid( rand(), true ) ) . '.jpg';
                        $imagen = Image::make ($tmp_name)->fit(600,740);
                        
                        if ($imagen->save(IMAGE_FOLDER . $image_name)) {
                            // Asignar el nombre de la imagen al producto o almacenar en un array si es necesario
                            // Almacenar información relevante en el array $imagenesJSON
                            $imagenesJSON[] = $image_name;
                            //  $producto->addImage($image_name);--------
                        } else {
                            // Manejar el caso en el que no se pudo guardar la imagen
                            $alerts[] = 'Error al guardar la imagen ' . $key;
                        }
                    }
                }
                
                
               // debuguear($imagenesJSON);
                $imagenes = json_encode($imagenesJSON);
                $newPrdouct->imagen = $imagenes;
            } else {
                $newPrdouct->imagen = $producto->imagen;
            }
           // debuguear($newPrdouct);
            $tallasArray = explode(',', $_POST['tallas']);
            
            $tallasJson = json_encode($tallasArray);
            $newPrdouct->tallas = $tallasJson;
            
            
            $countImages = 0;
            $countImagesColor = 0;
            $imagenesJSON = [];
            $nombre = '';
            $rgb = '';

            
            $imagenesJSON = json_decode($producto->colores, true);
            $arrayPHP = explode(',', $_POST['colorFileCount']);
            //debuguear($arrayPHP);
            foreach ($arrayPHP as $value) {
                $imagenJSON = [];
                $encontrado = false;
                //echo $value;
                $nombre = null;
                $rgb = null;
                foreach ($_FILES['imagenColor_'.$value]['tmp_name'] as $key => $tmp_name) {
                   
                    if(file_exists($tmp_name)) {
                        
                        $image_name = md5(uniqid(rand(), true)) . '.jpg';
                        // Intentar cargar la imagen
                        $imagen = Image::make($tmp_name)->fit(400, 540);
                        $encontrado = true;
                        // Guardar la imagen
                        if ($imagen->save(IMAGE_FOLDER . $image_name)) {
                            $imagenJSON[] = $image_name;
                        } else {
                            // Manejar el caso en el que no se pudo guardar la imagen
                            $alerts[] = 'Error al guardar la imagen ' . $key;
                        }
                        
                        if($_POST['color'][$countImages] != null) {
                            $nombre = $_POST['color'][$countImages];
                            $rgb = $_POST['rgb'][$countImages];
                        }
                        $countImages++;
                        //$imagenesTempJSON[] = $imagenJSON;     
                        //debuguear($imagenJSON);
                         //debuguear($imagenJSON);
                       /* if($_POST['color'][$countImages] != null) {
                            //debuguear($imagenJSON);
                            $imagenesTempJSON[] = [
                                'imagen' => $imagenJSON
                            ];     
                        }*/
                    }
                    
                    
                    //$imagenesColores[] = $imagenesJSON;
                }
                if($nombre != null) {
                    $imagenesJSON[] = [
                        'rgb' => $rgb,
                        'color' => $nombre,
                        'imagen' => $imagenJSON
                    ];
                }
                $countImagesColor++;
                
            }
            //debuguear(array_filter($imagenesJSON));
            
            // Iterar sobre cada archivo de imagen
            
            $ColoresjsonResult = json_encode($imagenesJSON);
            //debuguear($imagenesJSON);
            $newPrdouct->colores = $ColoresjsonResult;
            
            
                if (!empty($_POST['imagenesEliminar'])) {
                    
                    $imagenesEliminarArray = json_decode($_POST['imagenesEliminar']);
                    $coloresIndex = explode(',', $_POST['IndexColoresEliminar']);
                    if($imagenesEliminarArray == null) {
                        //$imagenesEliminarArray = $_POST['imagenesEliminar'];
                        $imagenesEliminarArray = explode(',',$_POST['imagenesEliminar']);
                    }
                    
                    //debuguear($imagenesEliminarArray);
                    foreach ($coloresIndex as $indice) {     
                        $colors = json_decode($newPrdouct->colores);
                        unset($colors[$indice]);
                    }
                    
                    
                    $newPrdouct->colores = json_encode(array_values($colors));
                    
                   
                    
                    
                }
                if (!empty($imagenesEliminarArray)) {
                    $imgArray = json_decode($newPrdouct->imagen);
                    foreach ($imagenesEliminarArray as $indice => $color) {
                        foreach ($imgArray as $k => $v) {
                            if($color == $v) {
                                unset($imgArray[$k]);
                            }
                        }
                    }
                    $newPrdouct->imagen = json_encode(array_values($imgArray));
                    

                    foreach ($imagenesEliminarArray as $indice => $color) {
                        $producto->deleteImage($color);
                    }
                }
               // debuguear($newPrdouct);
                if(empty($alerts)) {
                    //$producto->imagen = $producto->imagen;
                    $producto->sync($newPrdouct);
                    //debuguear($producto->colores);
                    //debuguear($producto);
                    //
                    //debuguear($producto);
                   // debuguear($newPrdouct);
                    $producto->save();
                    header('Location: /d94a5da526ad85f8e50ca84d4be1defd?b80bb7740288fda1f201890375a60c8f='.$parametro);           
                }
            }
        
       // debuguear($producto->colores);
        $categoria = new Categoria();
        $categorias = $categoria->all();
        $newDesc = $producto->restaurarAJSON($producto->desc);
        
        // Convertir el array a una cadena de texto
        $textoNormal = '';
        foreach ($newDesc as $linea) {
            $textoNormal .= $linea . "\n";
        }
        $producto->desc = $textoNormal;
        //debuguear($textoNormal);
        $tallasNormal = $producto->restaurarAJSON($producto->tallas);

        $textoNormal = '';
        $ultimoIndice = count($tallasNormal) - 1;

        foreach ($tallasNormal as $indice => $linea) {
            // Verifica si es el último elemento antes de agregar la coma
            $textoNormal .= $linea . ($indice === $ultimoIndice ? '' : ",");
        }
        $producto->tallas = $textoNormal;
        $colores = json_decode($producto->colores, true);
        $producto->colores = $colores;
        //debuguear($producto->colores);
        $router->render('admin/editarRegistroProductos', [
            'producto' => $producto,
            'alerts' => $alerts,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            'categorias' => $categorias,
            'function' => $function,
        ]);
    }
}

