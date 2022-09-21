<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_GET['id'])) {

    // check if this id category exist in categories table in database

    $id = $_GET['id'];
    $query = "DELETE FROM `categories` WHERE `id` = $id";
    $result = mysqli_query($conn, $query);

    $_SESSION['success'] = "Category Deleted Successfully";
    header("Location:" . URL . "views/categories/all.php");
    exit;

} else {

    header("Location:" . URL . "views/categories/all.php");
    exit;
}
