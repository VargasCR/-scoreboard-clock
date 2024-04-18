<?php
define("TEMPLATES_URL", __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . 'functions.php');
define('IMAGE_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/images/');
define('REPORT_BASE_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/build/report/');
function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
function isLogged() : void{
 if(!isset($_SESSION['login'])) {
    header('Location: /');
 }
}
function isLast(string $current, string $next):bool {
    if($current !== $next) {
        return true;
    }
    return false;
}
function isAdmin() : void{
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
     }
}