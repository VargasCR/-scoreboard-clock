<?php
namespace Model;
class Categoria extends ActiveRecord {
    // Base de Datos
    protected static $table = 'categoria';
    protected static $columnsDB= ['id','nombre','genero','aurum'];
    public $id;
    public $nombre;
    public $genero;
    public $aurum;

    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->nombre = $args['nombre'] ?? '';
        $this->genero = $args['genero'] ?? '2';
        $this->aurum = $args['aurum'] ?? '0';
    }
}