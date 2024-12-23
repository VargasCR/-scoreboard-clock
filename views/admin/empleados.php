<div class="index-admin-container">
        
        <br>
    <h3 style="margin: 0 0 0 1rem;color:black;">Empleados de Atlantic</h3>
    <div style="display: flex;margin: 0 0 1rem 1rem;justify-center:center;align-items:center;  ">
        <a class="button" style="padding: 0.5rem 1.3rem !important;" href="/21232f297a57a5a743894a0e4a801fc3"><</a>
        <a class="button" style="margin-left:1rem;padding: 0.5rem 1.3rem !important;" href="/1ebd87f94f5b252983dc86d628d17e7a">+</a>
        <a class="button" style="margin-left:1rem;padding: 0.5rem !important;" href="/4236a440a662cc8253d7536e5aa17942">Cerrar Sesion</a>

    </div>
    <div style="padding:1rem;">

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha Final</th>
                    <th class="">Acciones</th>
                    <!--<th>Admin</th>-->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perfiles as $usuario) { ?>
                    <?php if($usuario->admin == '0') { ?>
                        <tr style="padding:1rem;border: #6c757d solid 1px;">
                            <td><p class="tableInfoField">ID: </p><?= $usuario->id ?></td>
                            <td><p class="tableInfoField">DNI: </p><?= $usuario->dni ?></td>
                            <td><p class="tableInfoField">Nombre: </p><?= $usuario->nombre ?></td>
                            <td><p class="tableInfoField">Apellido: </p><?= $usuario->apellido ?></td>
                            <td><p class="tableInfoField">Inicio: </p><?= $usuario->fechaInicio ?></td>
                            <td><p class="tableInfoField">Final: </p><?= $usuario->fechaFinal ?></td>
                            <!-- <td><?= $usuario->admin ?></td> -->
                            <td>

                                <a href="/2885991af6301511c3ec390fec3fbceb?id=<?= $usuario->id.'&fechaDesde='.date('Y-m-d', strtotime('last Monday')).'&fechaHasta='.date('Y-m-d', strtotime('next Sunday'))?>" value=''>Ver Registro</a>
                                <a href="/b6f3f62dfe05b410e3f7f72e0d5db63a?id=<?= $usuario->id?>" style="margin: 0 0 0 0.5rem;">Editar</a>
                                <button style="background-color: transparent;border:none" onclick="borrarUsuario(<?= $usuario->id ?>)">Borrar</button>
                            </td>
                        </tr>
                <?php } ?>
                    
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function editarUsuario(idUsuario) {
        // Puedes implementar aquí la lógica para editar el usuario con el ID proporcionado
        alert("Editar usuario con ID: " + idUsuario);
    }
</script>
