<?php
namespace Model;
class Registro extends ActiveRecord {
    // Base de Datos
    protected static $table = 'registro';
    protected static $columnsDB= ['id','idempleado','fechaEntrada','fechaSalida','horaSalida','horaEntrada','horasExtra'];
    public $id;
    public $idempleado;
    public $fechaEntrada;
    public $fechaSalida;
    public $horaEntrada;
    public $horaSalida;
    public $horasExtra;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->idempleado = $args['idempleado'] ?? '';       
        $this->fechaEntrada = $args['fechaEntrada'] ?? '';       
        $this->fechaSalida = $args['fechaSalida'] ?? '';       
        $this->horaEntrada = $args['horaEntrada'] ?? '';       
        $this->horaSalida = $args['horaSalida'] ?? '';       
        $this->horasExtra = $args['horasExtra'] ?? 0;
 
    }
}