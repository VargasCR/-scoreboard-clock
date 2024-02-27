<?php
namespace Model;
class Producto extends ActiveRecord {
    // Base de Datos
    protected static $table = 'producto';
    protected static $columnsDB= [
        'id',
        'titulo',
        'precio',
        'desc',
        'shortDesc',
        'imagen',
        'category',
        'codigo',
        'tallas',
        'colores',
        'new',
        'aurum',
        'cantidad',
        'genero','original','marca','activo','descuento'
    ];
    public $id;
    public $titulo;
    public $precio;
    public $desc;
    public $shortDesc;
    public $imagen;
    public $category;
    public $codigo;
    public $tallas;
    public $colores;
    public $new;
    public $aurum;
    public $cantidad;
    public $genero;
    public $original;
    public $marca;
    public $activo;
    public $descuento;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->titulo = $args['titulo'] ?? '';       
        $this->precio = $args['precio'] ?? '';       
        $this->desc = $args['desc'] ?? '';       
        $this->shortDesc = $args['shortDesc'] ?? '';       
        $this->imagen = $args['imagen'] ?? '';       
        $this->category = $args['category'] ?? '';       
        $this->codigo = $args['codigo'] ?? '';       
        $this->tallas = $args['tallas'] ?? '';       
        $this->colores = $args['colores'] ?? '';       
        $this->new = $args['new'] ?? '';       
        $this->aurum = $args['aurum'] ?? '';       
        $this->cantidad = $args['cantidad'] ?? '';       
        $this->genero = $args['genero'] ?? '2';       
        $this->original = $args['original'] ?? '0';       
        $this->marca = $args['marca'] ?? '0';     
        $this->activo = $args['activo'] ?? '0';
        $this->descuento = $args['descuento'] ?? '0';
    }

    public function validateNewProduct($product)
    {
        
        if(!$this->titulo) {
            self::$alerts['error'][] = 'El titulo es obligatorio';
        }
        if(!$this->precio) {
            self::$alerts['error'][] = 'El precio es obligatorio';
        }
        if(!$this->desc) {
            self::$alerts['error'][] = 'La descripción es obligatoria';
        }
        if(!$this->shortDesc) {
            self::$alerts['error'][] = 'La descripción corta es obligatoria';
        }
        if(!$this->imagen) {
           // self::$alerts['error'][] = 'La imagen es obligatoria es obligatoria';
        }
        if($this->category == '-1') {
            self::$alerts['error'][] = 'La categoría es obligatoria';
        }
        if(!$this->codigo) {
            self::$alerts['error'][] = 'El codigo es obligatorio';
        }
        if(!$this->tallas) {
            self::$alerts['error'][] = 'Las tallas son obligatorias';
        }
        if(!$this->colores) {
            self::$alerts['error'][] = 'Los colores son obligatorios';
        }
        if(!$this->cantidad) {
            self::$alerts['error'][] = 'La cantidad es obligatoria';
        }
        
        return self::$alerts;
    }

    public function validateProduct($product,$FILES,$imgPrincipal,$colorFileCountArray)
    {
        foreach ($colorFileCountArray as $value => $key) {
            foreach ($FILES['imagenColor_'.$value]['tmp_name'] as $key => $tmp_name) {
                if($tmp_name == "") {
                    
                        self::$alerts['error'][] = 'Imagen de color faltante';
                    
                }
                //debuguear($tmp_name);
            }
        }
        //debuguear(self::$alerts);
        if(!$product['titulo']) {
            self::$alerts['error'][] = 'El titulo es obligatorio';
        }

       

        if(!$product['precio']) {
            self::$alerts['error'][] = 'El precio es obligatorio';
        }
        
        if(!$product['desc']) {
            self::$alerts['error'][] = 'La descripción es obligatoria';
        }
        if(!$product['shortDesc']) {
            self::$alerts['error'][] = 'La descripción corta es obligatoria';
        }
        
       // if(!$this->imagen) {
           // self::$alerts['error'][] = 'La imagen es obligatoria es obligatoria';
       // }
        if($product['category'] == '-1') {
            self::$alerts['error'][] = 'La categoría es obligatoria';
        }
        if(!$product['codigo']) {
            self::$alerts['error'][] = 'El codigo es obligatorio';
        }
        
        if(!$imgPrincipal) {
            self::$alerts['error'][] = 'Las imagen principal es obligatoria';
        }
        if(!$product['tallas']) {
            self::$alerts['error'][] = 'Las tallas son obligatorias';
        }
        
        foreach ($product['color'] as $value) {
            if(!$value) {
                self::$alerts['error'][] = 'Complete el nombre de los colores';
                break;
            }
        }
        foreach ($product['rgb'] as $value) {
            if(!$value) {
                self::$alerts['error'][] = 'Complete el codigo hex de los colores';
                break;
            }
        }
        foreach ($imgColor as $value) {
            if(!$value) {
                self::$alerts['error'][] = 'Seleccione las imagenes de los colores';
                break;
            }
        }
        
       // if(!$product->colores) {
       //     self::$alerts['error'][] = 'Los colores son obligatorios';
       // }
        if(!$product['cantidad']) {
            self::$alerts['error'][] = 'La cantidad es obligatoria';
        }
        //debuguear(self::$alerts);
       // debuguear($product['color']);
       //debuguear(self::$alerts);
        return self::$alerts;
    }
    public function validateOldProduct($product,$imgColor,$imgPrincipal) {
        if(!$product->titulo) {
            self::$alerts['error'][] = 'El titulo es obligatorio';
        }

        if(!$product->precio) {
            self::$alerts['error'][] = 'El precio es obligatorio';
        }
        if(!$this->desc) {
            self::$alerts['error'][] = 'La descripción es obligatoria';
        }
        if(!$this->shortDesc) {
            self::$alerts['error'][] = 'La descripción corta es obligatoria';
        }

        if($product->category == '-1') {
            self::$alerts['error'][] = 'La categoría es obligatoria';
        }
        if(!$product->codigo) {
            self::$alerts['error'][] = 'El codigo es obligatorio';
        }
        
        if(!$product->tallas) {
            self::$alerts['error'][] = 'Las tallas son obligatorias';
        }
       
        if(!$product->cantidad) {
            self::$alerts['error'][] = 'La cantidad es obligatoria';
        }
        
        return self::$alerts;
    }
}