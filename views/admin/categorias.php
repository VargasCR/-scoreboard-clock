<div class="index-admin-container">
    <br>
    <h3 style="margin: 0 0 0 1rem;color:black;">Categorías de Productos</h3>
    <div style="display: flex;margin: 0 0 1rem 1rem;justify-center:center;align-items:center;">
        <a class="button" style="padding: 0.5rem 1.3rem !important;" href="/21232f297a57a5a743894a0e4a801fc3"><</a>
        <button class="button" style="margin-left:1rem;padding: 1rem 1.5rem !important;" id="toggleTextarea">+</button>
        <a class="button" style="margin-left:1rem;padding: 0.5rem !important;" href="/4236a440a662cc8253d7536e5aa17942">Cerrar Sesion</a>
    </div>
    <style>
        .select-genero {
            margin-top: 1rem;
            
            background-color: #e1e1e1 !important;
        }
    </style>
    <div class="slot" style="padding: 0 1rem;margin:0;display:none;" id="emailsTextarea">
        <form method="POST">
            <fieldset style="width: fit-content;">
                <legend style="width: auto;">Agregar categoría</legend>
                <input style="max-width: 30rem;" type="text" name="nombre" placeholder="Nombre de la categoría">
                <select style="max-width: 30rem;" name="genero" class="select-genero" value="0" id="">
                    <option value="0">Hombre</option>
                    <option value="1">Mujer</option>
                    <option value="2">Unisex</option>
                </select>
                <div>
                    <label for="aurum">Aurum?</label>
                    <input  style="width: auto;" type="checkbox" name="aurum" id="">

                </div>
                <input type="submit" value="GUARDAR" style="margin: 1rem 0 0 0;">
            </fieldset>
        </form>
    </div>
    <div style="padding:1rem;">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Genero</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $categoria) { ?>
                    <tr class="tableRow" style="padding:1rem;border: #6c757d solid 1px;">
                    <td class="tableCell"><p class="tableInfoField">ID: </p><?= $categoria->id ?></td>
                    <td class="tableCell"><p class="tableInfoField">Nombre: </p><?= $categoria->nombre ?></td>
                    <td class="tableCell"><p class="tableInfoField">Genero: </p><?php 
                    switch ($categoria->genero) {
                        case '0':
                            echo 'Hombre';
                            break;
                        case '1':
                            echo 'Mujer';
                            break;
                        case '2':
                            echo 'Unisex';
                            break;
                            
                            default:
                            echo 'Error';
                            break;
                        }?>
                    </td>
                    <td class="tableCell"><p class="tableInfoField">Aurum: </p><?php
                    if($categoria->aurum == '1') {
                        echo 'Sí';
                    } else {
                        echo 'No';
                    }
                    ?></td>
                    <td class="tableCell">
                        <button style="background-color: transparent;border:none" onclick="eliminarCategoria(<?= $categoria->id ?>)">Eliminar</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function showAddSection() {

    }
    document.getElementById('toggleTextarea').addEventListener('click', function() {
        var textarea = document.getElementById('emailsTextarea');
        textarea.style.display = (textarea.style.display === 'none' || textarea.style.display === '') ? 'block' : 'none';
    });
</script>
