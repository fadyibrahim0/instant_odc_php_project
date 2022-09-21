<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    // check if this id product exist in categories table in database
    $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = '$id'"));
    if($product) {
        
        $result = mysqli_query($conn, "DELETE FROM `products` WHERE `id` = $id");
        
        if(file_exists(PATH . "uploads/images/products/" . $product['image'])) {
            unlink(PATH . "uploads/images/products/" . $product['image']);
            $_SESSION['success'] = "Product Deleted Successfully";
            header("Location:" . URL . "views/products/all.php");
            exit;
        }

    } else {
        $_SESSION['errors'] = "This Products doesn't exist in our fields";
        header("Location:" . URL . "views/products/all.php");
        exit;
    }

} else {

    header("Location:" . URL . "views/products/all.php");
    exit;
}
