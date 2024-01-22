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

       // debuguear($pagina);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
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
            $alerts = $producto->validateProduct($_POST,$_FILES['imagenColor']['tmp_name'],$_FILES['imagen']['tmp_name']);
            //debuguear($_POST);
            if(empty($alerts)) {
                $producto->sync($_POST);
                $alerts = [];
                $producto->desc = $producto->convertirTextAJSON($_POST['desc']);
                if (!is_dir(IMAGE_FOLDER)) {
                    mkdir(IMAGE_FOLDER);
                }
                $image_name = md5( uniqid( rand(), true ) ) . '.jpg';
                $imagen = Image::make ($_FILES['imagen']['tmp_name'])->fit(400,540);
                $producto->setImage($image_name);
                $imagen->save(IMAGE_FOLDER.$image_name);
                $tallasArray = explode(',', $_POST['tallas']);
                $tallasJson = json_encode($tallasArray);
                $producto->tallas = $tallasJson;
                $countImages = 0;
                $imagenesJSON = [];
                $nombre = '';
                $rgb = '';
                foreach ($_FILES['imagenColor']['tmp_name'] as $key => $tmp_name) {
                    $image_name = md5(uniqid(rand(), true)) . '.jpg';

                    $imagen = Image::make($tmp_name)->fit(400, 540);
                    $nombre = $_POST['color'][$countImages];
                    $rgb = $_POST['rgb'][$countImages];
                    
                    $countImages++;
                    // Guardar la imagen
                    if ($imagen->save(IMAGE_FOLDER . $image_name)) {
                        // Asignar el nombre de la imagen al producto o almacenar en un array si es necesario
                        // Almacenar información relevante en el array $imagenesJSON
                        $imagenesJSON[] = [
                            'rgb' => $rgb,
                            'color' => $nombre,
                            'imagen' => $image_name
                        ];
                        //  $producto->addImage($image_name);--------
                    } else {
                        // Manejar el caso en el que no se pudo guardar la imagen
                        $alerts[] = 'Error al guardar la imagen ' . $key;
                    }
                }
                
                $ColoresjsonResult = json_encode($imagenesJSON);
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
        
        //debuguear($producto);
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //$newPrdoucto->sync($_POST);
            $newPrdouct = new Producto($_POST);
            $alerts = $newPrdouct->validateOldProduct($_POST,$_FILES['imagenColor']['tmp_name'],$_FILES['imagen']['tmp_name']);
            $newPrdouct->id = $parametro;
            $producto = Producto::find($parametro);
            $alerts = [];
            $newPrdouct->desc = $newPrdouct->convertirTextAJSON($_POST['desc']);
            //$descJsonRestored = $producto->restaurarAJSON($descJson);
            
           
            if (!is_dir(IMAGE_FOLDER)) {
                mkdir(IMAGE_FOLDER);
            }
            
            $image_name = md5( uniqid( rand(), true ) ) . '.jpg';
            //debuguear($_FILES['image']['tmp_name']);
            if(!empty($_FILES['imagen']['tmp_name'])) {
                if ($_FILES['imagen']['tmp_name']) {
                    $imagen = Image::make ($_FILES['imagen']['tmp_name'])->fit(400,540);
                    //AQUI SE TIENE QUE ELIMINAR LA IMAGEN VIEJA
                    $producto->deleteImage($producto->imagen);
                    $newPrdouct->imagen = $image_name;
                    //debuguear($producto);
                }
                
                if(empty($alerts)) {
                    if ($_FILES['imagen']['tmp_name']) {
                        $imagen->save(IMAGE_FOLDER.$image_name);
                    }
                }
            } else {
                $newPrdouct->imagen = $producto->imagen;
            }
            

            
            $tallasArray = explode(',', $_POST['tallas']);
            
            $tallasJson = json_encode($tallasArray);
            $newPrdouct->tallas = $tallasJson;
            
            
            $countImages = 0;
            $imagenesJSON = [];
            $nombre = '';
            $rgb = '';
            // Verificar si se cargaron archivos de imagen
            //debuguear(empty($_FILES['imagenColor']['tmp_name']));
            //debuguear(array_filter($_FILES['imagenColor']['tmp_name']));
            if (!empty($_FILES['imagenColor']['tmp_name'])) {
                
                // Iterar sobre cada archivo de imagen
                foreach ($_FILES['imagenColor']['tmp_name'] as $key => $tmp_name) {
                    
                    // Generar un nombre único para la imagen
                    
                    $image_name = md5(uniqid(rand(), true)) . '.jpg';

                    // Intentar cargar la imagen
                    $imagen = Image::make($tmp_name)->fit(400, 540);
                    $nombre = $_POST['color'][$countImages];
                    $rgb = $_POST['rgb'][$countImages];

                    //debuguear($_POST['rgb']);
                    //debuguear($_POST['rgb'][$countImages]);
                    $countImages++;
                    // Guardar la imagen
                    if ($imagen->save(IMAGE_FOLDER . $image_name)) {
                        // Asignar el nombre de la imagen al producto o almacenar en un array si es necesario
                        // Almacenar información relevante en el array $imagenesJSON
                        $imagenesJSON[] = [
                            'rgb' => $rgb,
                            'color' => $nombre,
                            'imagen' => $image_name
                        ];
                        
                        //  $producto->addImage($image_name);--------
                    } else {
                        // Manejar el caso en el que no se pudo guardar la imagen
                        $alerts[] = 'Error al guardar la imagen ' . $key;
                    }
                }
            } else {
                
            }
            $ColoresjsonResult = json_encode($imagenesJSON);
            $newPrdouct->colores = $ColoresjsonResult;
            
            
            
            
            
            $coloresArray = json_decode($producto->colores, true); // Convertir a array
            $nuevosColoresArray = json_decode($ColoresjsonResult, true); // Convertir a array
            
            // Combinar los arrays
            $coloresCombinados = array_merge($coloresArray, $nuevosColoresArray);
            
            // Convertir el array combinado de nuevo a JSON y asignarlo a $newProduct->colores
            $newPrdouct->colores = json_encode($coloresCombinados);
            //debuguear($ColoresjsonResult);
            //debuguear($newPrdouct->colores);
            if (!empty($_POST['imagenesEliminar'])) {
                $imagenesEliminarArray = explode(",", $_POST['imagenesEliminar']);
            
                // Decodificar el JSON en un array
                $coloresArray = json_decode($newPrdouct->colores, true);
            
                // Iterar sobre los elementos del array
                foreach ($coloresArray as $indice => $color) {
                    // Verificar si la imagen del color actual está en el array de imágenes a eliminar
                    if (in_array($color['imagen'], $imagenesEliminarArray)) {
                        // Eliminar la imagen utilizando tu lógica (por ejemplo, la función deleteImage)
                        // Eliminar el color del array
                        unset($coloresArray[$indice]);
                        $producto->deleteImage($color['imagen']);
            
                    }
                }
            
                // Codificar de nuevo el array en formato JSON y actualizar la variable $producto->colores
                $newPrdouct->colores = json_encode(array_values($coloresArray));
            }
            
            //  debuguear($newPrdouct);
            $alerts = $newPrdouct->validateNewProduct();
            //debuguear($_POST['imagenesEliminar']);
            if(empty($alerts)) {
                $producto->sync($newPrdouct);
                //debuguear($producto);
                $producto->save();
                header('Location: /d94a5da526ad85f8e50ca84d4be1defd?b80bb7740288fda1f201890375a60c8f='.$parametro);
               // debuguear($producto);            
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

