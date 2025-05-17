<div class="form-container-admin">
    <div class="form-container-admin-1">
        <h1 class="name-page" style="color:black;">AGREGAR OFERTA</h1>
        <p class="description-page" style="color:black;">Llena el siguiente Formulario para Agregar</p>

        <?php 
            include_once __DIR__ . "/../templates/alerts.php";
        ?>
        

        <form class="form" method='POST' enctype="multipart/form-data">
            <div class="slot">
                <label for="imagen">Imagen Vertical</label>
                <input
                    type="file"
                    id="imagen"
                    name="imagenV"
                />
            </div>
            <div class="slot">
                <label for="imagen">Imagen Horizontal</label>
                <input
                    type="file"
                    id="imagen"
                    name="imagenH"
                />
            </div>
            <input type="submit" value="Agregar" class="button" style="width: 100%;">
        </form>
        <a class="button" style="color:white !important;width:100%;margin:0;" href="/e0ba580ca07a56b26d44e88ee03b1abb">Volver</a>
        <br>
    </div>
</div>