<?php

if(session_status() === PHP_SESSION_NONE) session_start();

$rootDirName = basename(dirname(dirname(__DIR__)));

$explodes = explode("/", $_SERVER['REQUEST_URI']);

// /instantODC/session_07
$proPath = "";
foreach($explodes as $item) {
    $proPath .= "$item/";
    if($item == $rootDirName) break;
}

// http://localhost:80/instantODC/session_07/       (used when header or href)
define('N_URL', 'http://' . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $proPath);


// To Do:
$currentURL = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= N_URL . "views/home.php" ?>">Luxor-Aswan</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= (!(str_contains($currentURL, 'categories') ||
                                            str_contains($currentURL, 'products'))) ? "active" :""; ?>" href="<?= N_URL . "views/home.php" ?>">Home</a>
                </li>
                <?php
                if($_SESSION['logged']['type'] == 'super_admin') {
                ?>
                <li class="nav-item">
                    <a class="nav-link <?= (str_contains($currentURL, 'categories')) ? "active" :""; ?>" href="<?= N_URL . "views/categories/all.php" ?>">Categories</a>
                </li>
                <?php
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link <?= (str_contains($currentURL, 'products')) ? "active" :""; ?>" href="<?= N_URL . "views/products/all.php" ?>">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (str_contains($currentURL, 'orders')) ? "active" :""; ?>" href="<?= N_URL . "views/orders/all.php" ?>">Orders</a>
                </li>
            </ul>
            <?php
            if(isset($_SESSION['logged'])) {
            ?>
            <ul class="navbar-nav mx-5 mb-2 mb-lg-0 justify-content-right">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= $_SESSION['logged']['full_name'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= N_URL . "handlers/auth/logout.php" ?>">Logout</a>
                </li>
            </ul>
            <?php
            }
            ?>
            
            
        </div>
    </div>
</nav>