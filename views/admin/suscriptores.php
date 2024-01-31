<div class="index-admin-container">
    <br>
    <h3 style="margin: 0 0 0 1rem;color:black;">Suscriptores de Atlantic</h3>
    <div style="display: flex;margin: 0 0 1rem 1rem;justify-center:center;align-items:center;  ">
        <a class="button" style="padding: 0.5rem 1.3rem !important;" href="/21232f297a57a5a743894a0e4a801fc3"><</a>

        <a id="toggleTextarea" class="button" style="margin-left:1rem;padding: 0.5rem 1.3rem !important;" onclick="">Todos</a>
        <a class="button" style="margin-left:1rem;padding: 0.5rem !important;" href="/4236a440a662cc8253d7536e5aa17942">Cerrar Sesion</a>
    </div>
    <?php 
        // Obtén solo los correos electrónicos de los registros
        $emails = array_map(function ($suscriptor) {
            return $suscriptor->email;
        }, $registros);

        // Imprime los correos electrónicos en el formato deseado
        $emails_str = implode(",", $emails);
    ?>
    <textarea id="emailsTextarea" style="width: 95%;margin:0 1rem;display:none;max-height:10rem;min-height:10rem;"><?= $emails_str ?></textarea>
    <div style="padding:1rem;">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $suscriptor) { ?>
                    <tr class="tableRow" style="padding:1rem;border: #6c757d solid 1px;">
                        <td class="tableCell"><p class="tableInfoField">ID: </p><?= $suscriptor->id ?></td>
                        <td class="tableCell"><p class="tableInfoField">Email: </p><?= $suscriptor->email ?></td>
                        <td class="tableCell">
                            <button style="background-color: transparent;border:none" onclick="borrarSuscriptor(<?= $suscriptor->id ?>)">Borrar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    document.getElementById('toggleTextarea').addEventListener('click', function() {
        var textarea = document.getElementById('emailsTextarea');
        textarea.style.display = (textarea.style.display === 'none' || textarea.style.display === '') ? 'block' : 'none';
    });
</script>
