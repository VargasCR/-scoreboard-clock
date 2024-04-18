<?php

function mostrarValor($valor)
{
    return htmlentities($valor, ENT_QUOTES, 'UTF-8');
}

function calcularHorasTrabajadas($fechaEntrada, $horaEntrada, $fechaSalida, $horaSalida)
{
    $fechaEntradaObj = new DateTime($fechaEntrada . ' ' . $horaEntrada);
    $fechaSalidaObj = new DateTime($fechaSalida . ' ' . $horaSalida);

    // Verificar si la fecha de salida es menor que la fecha de entrada (al día siguiente)
    if ($fechaSalidaObj < $fechaEntradaObj) {
        // Sumar un día a la fecha de salida
        $fechaSalidaObj->add(new DateInterval('P1D'));
    }

    // Calcular la diferencia de tiempo normalmente
    $intervalo = $fechaEntradaObj->diff($fechaSalidaObj);

    // Convertir días a horas
    $horas = $intervalo->days * 24 + $intervalo->h;
    $minutos = $intervalo->i;
    
    return ['horas' => $horas, 'minutos' => $minutos];
}


// Variable para almacenar el total de horas trabajadas y horas extras
$totalHorasTrabajadas = 0;
$totalMinutosTrabajados = 0;
$totalHorasExtras = 0;
$totalMinutosExtras = 0;

// Obtener los valores de fechaDesde y fechaHasta de la URL
$fechaDesde = isset($_GET['fechaDesde']) ? $_GET['fechaDesde'] : date('Y-m-d', strtotime('last Monday'));
$fechaHasta = isset($_GET['fechaHasta']) ? $_GET['fechaHasta'] : date('Y-m-d', strtotime('next Sunday'));

// Salario por hora del empleado
$salarioPorHora = $empleado->salario; // Asegúrate de que esta variable esté correctamente definida


while (($totalMinutosTrabajados + $totalMinutosExtras) >= 60) {
        
    $totalHorasTrabajadas ++;
    $totalMinutosTrabajados -= 60; // Resta 60 minutos y actualiza el valor
    
}
$totalSalario = null;
$totalHoras = null;





$totalHoras = mostrarValor($totalHorasTrabajadas + $totalHorasExtras . ' horas y ' . ($totalMinutosTrabajados + $totalMinutosExtras) . ' minutos');
$totalSalario = ($totalHorasTrabajadas + $totalHorasExtras + $totalMinutosTrabajados / 60 + $totalMinutosExtras / 60) * $salarioPorHora;







