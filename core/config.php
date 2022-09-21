<?php

$rootDirName = basename(dirname(__DIR__));

$explodes = explode("/", $_SERVER['REQUEST_URI']);

// /instantODC/session_07
$proPath = "";
foreach($explodes as $item) {
    $proPath .= "$item/";
    if($item == $rootDirName) break;
}


// http://localhost:80/instantODC/session_07/       (used when header or href)
define('URL', 'http://' . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $proPath);

// C:/xampp/htdocs/instantODC/session_07    (use when require or include)
define('PATH', $_SERVER['DOCUMENT_ROOT'] . $proPath);


function dd($data)
{
    echo "<pre>";
        print_r($data);
    echo "</pre>";
    exit;
}