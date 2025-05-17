<?php
namespace Model;
class DiscountCode extends ActiveRecord {
    // Base de Datos
    protected static $table = 'discount_code';
    protected static $columnsDB= ['id',
    'code',
    'activado',
    'activado',
    'descuento'];
    public $id;
    public $code;
    public $email;
    public $descuento;
    public $activado;

    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->code = $args['code'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->descuento = $args['descuento'] ?? '';
        $this->activado = $args['activado'] ?? '';
    }
    
}