?>
<div>
    <div style="display: block;text-align:center;">
        
            <a class="button" href="/21232f297a57a5a743894a0e4a801fc7">Volver</a>
            <h2 style="color: black;">Registro de Horas para <?php echo mostrarValor($empleado->nombre); ?></h2>
            <form id="filtroForm" action="" method="GET">
                <label for="fechaDesde">Desde:</label>
                <div style="width: 100%;display:flex;justify-content:center;">
                    <input style="width: auto;" type="date" id="fechaDesde" name="fechaDesde" value="<?php echo mostrarValor($fechaDesde); ?>">
                </div>

                <label for="fechaHasta">Hasta:</label>
                <div style="width: 100%;display:flex;justify-content:center;">
                    <input style="width: auto;" type="date" id="fechaHasta" name="fechaHasta" value="<?php echo mostrarValor($fechaHasta); ?>">
                </div>

                <button class="button" style='margin-top:1rem;' type="submit">Buscar</button>
            </form>
            
            
            <br>
            <?php 
                if(empty($registros)) {
                    echo "<h1 style='color:black;'>No Hay Resultados</h1>";
                } else { ?>
                <div style="width: 100%;display: flex;justify-content: left;">
                    <table border="1" style="margin: 1rem !important;">
                        <thead>
                            <tr>
                                <th>Fecha Entrada</th>
                                <th>Fecha Salida</th>
                                <th>Hora Entrada</th>
                                <th>Hora Salida</th>
                                <th>Horas Trabajadas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registros as $registro): ?>
                                <tr>
                                    <td style=""><p class="tableInfoField">Fecha Entrada: </p><?php echo mostrarValor($registro->fechaEntrada); ?></td>
                                    <td style=""><p class="tableInfoField">Fecha Salida: </p><?php echo mostrarValor($registro->fechaSalida); ?></td>
                                    <td style=""><p class="tableInfoField">Hora Entrada: </p><?php echo mostrarValor($registro->horaEntrada); ?></td>
                                    <td style=""><p class="tableInfoField">Hora Salida: </p><?php echo mostrarValor($registro->horaSalida); ?></td>

                                    <?php
                                        $intervalo = calcularHorasTrabajadas($registro->fechaEntrada, $registro->horaEntrada, $registro->fechaSalida, $registro->horaSalida);

                                        // Suma las horas trabajadas al total
                                        $totalHorasTrabajadas += $intervalo['horas'];
                                        $totalMinutosTrabajados += $intervalo['minutos'];
                                        ?>

                                        <td style=""><p class="tableInfoField">Total de Horas: </p><?php echo mostrarValor($intervalo['horas'] . ' horas y ' . $intervalo['minutos'] . ' minutos'); ?></td>
                                        <td>
                                            <!-- Botones de editar y borrar -->
                                            <a href="/4584073e4643fe782c06f2955569a966?id=<?php echo $registro->id; ?>&uid=<?php echo $empleado->id; ?>">Editar</a>
                                            <button style="background-color: transparent;border:none;" onclick="borrarRegistro(<?php echo $registro->id; ?>)">Borrar</button>
                                        </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        
                        </tbody>
                    </table>
                            </div>
                    <div style="display: block;">
                        <div style='margin-top:1rem;'>
                            <p style="margin: 0;font-size:1.5rem;color:black;">Total de Horas Trabajadas + Extras:</p>
                            

                            <p style="margin: 0;font-size:1.5rem;color:black;"><?php echo mostrarValor($totalHorasTrabajadas + $totalHorasExtras . ' horas y ' . ($totalMinutosTrabajados + $totalMinutosExtras) . ' minutos'); ?></p>
                        </div>
                        <div style='margin-top:1rem;'>
                            <p style="margin: 0;font-size:1.5rem;color:black;">Salario Total:</p>
                            <p style="margin: 0;font-size:1.5rem;color:black;">₡<?php echo mostrarValor(($totalHorasTrabajadas + $totalHorasExtras + $totalMinutosTrabajados / 60 + $totalMinutosExtras / 60) * $salarioPorHora); ?></p>
                        </div>
                    </div>

            <?php }
            ?>
       <form action="/e98d2f001da5678b39482efbdf5770dc" method="POST">
                <input type="hidden" value="<?php echo $empleado->id;?>" name="id">
                <input type="hidden" value="<?php echo $fechaDesde;?>" name="fechaDesde">
                <input type="hidden" value="<?php echo $fechaHasta;?>" name="fechaHasta">
                <input type="hidden" value="<?php echo mostrarValor(($totalHorasTrabajadas + $totalHorasExtras + $totalMinutosTrabajados / 60 + $totalMinutosExtras / 60) * $salarioPorHora);?>" name="totalSalario">
                <input type="hidden" value="<?php echo mostrarValor($totalHorasTrabajadas + $totalHorasExtras . ' horas y ' . ($totalMinutosTrabajados + $totalMinutosExtras) . ' minutos');?>" name="totalHoras">
                
                <button class="button" style='margin-top:1rem;' type="submit">Exportar</button>
            </form>
        
    </div>
</div>

<script>
    document.getElementById('filtroForm').addEventListener('submit', function (event) {
        // Prevenir el envío del formulario para manejar la búsqueda con JavaScript
        event.preventDefault();

        // Obtener las fechas seleccionadas
        var fechaDesde = document.getElementById('fechaDesde').value;
        var fechaHasta = document.getElementById('fechaHasta').value;

        // Redirigir a la página con los parámetros de búsqueda
        window.location.href = '/2885991af6301511c3ec390fec3fbceb?id=<?php echo $empleado->id; ?>&fechaDesde=' + fechaDesde + '&fechaHasta=' + fechaHasta;
    });
</script>
<script src="/build/js/account.js"></script>
