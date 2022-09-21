<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';
if(session_status() === PHP_SESSION_NONE) session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['logged']) && $_SESSION['logged']['type'] == 'user') {

    $id = $_GET['id'];

    // Check if this product is exist
    $result = mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = '$id'");

    if(mysqli_num_rows($result) > 0) {

        $product = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);

        if(isset($_SESSION['cart'])) {
            $_SESSION['cart'][] = $product;
        } else {
            $_SESSION['cart'] = [$product];
        }

        $_SESSION['success'] = "Product Added To Cart Successfully";
        header("Location:" . URL . "views/products/all.php");
        exit;
        
    } else {
        header("Location:" . URL . "views/home.php");
        exit;
    }


} else {

    header("Location:" . URL . 'views/home.php');
    exit;
}