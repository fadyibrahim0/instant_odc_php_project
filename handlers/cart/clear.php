<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';
if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION['logged'])) {
    unset($_SESSION['cart']);
    $_SESSION['success'] = "Cart Cleared Successfully";
    header("Location:" . URL . "views/orders/add.php");
    exit;
} else {
    header("Location:" . URL . "views/auth/login.php");
    exit;
}