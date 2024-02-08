
<div class="form-container-admin">
<div class="form-container-admin-1">
    <h1 class="name-page" style="color:black;">EDITAR PRODUCTO</h1>
    <p class="description-page" style="color:black;">Llena el siguiente Formulario para Editar</p>

    <?php 
        include_once __DIR__ . "/../templates/alerts.php";
    ?>
    
    <form class="form" method='POST' enctype="multipart/form-data">
        <input type="hidden" id="productID" value="<?php echo $producto->id; ?>">
        <div class="slot">
            <label for="titulo">Título</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                placeholder="Título del producto"
                value="<?php echo $producto->titulo; ?>"
                maxlength="120"
            />
        </div>

        <div class="slot">
            <label for="precio">Precio</label>
            <input
                type="number"
                id="precio"
                name="precio"
                placeholder="Precio del producto"
                value="<?php echo $producto->precio; ?>"
                step="1"
                maxlength="10"
            />
        </div>
        <div class="slot">
    <label for="genero">Genero</label>
        <select name="genero" class="select-genero" value="<?php echo $producto->genero; ?>" id="">
            <option value="0" <?php if($producto->genero == '0') { echo 'selected';}?>>Hombre</option>
            <option value="1"<?php if($producto->genero == '1') { echo 'selected';}?>>Mujer</option>
            <option value="2"<?php if($producto->genero == '2') { echo 'selected';}?>>Unisex</option>
        </select>
    </div>
        <div class="slot">
    <label for="category">Categoría</label>
    <select id="category" name="category">
        <?php foreach ($categorias as $categoria): ?>
            <?php if ($categoria->id == '0'): ?>
                <option value="-1" <?php echo ($producto->category == -1) ? 'selected' : ''; ?>>-- Seleccionar --</option>
            <?php else: ?>
                <option value="<?php echo $categoria->id; ?>" <?php echo ($producto->category == $categoria->id) ? 'selected' : ''; ?>>
                    <?php echo $categoria->nombre; ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
