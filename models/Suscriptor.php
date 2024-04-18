<?php
namespace Model;
class Suscriptor extends ActiveRecord {
    // Base de Datos
    protected static $table = 'suscriptor';
    protected static $columnsDB= ['id','email'];
    public $id;
    public $email;

    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->email = $args['email'] ?? '';
    }
}