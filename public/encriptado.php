<?php
// Definir la clave de cifrado y el vector de inicialización (IV)
$clave = "clave_secreta";
$iv = random_bytes(16); // Generar un IV aleatorio

// Texto a encriptar
$texto_original = "Este es un texto secreto";

// Encriptar el texto
$texto_encriptado = openssl_encrypt($texto_original, "AES-256-CBC", $clave, OPENSSL_RAW_DATA, $iv);

// Desencriptar el texto
$texto_desencriptado = openssl_decrypt($texto_encriptado, "AES-256-CBC", $clave, OPENSSL_RAW_DATA, $iv);

// Imprimir los resultados
echo "Texto original: " . $texto_original . "<br>";
echo "Texto encriptado: " . base64_encode($texto_encriptado) . "<br>";
echo "Texto desencriptado: " . $texto_desencriptado . "<br>";

?>



<?php ?>
