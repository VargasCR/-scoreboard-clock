<?php
namespace Model;
class ImgPopUp extends ActiveRecord {
    // Base de Datos
    protected static $table = 'popup';
    protected static $columnsDB= ['id','name','index'];
    public $id;
    public $name;
    public $index;

    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->name = $args['name'] ?? '';
        $this->name = $args['index'] ?? '';
    }
}