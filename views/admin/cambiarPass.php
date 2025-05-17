<!--Fecha Entrada	Fecha Salida	Hora Entrada	Hora Salida -->
<br>
<?php
// Define $alerts as an empty array if it's not already defined
$alerts = isset($alerts) ? $alerts : [];

foreach ($alerts as $key => $errors):
    foreach ($errors as $error):
        ?>
        <div class="alert <?php echo $key; ?>">
            <?php echo $error; ?>
        </div>
        <?php
    endforeach;
endforeach;
?>
<h2 style="color: black;">Cambiar Contraseña</h2>
<div class="form-admin-edit-container" style="">
    <form method="POST" class="form-admin-edit">
        <div class="slot">
            <label for="pass">Contraseña Nueva</label>
            <input
                type="password"
                id="pass"
                name="new_password"
                value="" />
        </div>
        <div class="slot">
            <label for="password_1">Repetir Contraseña Nueva</label>
            <input
                name="new_password_1"
                type="password"
                id="password_1"
                value="" />
        </div>
        <div class="slot">
            <label for="old_password">Contraseña Actual</label>
            <input name="old_password" type="password" id="old_password" value=""/>
        </div>
        <input class="button" type="submit" value="Guardar">
        <a class="button" type="submit" href="/21232f297a57a5a743894a0e4a801fc7">Volver</a>
        
    </form>
</div>


