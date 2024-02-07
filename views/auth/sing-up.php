<div style="" class="addEmploye">
    <h1 class="name-page" style="color:black;">AGREGAR EMPLEADO</h1>
    <p class="description-page" style="color:black;">Llena el siguiente Formulario para Agregar</p>

    <?php 
        include_once __DIR__ . "/../templates/alerts.php";
    ?>
    

    <div style="display:flex;width:100%;justify-content:center;">
        <form class="form formaddEmploye" method='POST' enctype="multipart/form-data">
        
            <div class="slot">
                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    placeholder="Tu Nombre"
                    value=""
                />
            </div>

            <div class="slot">
                <label for="apellido">Apellido</label>
                <input
                    type="text"
                    id="apellido"
                    name="apellido"
                    placeholder="Tu Apellido"
                    value=""
                />
            </div>

            <div class="slot">
                <label for="dni">Dni</label>
                <input
                    type="number"
                    id="dni"
                    name="dni"
                    placeholder="Tu cédula"
                    value=""
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
                    value=""
                />
            </div>
            <div class="slot">
                <label for="fechaFinal">Fecha de Finalización</label>
                <input
                    type="date"
                    id="fechaFinal"
                    name="fechaFinal"
                    value=""
                />
            </div>
            <div class="slot">
                <label for="salario">Pago por hora</label>
                <input
                    type="number"
                    id="salario"
                    name="salario"
                    value=""
                />
            </div>

            

            <input type="submit" value="Agregar" class="button" style="width: 100%;">


            <a class="button" style="color:white !important;width:100%;margin:0;" href="/21232f297a57a5a743894a0e4a801fc3">Volver</a>
        </form>

    </div>
    
</div>
