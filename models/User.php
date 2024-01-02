<?php

namespace Model;

class User extends ActiveRecord {
    protected static $table = 'empleado';
    protected static $columnsDB = [
    'id',
    'dni',
    'nombre',
    'apellido',
    'fechaInicio',
    'fechaFinal',
    'pass',
    'admin',
    'salario'];
    
    public $id;
    public $dni;
    public $nombre;
    public $apellido;
    public $fechaInicio;
    public $fechaFinal;
    public $pass;
    public $admin;
    public $salario;


    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->dni = $args['dni'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->fechaInicio = $args['fechaInicio'] ?? '';
        $this->fechaFinal = $args['fechaFinal'] ?? '';
        $this->pass = $args['pass'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->salario = $args['salario'] ?? 0;
        

    }
public function validateDni() {
    if(!$this->dni) {
        self::$alerts['error'][] = 'El email es Obligatorio';
    }
    return self::$alerts;
}
    public function validateLogin() {
        if(!$this->dni) {
            self::$alerts['error'][] = 'La cedula es obligatoria';
        }
        if(!$this->pass) {
            self::$alerts['error'][] = 'La contraseña es Obligatoria';
        }
        //debuguear($this);
        return self::$alerts;
    }
    //mensajes de validacion
    public function validateNewAccount()
    {
        if(!$this->nombre) {
            self::$alerts['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido) {
            self::$alerts['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->dni) {
            self::$alerts['error'][] = 'La cédula es obligatoria';
        }
        if(!$this->pass) {
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }
        if (!$this->fechaFinal) {
            self::$alerts[] = 'La fecha de finalización es obligatoria'; 
        }
        if (!$this->fechaInicio) {
            self::$alerts[] = 'La fecha de inicio es obligatoria'; 
        }
        if(strlen($this->pass) < 6) {
            self::$alerts['error'][] = 'Minimo 7 carácteres en la contraseña';
        }
        return self::$alerts;
    }

    //revisa si usuario existe
    public function userReadyExists() {
        $query = "SELECT * FROM " . self::$table . " WHERE dni = '" . $this->dni. "' LIMIT 1";
        $solved = self::$db->query($query);
        if($solved->num_rows) {
            self::$alerts['error'][] = 'El empleado ya existe';
        }
        return $solved;
    }
    public function hashPassword() {
        $this->pass = password_hash($this->pass, PASSWORD_BCRYPT);
    }
    
    public function checkValidateUser($pass) {
        $result = password_verify($this->pass,$pass);
       // debuguear($result);
        if(!$result) {
            return $result;
            self::$alerts['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }
    public function validateNewPass() {
        
        if(!$this->pass) {
            self::$alerts['error'][] = 'El password es obligatorio';
        }
        if(strlen($this->pass) < 6) {
            self::$alerts['error'][] = 'Minimo 7 carácteres en la contraseña';
        }
        return self::$alerts;
    }
    
    

}
