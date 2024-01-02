<!--Fecha Entrada	Fecha Salida	Hora Entrada	Hora Salida -->

<div>
    <form method="POST">
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
        <input type="submit" value="GUARGAR">
        <a type="submit" href="/2885991af6301511c3ec390fec3fbceb?id=<?php echo $_GET['uid'] ?>">Volver</a>
    </form>
</div>


