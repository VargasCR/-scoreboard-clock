<div style="width:50%;">
    <h1 class="name-page">AGREGAR EMPLEADO</h1>
    <p class="description-page">Llena el siguiente Formulario para Agregar</p>

    <?php 
        include_once __DIR__ . "/../templates/alerts.php";
    ?>

    <form class="form" method='POST' enctype="multipart/form-data">
    
        <div class="slot">
            <label for="nombre">Nombre</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Tu Nombre"
                value="<?php echo s($users->name); ?>"
            />
        </div>

        <div class="slot">
            <label for="apellido">Apellido</label>
            <input
                type="text"
                id="apellido"
                name="apellido"
                placeholder="Tu Apellido"
                value="<?php echo s($users->lastName); ?>"
            />
        </div>

        <div class="slot">
            <label for="dni">Dni</label>
            <input
                type="number"
                id="dni"
                name="dni"
                placeholder="Tu cédula"
                value="<?php echo s($users->tel); ?>"
            />
        </div>

        <div class="slot">
            <label for="pass">Password</label>
            <input
                type="password"
                id="pass"
                name="pass"
                placeholder="Tu Password"
            />
        </div>

        <div class="slot">
            <label for="fechaInicio">Fecha de Inicio</label>
            <input
                type="date"
                id="fechaInicio"
                name="fechaInicio"
                value="<?php echo s($users->email); ?>"
            />
        </div>
        <div class="slot">
            <label for="fechaFinal">Fecha de Finalización</label>
            <input
                type="date"
                id="fechaFinal"
                name="fechaFinal"
                value="<?php echo s($users->email); ?>"
            />
        </div>

        

        <input type="submit" value="Crear Cuenta" class="button">


    </form>

    
</div>
