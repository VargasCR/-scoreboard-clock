<?php
namespace Model;

class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $table = '';
    protected static $columnsDB = [];

    // Alertas y Mensajes
    protected static $alerts = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }
    public function createToken() {
        $this->token = uniqid();
    }
    public static function setAlert($tipe, $message) {
        static::$alerts[$tipe][] = $message;
    }

    // Validación
    public static function getAlert() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function querySQL($query) {
        // Consultar la base de datos
        $result = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registry = $result->fetch_assoc()) {
            $array[] = static::createObjet($registry);
        }

        // liberar la memoria
        $result->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function createObjet($registry) {
        $objet = new static;

        foreach($registry as $key => $value ) {
            if(property_exists( $objet, $key  )) {
                $objet->$key = $value;
            }
        }

        return $objet;
    }

    // Identificar y unir los atributos de la BD
    public function property() {
        $property = [];
        foreach(static::$columnsDB as $column) {
            if($column === 'id') continue;
            $property[$column] = $this->$column;
        }
        return $property;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizeProperty() {
        $property = $this->property();
        $sanitize = [];
        foreach($property as $key => $value ) {
            $sanitize[$key] = self::$db->escape_string($value);
        }
        return $sanitize;
    }

    // Sincroniza BD con Objetos en memoria
    public function sync($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function save() {
        //debuguear($this);
        $result = '';
        if(!is_null($this->id)) {
            // actualizar
            
            $result = $this->update();
        } else {
            // Creando un nuevo registro
            $result = $this->create();
        }
        return $result;
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        //debuguear($query);
        $result = self::querySQL($query);
        return $result;
    }
    public static function findProductWord($palabra,$genero) {
        $query = "SELECT * FROM " . static::$table." WHERE 
        (`titulo` LIKE '%".$palabra."%' OR 
        `shortDesc` LIKE '%".$palabra."%' OR 
        `desc` LIKE '%".$palabra."%' OR 
        CAST(precio AS CHAR) LIKE '%".$palabra."%') AND `activo` = 1 AND `genero` = ".$genero."";
        $result = self::querySQL($query);
        return $result;
    }
    
    public static function counter() {
        //$query = "SELECT COUNT(*) as 'total' FROM " . static::$table.";";
        $query = "SELECT * FROM " . static::$table.";";
        $result = self::querySQL($query);
        //debuguear($result);
        return count($result);
    }


    public static function allFromPage($page = 1, $perPage = 10) {
        // Asegurarse de que el número de página y los resultados por página sean valores positivos
        $page = max(1, $page);
        $perPage = max(1, $perPage);

        // Calcular el punto de inicio basado en la página actual y la cantidad de resultados por página
        $offset = ($page - 1) * $perPage;

        // Construir la consulta SQL con la cláusula LIMIT y OFFSET
        $query = "SELECT * FROM " . static::$table . " ORDER BY id DESC LIMIT $perPage OFFSET $offset";

        
        // Ejecutar la consulta SQL
        $result = self::querySQL($query);

        return $result;
    }

    
    public static function findTimes($id, $fechaDesde, $fechaHasta) {
        $query = "SELECT * FROM " . static::$table . " WHERE idempleado = $id AND fechaEntrada BETWEEN '$fechaDesde' AND '$fechaHasta' AND fechaSalida != '2000-01-01';";
        $result = self::querySQL($query);
        return $result;
    }
    





    public static function findTodayDate($id,$date) {
        $query = "SELECT * FROM " . static::$table . " WHERE idempleado = " . $id . "  && fechaEntrada = '".$date."' LIMIT 1;";
        $result = self::querySQL($query);
       // debuguear(array_shift( $result ));
        return array_shift( $result );
    }
    public static function findDate($id,$date) {
        $query = "SELECT * FROM " . static::$table . " WHERE idempleado = " . $id . "  && fechaSalida = '2000-01-01' LIMIT 1;";
        $result = self::querySQL($query);
       // debuguear(array_shift( $result ));
        return array_shift( $result );
    }



    public static function deleteAllWhere($column,$value) {
        $query = "DELETE FROM " . static::$table . " WHERE $column = $value";
        self::$db->query($query);
        return true;
    }
/* 
0 new products
1 all products
2 aurum products
*/
/* 
0 new products
1 all products
2 aurum products
*/
    public static function findAllWhere($column,$value) {
        $query = "SELECT * FROM " . static::$table . " WHERE $column = $value OR genero = '2'";
        $result = self::querySQL($query);
        return $result;
    }
    public static function findAllEmployesWhere($column,$value) {
        $query = "SELECT * FROM " . static::$table . " WHERE $column = $value";
        $result = self::querySQL($query);
        return $result;
    }

    public static function findAllWhereA($column,$value) {

        $query = "SELECT * FROM " . static::$table . " WHERE $column = $value";
        $result = self::querySQL($query);
        return $result;
    }
    public static function findAllCatWhere($column,$value) {

        $query = "SELECT * FROM " . static::$table . " WHERE $column = $value OR id = '0'";
        $result = self::querySQL($query);
        return $result;
    }
    public static function findAllWhereAND($column1,$value1,$column2,$value2) {
        $query = "SELECT * FROM " . static::$table . " WHERE $column1 = $value1 && $column2 = $value2 OR genero = '2'";
       // debuguear($query);
        $result = self::querySQL($query);

        return $result;
    }
    public static function findAllWhereANDAND($column1,$value1,$column2,$value2,$column3,$value3) {
        $query = "SELECT * FROM " . static::$table . " WHERE $column1 = $value1 && $column2 = $value2 && $column3 = $value3 OR genero = '2'";
       // debuguear($query);
        $result = self::querySQL($query);

        return $result;
    }
    public static function findAllWhereAAND($column1,$value1,$column2,$value2) {
        $query = "SELECT * FROM " . static::$table . " WHERE $column1 = $value1 && $column2 = $value2";
       // debuguear($query);
        $result = self::querySQL($query);

        return $result;
    }
    public static function findAllWhereOR($column1,$value1,$column2,$value2) {
        $query = "SELECT * FROM " . static::$table . " WHERE $column1 = $value1 OR $column2 = $value2";
        //debuguear($query);
        $result = self::querySQL($query);

        return $result;
    }
    
    public function deleteIN($column,$value) {
        $query = "DELETE FROM " . static::$table . " WHERE $column IN($value)";
        //self::$db->query($query);
        self::$db->query($query);
        return true;
    }
    public function deleteService($value) {
        $query = "";
        $query = "DELETE FROM images WHERE serviceid = '$value';";
        self::$db->query($query);
        $query = "DELETE FROM tags WHERE serviceid = '$value'; ";
        self::$db->query($query);
        $query = "DELETE FROM services WHERE id = '$value';";
        self::$db->query($query);
        return true;
        //debuguear($query);
    }
    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = $id";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }
    public static function findIn($column, $value) {
        $query = "SELECT * FROM " . static::$table  ." WHERE $column IN ($value)";
        //debuguear($query);
        $result = self::querySQL($query);
        return $result;
    }

    public static function findmytags($id){
        $query = "SELECT name FROM tags WHERE serviceid = '$id'";
        
        $result = self::querySQL($query);
        return $result;
    }
    public static function findmypicture($id){
        $query = "SELECT * FROM images WHERE serviceid = '$id'";
        $result = self::querySQL($query);
        return $result;
    }
    // Busca un registro por su id
    public static function where($column, $value) {
       // $query = "SELECT * FROM " . static::$table  ." WHERE $column = '$value'";
        $query = "SELECT * FROM " . static::$table  ." WHERE $column = '$value'";
        
        $result = self::querySQL($query);
        return array_shift( $result );
    }

    

    public static function adminGetAll($code) {
        if ($code === 'codeToGet') {
            // $query = "SELECT * FROM " . static::$table  ." WHERE $column = '$value'";
            $query = "SELECT * FROM services WHERE verified IS NULL";
            
            $result = self::querySQL($query);
            
            return $result ;
        }
    }
    public static function findAllAppointments($query) {
        $result = self::querySQL($query);
        //debuguear($result);
        return $result;
    }
    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$table ." WHERE verified = '1' ORDER BY id DESC LIMIT " . $limite;//desc";
        $result = self::querySQL($query);
        return $result;
    }

    // crea un nuevo registro
    public function create() {
        // Sanitizar los datos
        $property = $this->sanitizeProperty();
        //INSERT INTO `atlantic_employes`.`empleado` (`dni`, `nombre`, `apellido`, `fechaInicio`, `fechaFinal`, `pass`, `admin`) VALUES ('207460889', 'Javier', 'Vargas', '2023-12-28', '2023-12-31', '$2y$10$251NtURafzzA94CBpWcsp.VEDcpRx/dJtciXsiutOg5Fly.T6UU/y', '0');
        // Insertar en la base de datos
        // Build the SQL query
    $columns = array_map(function ($column) {
        return "`$column`";
    }, array_keys($property));

    $query = "INSERT INTO " . static::$table . " (";
    $query .= implode(', ', $columns);
    $query .= ") VALUES ('";
    $query .= implode("', '", array_values($property));
    $query .= "')";
        //debuguear($query);
        // Resultado de la consulta
        $result = self::$db->query($query);
        return [
           'result' =>  $result,
           'id' => self::$db->insert_id
        ];
    }
    
    
    public function updateSession() {
        $_SESSION['id'] = $this->id;
        $_SESSION['dni'] = $this->dni;
    }
    // Actualizar el registro
    public function update() {
        // Sanitizar los datos
        $property = $this->sanitizeProperty();
        // Iterar para ir agregando cada campo de la BD
        $values = [];
        foreach($property as $key => $value) {
            $values[] = "`{$key}`='{$value}'";
        }
        //debuguear($property);
        // Consulta SQL
        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

       // debuguear($query);
        // Actualizar BD
        $result = self::$db->query($query);
        return $result;
    }
    public function setImage($image){
        if( !is_null($this->id)) {
            $this->deleteImage();
        }
        if ($image) {
            $this->imagen = $image;
        }
    }

    public function deleteImage($imagen) {
        $isPicture = file_exists(IMAGE_FOLDER . $imagen);
            if($isPicture) {
                unlink(IMAGE_FOLDER . $imagen);
            }
    }

    // Eliminar un Registro por su ID
    public function delete() {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }
    public function validateSetAccount()
    {
        
        if(!$this->name) {
            self::$alerts['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->lastName) {
            self::$alerts['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->tel) {
            self::$alerts['error'][] = 'El telefono es obligatorio';
        }
        if(!$this->pass) {
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }
        
        
        return self::$alerts;
    }
    public static function findPublicServices($where) {
        $query = "SELECT id,categoryid,title,provincia,canton,distrito,direccion,description,email,tel,created,rating,book_url,price FROM " . static::$table . " WHERE " . $where . " ORDER BY id DESC;";//description LIKE '%Anuncio prueba 1%' AND categoryid > 0;";
        $result = self::querySQL($query);
        
        return$result;
    }





    public function restaurarAJSON($jsonResult) {
        // Restaurar el JSON a un array
        $arrayRestaurado = json_decode($jsonResult, true);

        return $arrayRestaurado;
    }

    public function convertirTextAJSON($texto) {
        // Dividir el texto en líneas
        $lineas = explode("\n", $texto);

        // Crear un array para almacenar la información
        $informacion = [];

        // Analizar cada línea y extraer la información
        foreach ($lineas as $linea) {
            $linea = trim($linea);
            if (!empty($linea)) {
                $informacion[] = $linea;
            }
        }

        // Convertir el array en formato JSON
        $jsonResult = json_encode($informacion, JSON_PRETTY_PRINT);

        return $jsonResult;
    }
    public static function findCode($code) {
        $query = "SELECT * FROM " . static::$table . " WHERE code = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        // Manejo de resultados
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        return $rows;
    }
}