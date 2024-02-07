<div class="form-container-admin">
<div class="form-container-admin-1">
    <h1 class="name-page" style="color:black;">AGREGAR PRODUCTO</h1>
    <p class="description-page" style="color:black;">Llena el siguiente Formulario para Agregar</p>

    <?php 
        include_once __DIR__ . "/../templates/alerts.php";
    ?>
    

    <form class="form" method='POST' enctype="multipart/form-data">

    <div class="slot">
        <label for="titulo">Título</label>
        <input
            type="text"
            id="titulo"
            name="titulo"
            placeholder="Título del producto"
            value=""
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
            value=""
            step="1"
            maxlength="10"
        />
    </div>

    <div class="slot">
        <label for="category">Categoría</label>
        <select id="category" name="category">
            <?php foreach ($categorias as $categoria): ?>
                <?php if($categoria->id == '0') { ?>
                    <option value="-1">-- Seleccionar --</option>
                <?php } else { ?>
                    <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>

                <?php }?>

            <?php endforeach; ?>
        </select>
    </div>
    <div class="slot">
    <label for="genero">Genero</label>
        <select name="genero" class="select-genero" value="0" id="">
            <option value="0">Hombre</option>
            <option value="1">Mujer</option>
            <option value="2">Unisex</option>
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
        ></textarea>
    </div>

    <div class="slot">
        <label for="shortDesc">Descripción Corta</label>
        <input
            type="text"
            id="shortDesc"
            name="shortDesc"
            placeholder="Descripción corta del producto"
            value=""
            maxlength="500"
        />
    </div>

    <div class="slot">
        <label for="imagen">Imagen Principal</label>
        <input
            type="file"
            id="imagen"
            name="imagen[]"
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
            value=""
            maxlength="32"
        />
    </div>

    <div class="slot">
        <label for="cantidad">Cantidad</label>
        <input
            type="number"
            id="cantidad"
            name="cantidad"
            placeholder="Cantidad del producto"
            value=""
        />
    </div>

    <div class="slot">
        <label for="tallas">Tallas</label>
        <input
            type="text"
            id="tallas"
            name="tallas"
            placeholder="Tallas del producto"
            value=""
        />
    </div>

    <input type="hidden" id="cantColores" value="1">
    <div class="slot">
        <label for="colores">Colores (JSON)<button onclick="agregarColor(event)" style="background-color:transparent;border:none;">+</button></label>
        <div id="colores-contenedor">
            <div id="c-0" class="slot" style="background-color: #eaeaea;padding:1rem;margin: 1rem 0 0 0;">
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
            </div>
        </div>
        <input type="hidden" id="colorFileCount" value="0" name="colorFileCount">
                
    

    <div class="slot" style="display: flex;align-items:center;">
    <label for="new" style="flex: 0 0 6.5rem;">¿Producto Nuevo?</label>
    <input
        type="checkbox"
        value="0"
        style="flex:none;width: auto !important;"
        onchange="handleCheckboxChange(this,'new')"
        />
        <input type="hidden" value="0" id="new" name="new">
    </div>
    
    
    <div class="slot" style="display: flex;align-items:center;">
        <label for="aurum" style="flex: 0 0 6.5rem;">¿Producto Aurum?</label>
        <input
            type="checkbox"
            value="0"
            style="flex:none;width: auto !important;"
            onchange="handleCheckboxChange(this,'aurum')"
        />
        <input type="hidden" value="0" id="aurum" name="aurum">
    </div>


    

    <input type="submit" value="Agregar" class="button" style="width: 100%;">

</form>

    <a class="button" style="color:white !important;width:100%;margin:0;" href="/286e18ee6617beaf7cfd0cb74b4b7824">Volver</a>
    <br>
</div>
</div>


<script>
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
