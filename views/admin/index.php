<style>
    
</style>
<div>
    <h4 style="margin: 0 0 0 0;">Empleados de Atlantic</h4>
    <div style="display: flex;margin: 0 0 1rem 0;justify-center:center;align-items:center;  ">
        <a class="button" style="padding: 0.5rem;" href="/1ebd87f94f5b252983dc86d628d17e7a">+</a>
        <a class="button" style="margin-left:1rem;padding: 0.5rem;" href="/4236a440a662cc8253d7536e5aa17942">Cerrar Sesion</a>

    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Final</th>
                <!--<th>Admin</th>-->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($perfiles as $usuario) { ?>
                <?php if($usuario->admin == '0') { ?>
                    <tr>
                    <td><?= $usuario->id ?></td>
                    <td><?= $usuario->dni ?></td>
                    <td><?= $usuario->nombre ?></td>
                    <td><?= $usuario->apellido ?></td>
                    <td><?= $usuario->fechaInicio ?></td>
                    <td><?= $usuario->fechaFinal ?></td>
                   <!-- <td><?= $usuario->admin ?></td> -->
                    <td>
                        <a href="/2885991af6301511c3ec390fec3fbceb?id=<?= $usuario->id ?>" value=''>Ver Registro</a>
                        <a href="/b6f3f62dfe05b410e3f7f72e0d5db63a?id=<?= $usuario->id ?>" style="margin: 0 0 0 0.5rem;">Editar</a>
                        <button style="background-color: transparent;border:none" onclick="borrarUsuario(<?= $usuario->id ?>)">Borrar</button>
                    </td>
                </tr>
               <?php } ?>
                
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    function editarUsuario(idUsuario) {
        // Puedes implementar aquí la lógica para editar el usuario con el ID proporcionado
        alert("Editar usuario con ID: " + idUsuario);
    }
</script>