</div>


        <div class="slot">
            <label for="desc">Descripción (JSON)</label>
            <textarea
                type="text"
                id="desc"
                name="desc"
                placeholder=''
                value=""
            ><?php echo $producto->desc; ?></textarea>
        </div>

        <div class="slot">
            <label for="shortDesc">Descripción Corta</label>
            <input
                type="text"
                id="shortDesc"
                name="shortDesc"
                placeholder="Descripción corta del producto"
                value="<?php echo $producto->shortDesc; ?>"
                maxlength="500"
            />
        </div>

        <?php 
            $imagenes = json_decode($producto->imagen, true);

            foreach ($imagenes as $indice => $item) { ?>
                <div id="cp-<?php echo $indice; ?>" class="slot" style="text-align: center; background-color: #eaeaea; padding: 1rem; margin: 1rem 0 0 0;">
                    <div style='width: 100%; text-align: right;'>
                        <button type="button" onclick="eliminarPrincipalEditSlot('<?php echo 'cp-'.$indice; ?>', '<?php echo $item; ?>', event)" style="margin: 0.5rem 0px 0px;">X</button>
                    </div>
                    <img width="100px" src="/images/<?php echo $item; ?>" alt="">
                </div>
            <?php } ?>

        <div class='slot'>
            <label for='imagen'>Imagen Principal</label>
            <input
                type='file'
                id='imagen'
                name='imagen[]'
                accept="image/*"
            multiple
            />
        </div>
        


        <div class="slot">
            <label for="codigo">Código</label>
            <input
                type="text"
                id="codigo"
                name="codigo"
                placeholder="Código del producto"
                value="<?php echo $producto->codigo; ?>"
            />
        </div>

        <div class="slot">
            <label for="cantidad">Cantidad</label>
            <input
                type="number"
                id="cantidad"
                name="cantidad"
                placeholder="Cantidad del producto"
                value="<?php echo $producto->cantidad; ?>"
            />
        </div>

        <div class="slot">
            <label for="tallas">Tallas</label>
            <input
                type="text"
                id="tallas"
                name="tallas"
                placeholder="Tallas del producto"
                value="<?php echo $producto->tallas; ?>"
            />
        </div>

        <input type="hidden" id="cantColores" value="<?php echo count($producto->colores)-1; ?>">
        <input type="hidden" id="imagenesEliminar" name="imagenesEliminar" value="">
        <input type="hidden" id="IndexColoresEliminar" name="IndexColoresEliminar" value="">
        <input type="hidden" id="colorFileCount" value="0" name="colorFileCount">
        <div class="slot">
            <label for="colores">Colores (JSON)<button onclick="agregarColor(event)" style="background-color:transparent;border:none;">+</button></label>
            <div id="colores-contenedor">


            <?php 
                if (!empty($producto->colores)) {
                        // Si hay registros, mostrar los colores existentes
                        foreach ($producto->colores as $indice => $color) {
                            
                            $nombreColor = isset($color['color']) ? $color['color'] : '';
                            $rgb = isset($color['rgb']) ? $color['rgb'] : '';
                            $imagen = isset($color['imagen']) ? $color['imagen'] : '';
                            ?>
                                <div id="c-<?php echo $indice; ?>" class="slot" style="background-color: #eaeaea;padding:1rem;margin: 1rem 0 0 0;">
                                <div style="width: 100%; text-align: right;">
                                <?php 
                                // Decodificar la cadena JSON a un array de PHP
                                $arrayPHP = json_decode(json_encode($imagen));

                                // Convertir el array a una cadena de texto usando implode
                                $cadenaTexto = implode(', ', $arrayPHP);
                               // echo $cadenaTexto;
                                ?>
                                    <button onclick="eliminarEditSlot('c-<?php echo $indice; ?>',event,'<?php echo $cadenaTexto;?>',<?php echo $indice; ?>)" style="margin: 0.5rem 0px 0px;">X</button>
                                </div>
                                <label for="tallas">Nombre del color</label>
                                <input disabled type="text" id="color" placeholder="Color del producto" value="<?php echo $nombreColor; ?>" style="margin: 0.5rem 0 0 0;"/>
                                <label for="tallas">Color en formato rgb</label>
                                <input disabled type="text" id="rgb" placeholder="RGB del producto" value="<?php echo $rgb; ?>" style="margin: 0.5rem 0 0 0;"/>
                                <label for="tallas">Imagen del producto</label>
                            
                            <?php

                            //$imagenes = json_decode($imagen, true);
                            
                    foreach ($imagen as $indice => $item) { ?>
                        <div id='cpc-<?php echo $indice; ?>' class='slot' style='display: flex;
                                                        justify-content: center; background-color: #eaeaea; padding: 1rem; margin: 1rem 0 0 0;'>
                           <!-- <div style='width: 100%; text-align: right;'>
                                <button type='button' onclick='eliminarPrincipalEditSlot("cpc-<?php echo $indice;?>","<?php echo $item;?>", event)' style='margin: 0.5rem 0px 0px;'>X</button>
                            </div> -->
                            <img width='100px' src='/images/<?php echo $item;?>' alt='' style='width:50%;display: block;margin: 1rem 0;'>
                        </div>
                    <?php } ?>                            
                            </div>
                       <?php }
                    } else {
                        // Si no hay registros, crear un nuevo color
                        echo '<div id="c-0" class="slot" style="background-color: #eaeaea;padding:1rem;margin: 1rem 0 0 0;">
                        <div style="width: 100%; text-align: right;"><button onclick="eliminarSlot(0,event)" style="margin: 0.5rem 0px 0px;">X</button></div>
                            <label for="tallas">Nombre del color</label>
                            <input
                                type="text"
                                id="color"
                                name="color[]"
                                placeholder="Color del producto"
                                value=""
                                style="margin: 0.5rem 0 0 0;"
                            />
                            <label for="tallas">Color en formato rgb</label>
                            <input
                                type="text"
                                id="rgb"
                                name="rgb[]"
                                placeholder="RGB del producto"
                                value=""
                                style="margin: 0.5rem 0 0 0;"
                            />
                            <label for="tallas">Imagen del producto</label>
                            <input
                                type="file"
                                class="imagenColor"
                                name="imagenColor_0[]"
                                accept="image/*"
                                multiple
                                
                            />
                        </div>
                    </div>';
                        
                    }
                ?>
            </div>
                    
        

        <div class="slot" style="display: flex;align-items:center;">
        <label for="new" style="flex: 0 0 6.5rem;">¿Producto Nuevo?</label>
        <input
            type="checkbox"
            value="0"
            style="flex:none;width: auto !important;"
            onchange="handleCheckboxChange(this,'new')"
            <?php echo $producto->new == 1 ? 'checked' : ''; ?>
            />
            <input type="hidden" value="<?php echo $producto->new; ?>" id="new" name="new">
        </div>
        
        
        <div class="slot" style="display: flex;align-items:center;">
            <label for="aurum" style="flex: 0 0 6.5rem;">¿Producto Aurum?</label>
            <input
                type="checkbox"
                value="0"
                style="flex:none;width: auto !important;"
                onchange="handleCheckboxChange(this,'aurum')"
                <?php echo $producto->aurum == 1 ? 'checked' : ''; ?>
            />
            <input type="hidden" value="<?php echo $producto->aurum; ?>" id="aurum" name="aurum">
        </div>


        

        <input type="submit" value="Guardar" class="button" style="width: 100%;">

    </form>
    <a style="width: 100%;" class="button" type="submit" href="<?php
                if(isset($_SERVER['HTTP_REFERER'])) {
                    echo $_SERVER['HTTP_REFERER'];
                } else {
                    // Si la página anterior no está disponible, redirigir a una página predeterminada
                    echo "/286e18ee6617beaf7cfd0cb74b4b7824";
                }
            ?>">Volver</a>
    <br>
</div>
</div>



<script>
    encontrarTotalColores();
    //conteoDeColores = document.querySelector('#cantColores').value;
    
   
    function handleCheckboxChange(checkbox,ref) {
        // Accede al estado actual del checkbox
        var isChecked = checkbox.checked;
        // Realiza acciones basadas en el estado del checkbox
        if (isChecked) {
            // Checkbox marcado
            document.querySelector('#'+ref).value = 1;
            //alert("Checkbox marcado");
        } else {
            document.querySelector('#'+ref).value = 0;

        }
    }
</script>
