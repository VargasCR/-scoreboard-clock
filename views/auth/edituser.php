<div style="width: 100%;align-items: center;justify-content: center;display:flex;">

<div style="width:50%;">
    <h1 class="name-page" style="color:black;">EDITAR EMPLEADO</h1>
    <p class="description-page" style="color:black;">Llena el siguiente Formulario para Editar</p>

    <?php 
        include_once __DIR__ . "/../templates/alerts.php";
    ?>
    

    <form class="form" method='POST' enctype="multipart/form-data">
    <input type="hidden">
        <div class="slot">
            <label for="nombre">Nombre</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Tu Nombre"
                value="<?php echo s($usuario->nombre); ?>"
            />
        </div>
        <div class="slot">
            <label for="apellido">Apellido</label>
            <input
                type="text"
                id="apellido"
                name="apellido"
                placeholder="Tu Apellido"
                value="<?php echo s($usuario->apellido); ?>"
            />
        </div>
        <div class="slot">
            <label for="dni">Dni</label>
            <input
                type="number"
                id="dni"
                name="dni"
                placeholder="Tu cédula"
                value="<?php echo s($usuario->dni); ?>"
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
                value="<?php echo s($usuario->fechaInicio); ?>"
            />
        </div>
        <div class="slot">
            <label for="fechaFinal">Fecha de Finalización</label>
            <input
                type="date"
                id="fechaFinal"
                name="fechaFinal"
                value="<?php echo s($usuario->fechaFinal); ?>"
            />
        </div>
        <div class="slot">
            <label for="salario">Pago por hora</label>
            <input
                type="number"
                id="salario"
                name="salario"
                value="<?php echo s($usuario->salario); ?>"
            />
        </div>
        <input type="submit" value="Guardar" class="button" style="width: 100%;">
    </form>
    <a class="button" style="color:white !important;width:100%;margin:0;" href="/21232f297a57a5a743894a0e4a801fc7">Volver</a>
    <br>
</div>
</div>
