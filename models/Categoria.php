<?php
namespace Model;
class Categoria extends ActiveRecord {
    // Base de Datos
    protected static $table = 'categoria';
    protected static $columnsDB= ['id','nombre'];
    public $id;
    public $nombre;

    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->nombre = $args['nombre'] ?? '';
    }
}