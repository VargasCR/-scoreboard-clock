

<?php
$file_path = 'C:\\Program Files\\a9412f8dc03b7d4df1438c489cd2d25c\\1a1dc91c907325c69271ddf0c944bc72.txt';
// Leer el archivo en un array, cada línea es un elemento en el array
$file_lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if ($file_lines === false) {
    echo "Error al leer el archivo.";
    exit;
} else {
    // Obtener el primer token (primera línea del archivo)
    $primerToken = isset($file_lines[0]) ? trim($file_lines[0]) : null;

    if ($primerToken !== null && $primerToken == 'f2bc4d2bba63f35630d598f93f18253b') {
     //echo 'Primer Token: ' . $primerToken;
    } else {
        echo 'No se encontró ningún token en el archivo.';
        exit;
    }
}
?>



<div style="width:50%;">
    <div style="text-align:center;">
        <img src="/build/img/favicon.png" width="100px" alt="">
    </div>
    <h1 class="name-page">REGISTRO</h1>
    <p class="description-page">Registra tu hora de entrada y salida</p>
    <?php
        $parametro = $_GET['2d5278b057566a696ccff8d31ae5895b'];
        switch ($parametro) {
            case '3547d44613ce711ad7e2bc1808012b23':
                echo '<div class="alert success">';
                echo 'Hora de entrada: ' . $_GET['07cc694b9b3fc636710fa08b6922c42b'];
                echo '</div>';
                break;
        
            case 'cd5cedd385ce4e84e8405997c37a8e3d':
                echo '<div class="alert success">';
                echo 'Hora de salida: ' . $_GET['07cc694b9b3fc636710fa08b6922c42b'];
                echo '</div>';
                break;
        
            case '4a0fa8dde5c48a5e6718f1068b0bfdf8':
                echo '<div class="alert error">';
                echo 'Entrada ya registrada, contacte al administrador';
                echo '</div>';
                break;
        
            case '4a0fa8dde5c48a5e6718f1068b0bfdf7':
                echo '<div class="alert error">';
                echo 'Usuario no encontrado';
                echo '</div>';
                break;
        
            default:
                // Código a ejecutar si ninguno de los casos coincide con el valor de $parametro
                break;
        }
        
    ?>

    

    <form class="form" method="POST" action="/login">
        <div class="slot">
            <label for="email">Número de Cédula</label>
            <input
                type="number"
                id="dni"
                placeholder="Tu Número de Cédula"
                name="dni"
            />
        </div>
        <div class="slot">
            <label for="pass">Contraseña</label>
            <input 
                type="password"
                id="pass"
                placeholder="Tu Contraseña"
                name="pass"
            />
        </div>

        <input type="submit" class="button" value="Iniciar Sesión">
    </form>
</div>
