<?php
namespace Model;
class Categoriaa extends ActiveRecord {
    // Base de Datos
    protected static $table = 'categorias_a';
    protected static $columnsDB= ['id','nombre'];
    public $id;
    public $nombre;

    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->nombre = $args['nombre'] ?? '';
    }
}