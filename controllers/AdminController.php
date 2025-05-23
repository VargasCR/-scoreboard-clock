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
use Model\ImgPopUp;

class AdminController {

    public static function menuPopUp( Router $router ) {
        $pageIndex = 7;
        $isClient = false;
        isAdmin();
        $images = ImgPopUp::all();
        usort($images, function($a, $b) {
            return intval($a->index) - intval($b->index);
        });
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $img = ImgPopUp::find($_POST['id']);
            $oldIndex = $img->index;
            $newIndex = $oldIndex - 1;
            $itemChanged = -1;
            foreach ($images as $item) {
                if($item->index == $oldIndex) {
                    $item->index = $newIndex;
                    $itemChanged = $item->id;
                    $item->save();
                }
            }
            foreach ($images as $item) {
              //  debuguear($newIndex);
                if($item->index == $newIndex && $item->id != $itemChanged) {
                    $item->index = $oldIndex;
                    $item->save();
                }
            }
            usort($images, function($a, $b) {
                return intval($a->index) - intval($b->index);
            });
            //debuguear($images);
            header('Location: /e0ba580ca07a56b26d44e88ee03b1abb');
        }
        $router->render('admin/PopUpImg', [
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            'images' => $images,

        ]);
    }

    public static function agregarPopUpImg( Router $router ) {
        $pageIndex = 7;
        $popUpImg = new ImgPopUp();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = ImgPopUp::all();
            //debuguear($result);
           // debuguear($_FILES['imagenV']['tmp_name']);
            if($_FILES['imagenV']['tmp_name'] == '') {
                $alerts['error'][] = 'Agregue una imagen Vertical';
            }
            if($_FILES['imagenH']['tmp_name'] == '') {
                $alerts['error'][] = 'Agregue una imagen Horizontal';
            }
            if(empty($alerts)) {
                $image_name = md5( uniqid( rand(), true ) ) ;
                $imagen = Image::make($_FILES['imagenV']['tmp_name']);
                if ($imagen->save(IMAGE_FOLDER . $image_name. '-v.jpg')) {
                    
                } else {
                    $alerts['error'][] = 'Error al guardar la imagen ';
                }
                $imagen = Image::make($_FILES['imagenH']['tmp_name']);
                if ($imagen->save(IMAGE_FOLDER . $image_name. '-h.jpg')) {
                    
                } else {
                    $alerts['error'][] = 'Error al guardar la imagen ';
                }
                $popUpImg->name = $image_name;
                if(empty($result)) {
                    $popUpImg->index = '0';
                } else {
                    $popUpImg->index = '1';

                }
                // Inicializar el índice más alto
                $highestIndex = -1;

                // Iterar sobre el array
                foreach ($result as $obj) {
                    // Convertir el índice a entero y compararlo con el índice más alto actual
                    $currentIndex = intval($obj->index);
                    if ($currentIndex > $highestIndex) {
                        // Si el índice actual es mayor, actualizar el índice más alto
                        $highestIndex = $currentIndex;
                    }
                }
                $popUpImg->index = $highestIndex + 1;
                $popUpImg->save();
                $alerts['success'][] = 'Guardado correctamente';
            }
            //debuguear($_FILES['imagenV']['tmp_name']);
        }
        $router->render('admin/addPopUpImg', [
            'pageIndex' => $pageIndex,
            'alerts' => $alerts,
        ]);
    }

    public static function crearPDFreport(Router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Obtener los datos del formulario
            $fechaDesde = $_POST['fechaDesde'];
            $fechaHasta = $_POST['fechaHasta'];
            $parametro = $_POST['id'];
            $totalSalario = $_POST['totalSalario'];
            $totalHoras = $_POST['totalHoras'];
    
            // Buscar al empleado y los registros
            $empleado = User::find($parametro);
            $registros = Registro::findTimes($parametro, $fechaDesde, $fechaHasta);
            $registro = new Registro();
    
            // Generar el PDF y obtener la ruta
            $rutaPDF = $registro->crearPDFreport($registros, $empleado, $totalSalario, $totalHoras);
            $rutaCompleta = $rutaPDF[0]; // Obtener la ruta completa en el servidor
            

            // Verificar si el archivo existe
            if (file_exists($_SERVER['DOCUMENT_ROOT'] .'/build/report/'. $rutaPDF[1])) {
                // Forzar la descarga del archivo PDF
            
                header('Content-Description: File Transfer');
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . $rutaPDF[1] . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($_SERVER['DOCUMENT_ROOT'] .'/build/report/'. $rutaPDF[1]));
                readfile($_SERVER['DOCUMENT_ROOT'] .'/build/report/'. $rutaPDF[1]);
            	//debuguear('xx');
                return;
            } else {
                echo "Error: El archivo no se encontró.";
            }
        }
    }
    
    public static function index( Router $router ) {
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
        $pageIndex = 7;
        $isClient = false;
        isAdmin();
        
        $router->render('admin/seleccionarMenu', [
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
        ]);
    }
    
    public static function showEmployeeTime( Router $router ) {
        $parametro = $_GET['id'];
        $pageIndex = 7;
        $isClient = false;
        $alertlink = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        $empleado = User::find($parametro);
        //debuguear($empleado);
        $fechaDesde = isset($_GET['fechaDesde']) ? $_GET['fechaDesde'] : date('Y-m-d', strtotime('last Monday'));
        $fechaHasta = isset($_GET['fechaHasta']) ? $_GET['fechaHasta'] : date('Y-m-d', strtotime('next Sunday'));
        $registros = Registro::findTimes($parametro,$fechaDesde,$fechaHasta);
        $router->render('admin/registroHoras', [
            'empleado' => $empleado,
            'registros' => $registros,
            'alertlink'=>$alertlink,
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta
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
            if($categoria->aurum != '0') {
                $categoria->aurum = '1';
            }
            //debuguear($categoria);
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

    public static function addDateEmployee( Router $router ) {
        //$parametro = $_GET['id'];
        $empleadoid = $_GET['uid'];
        $pageIndex = 7;
        $isClient = false;
        //$registro = Registro::find($parametro);
        $funtions = '/build/js/account.js';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $registroNuevo = new Registro();
            $registroNuevo->idempleado = $empleadoid;
            //$registroNuevo->id = $parametro;
            $registroNuevo->horasExtra = 0;
            $registroNuevo->fechaEntrada = $_POST['fechaEntrada'];
            $registroNuevo->fechaSalida = $_POST['fechaSalida'];
            $registroNuevo->horaEntrada = $_POST['horaEntrada'];
            $registroNuevo->horaSalida = $_POST['horaSalida'];
            $registroNuevo->save();
            $registro = $registroNuevo;
            header('Location: /2885991af6301511c3ec390fec3fbceb?id='.$empleadoid);
        }
        $router->render('admin/agregarRegistroHoras', [
            //'registro' => $registro,
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
                    header('Location: /21232f297a57a5a743894a0e4a801fc7');
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
            //debuguear($_POST);
            $colorFileCountValue = $_POST['colorFileCount'];
            $colorFileCountArray = explode(',', $colorFileCountValue);
           // debuguear($_FILES['imagenColor']['tmp_name']);
            $alerts = $producto->validateProduct($_POST,$_FILES,$_FILES['imagen']['tmp_name'],$colorFileCountArray);
            //debuguear($alerts);
            //debuguear($_POST);
            if(empty($alerts)) {
                $producto->sync($_POST);
                $alerts = [];
                $producto->desc = $producto->convertirTextAJSON($_POST['desc']);
                if (!is_dir(IMAGE_FOLDER)) {
                    mkdir(IMAGE_FOLDER);
                }
                
                $imagenesJSON = [];
                foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
                    $image_name = md5( uniqid( rand(), true ) ) . '.jpg';
                    $imagen = Image::make ($tmp_name);

                    $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/marca/atlantic.png';
                    $marca_de_agua = Image::make($ruta_marca_de_agua);
                    $marca_de_agua->resize(400, 400);
                    $imagen->insert($marca_de_agua, 'top-right',10,40);

                    if($_POST['marca'] != '0') {
                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/logos-oscuros/'.$_POST['marca'].'.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(560, 560);
                        $imagen->insert($marca_de_agua, 'top-left',20,0);
                    }
                    if($_POST['original'] == '1') {
                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/marca/original.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(700, 700);
                        $imagen->insert($marca_de_agua, 'bottom-right',10,-100);
                    }


                    
                    if ($imagen->save(IMAGE_FOLDER . $image_name)) {
                        $imagenesJSON[] = $image_name;
                    } else {
                        $alerts[] = 'Error al guardar la imagen ' . $key;
                    }
                    
                }
                $imagenes = json_encode($imagenesJSON);
                $producto->setImage($imagenes);
                $tallasArray = explode(',', $_POST['tallas']);
                $tallasJson = json_encode($tallasArray);
                $producto->tallas = $tallasJson;
                $countImages = 0;
                $imagenesJSON = [];
                $nombre = '';
                $rgb = '';
                
                foreach ($colorFileCountArray as $value => $key) {
                    $imagenJSON = [];
                    foreach ($_FILES['imagenColor_'.$value]['tmp_name'] as $key => $tmp_name) {
                        $image_name = md5(uniqid(rand(), true)) . '.jpg';
                        $imagen = Image::make($tmp_name);
                        
                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/marca/atlantic.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(400, 400);
                        $imagen->insert($marca_de_agua, 'top-right',10,40);

                    if($_POST['marca'] != '0') {
                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/logos-oscuros/'.$_POST['marca'].'.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(560, 560);
                        $imagen->insert($marca_de_agua, 'top-left',20,0);
                    }
                    if($_POST['original'] == '1') {
                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/marca/original.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(700, 700);
                        $imagen->insert($marca_de_agua, 'bottom-right',10,-100);
                    }

                        if ($imagen->save(IMAGE_FOLDER . $image_name)) {


                            $imagenJSON[] = $image_name;
                        } else {
                            $alerts[] = 'Error al guardar la imagen ' . $key;
                        }
                    }
                    $nombre = $_POST['color'][$countImages];
                        $rgb = $_POST['rgb'][$countImages];
                        $countImages++;
                    $imagenesJSON[] = [
                        'rgb' => $rgb,
                        'color' => $nombre,
                        'imagen' => $imagenJSON
                    ];
                    $imagenesColores[] = $imagenesJSON;
                    
                }

                $ColoresjsonResult = json_encode($imagenesJSON);
                $producto->colores = $ColoresjsonResult;
                $producto->activo = '1';
                $producto->descuento = $_POST['descuento'];
                $producto->save();
            }
        }
        //debuguear('a');
        $router->render('admin/agregarRegistroProducto', [
            'pageIndex' => $pageIndex,
            'isClient' => $isClient,
            'categorias' => $categorias,
            'alerts' => $alerts,

        ]);
    }

    public static function editarProducto( Router $router ) {
        $users = null;
        $alerts = null;
        $parametro = $_GET['b80bb7740288fda1f201890375a60c8f'];
        $pageIndex = 7;
        $isClient = false;
        $producto = Producto::find($parametro);
        $function = 'encontrarTotalColores()';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPrdouct = new Producto($_POST);            
            $newPrdouct->id = $parametro;
            $producto = Producto::find($parametro);
            $alerts = [];
            $newPrdouct->desc = $newPrdouct->convertirTextAJSON($_POST['desc']);
            if (!is_dir(IMAGE_FOLDER)) {
                mkdir(IMAGE_FOLDER);
            }
            if (!empty(array_filter($_FILES['imagen']['tmp_name']))) {
                $imagenesJSON = [];
                $imagenesJSON = json_decode($producto->imagen, true);
                foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
                    if($tmp_name != '') {
                        $image_name = md5( uniqid( rand(), true ) ) . '.jpg';
                        $imagen = Image::make ($tmp_name);
                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/marca/atlantic.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(400, 400);
                        $imagen->insert($marca_de_agua, 'top-right',10,40);
                        //debuguear($_POST['marca']);
                        
                        if($_POST['marca'] != '0') {
                            $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/logos-oscuros/'.$_POST['marca'].'.png';
                            $marca_de_agua = Image::make($ruta_marca_de_agua);
                            $marca_de_agua->resize(560, 560);
                            $imagen->insert($marca_de_agua, 'top-left',20,0);
                        }
                        if($_POST['original'] == '1') {
                            $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/marca/original.png';
                            $marca_de_agua = Image::make($ruta_marca_de_agua);
                            $marca_de_agua->resize(700, 700);
                            $imagen->insert($marca_de_agua, 'bottom-right',10,-100);
                        }
                        
                        if ($imagen->save(IMAGE_FOLDER . $image_name)) {
                            $imagenesJSON[] = $image_name;
                        } else {
                            $alerts[] = 'Error al guardar la imagen ' . $key;
                        }
                    }
                }
                $imagenes = json_encode($imagenesJSON);
                $newPrdouct->imagen = $imagenes;
            } else {
                $newPrdouct->imagen = $producto->imagen;
            }
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
            foreach ($arrayPHP as $value) {
                $imagenJSON = [];
                $encontrado = false;
                $nombre = null;
                $rgb = null;
                foreach ($_FILES['imagenColor_'.$value]['tmp_name'] as $key => $tmp_name) {
                    if(file_exists($tmp_name)) {
                        $image_name = md5(uniqid(rand(), true)) . '.jpg';
                        $imagen = Image::make($tmp_name);
                        $encontrado = true;

                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/marca/atlantic.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(400, 400);
                        $imagen->insert($marca_de_agua, 'top-right',10,40);

                    if($_POST['marca'] != '0') {
                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/logos-oscuros/'.$_POST['marca'].'.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(560, 560);
                        $imagen->insert($marca_de_agua, 'top-left',20,0);
                    }
                    if($_POST['original'] == '1') {
                        $ruta_marca_de_agua = $_SERVER['DOCUMENT_ROOT'] . '/build/img/marca/original.png';
                        $marca_de_agua = Image::make($ruta_marca_de_agua);
                        $marca_de_agua->resize(700, 700);
                        $imagen->insert($marca_de_agua, 'bottom-right',10,-100);
                    }

                        if ($imagen->save(IMAGE_FOLDER . $image_name)) {
                            $imagenJSON[] = $image_name;
                        } else {
                            $alerts[] = 'Error al guardar la imagen ' . $key;
                        }
                        if($_POST['color'][$countImages] != null) {
                            $nombre = $_POST['color'][$countImages];
                            $rgb = $_POST['rgb'][$countImages];
                        }
                        $countImages++;
                    }
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
            $ColoresjsonResult = json_encode($imagenesJSON);
            $newPrdouct->colores = $ColoresjsonResult;
                if (!empty($_POST['imagenesEliminar'])) {
                    $imagenesEliminarArray = json_decode($_POST['imagenesEliminar']);
                    $coloresIndex = explode(',', $_POST['IndexColoresEliminar']);
                    if($imagenesEliminarArray == null) {
                        $imagenesEliminarArray = explode(',',$_POST['imagenesEliminar']);
                    }
                    $colors = json_decode($newPrdouct->colores);
                    foreach ($coloresIndex as $indice) {     
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
                if(empty($alerts)) {
                    $newPrdouct->activo = $producto->activo;
                    //debuguear($newPrdouct);
                    $producto->sync($newPrdouct);
                    $producto->descuento = $_POST['descuento'];
                   //debuguear($newPrdouct);
                    $producto->save();
                    header('Location: /d94a5da526ad85f8e50ca84d4be1defd?b80bb7740288fda1f201890375a60c8f='.$parametro);           
                }
            }
        $categoria = new Categoria();
        $categorias = $categoria->all();
        $newDesc = $producto->restaurarAJSON($producto->desc);
        $textoNormal = '';
        foreach ($newDesc as $linea) {
            $textoNormal .= $linea . "\n";
        }
        $producto->desc = $textoNormal;
        $tallasNormal = $producto->restaurarAJSON($producto->tallas);
        $textoNormal = '';
        $ultimoIndice = count($tallasNormal) - 1;
        foreach ($tallasNormal as $indice => $linea) {
            $textoNormal .= $linea . ($indice === $ultimoIndice ? '' : ",");
        }
        $producto->tallas = $textoNormal;
        $colores = json_decode($producto->colores, true);
        $producto->colores = $colores;
        
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

