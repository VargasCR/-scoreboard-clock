<section style="width:100%;height:100%;display:flex;justify-content:center;align-items:center;">
    <div class="form-admin">
        <div style="text-align:center;">
            <img src="/build/img/favicon.png" width="100px" alt="">
        </div>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.css">
        <style>
            .swal2-input {
                width: auto !important;
            }
        </style>
        <?php
            $parametro_key = '2d5278b057566a696ccff8d31ae5895b';
            $parametro = isset($_GET[$parametro_key]) ? $_GET[$parametro_key] : null;

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
                <label for="dni">Número de Cédula</label>
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
    <script src="/build/js/checkToken.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.all.min.js"></script>
    <script>
        getCheckToken();
    </script>
</section>


