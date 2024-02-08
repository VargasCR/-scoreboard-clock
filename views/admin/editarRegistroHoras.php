<!--Fecha Entrada	Fecha Salida	Hora Entrada	Hora Salida -->
<br>

<h2 style="color: black;">Editar Registro de Horas</h2>
<div class="form-admin-edit-container" style="">
    <form method="POST" class="form-admin-edit">
        <div class="slot">
            <label for="fechaEntrada">Fecha de Entrada</label>
            <input
                type="date"
                id="fechaEntrada"
                name="fechaEntrada"
                value="<?php echo s($registro->fechaEntrada); ?>"
            />
        </div>
        <div class="slot">
            <label for="fechaSalida">Fecha de Salida</label>
            <input
                type="date"
                id="fechaSalida"
                name="fechaSalida"
                value="<?php echo s($registro->fechaSalida); ?>"
            />
        </div>
        <div class="slot">
            <label for="horaEntrada">Hora de Entrada</label>
            <input
                type="time"
                id="horaEntrada"
                name="horaEntrada"
                value="<?php echo s($registro->horaEntrada); ?>"
            />
        </div>
        <div class="slot">
            <label for="horaSalida">Hora de Salida</label>
            <input
                type="time"
                id="horaSalida"
                name="horaSalida"
                value="<?php echo s($registro->horaSalida); ?>"
            />
        </div>
        <input class="button" type="submit" value="Guardar">
        <a class="button" type="submit" href="<?php
                if(isset($_SERVER['HTTP_REFERER'])) {
                    echo $_SERVER['HTTP_REFERER'];
                } else {
                    // Si la página anterior no está disponible, redirigir a una página predeterminada
                    echo "/2885991af6301511c3ec390fec3fbceb?id=".$_GET['uid'];
                }
            ?>">Volver</a>
        
    </form>
</div>


