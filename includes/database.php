<?php
if($_ENV['ENVIROMENT'] == '1') {
    $db = new mysqli($_ENV['DB_HOST'],$_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
} else {
    $db = new mysqli($_ENV['DB_HOST_LOCAL'],$_ENV['DB_USER_LOCAL'], $_ENV['DB_PASS_LOCAL'], $_ENV['DB_NAME_LOCAL']);
}

$db->set_charset('utf8');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
