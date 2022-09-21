<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    $id = $_POST['id'];

    $name           = trim(htmlentities(htmlspecialchars($_POST['name'])));
    $description    = trim(htmlentities(htmlspecialchars($_POST['description'])));
    $price          = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $category_id    = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);


    if(empty($name)) {
        $errors[] = "The name is empty!";
    } 
    if(strlen($name) < 3) {
        $errors[] = "Category name should be greater than 3 characters <br";
    }

    if(empty($description)) {
        $errors[] = "The description is empty!";
    }

    if(empty($price)) $errors[] = "The Product Price is required!";

    if(empty($errors)) {

        $query = "UPDATE `products` 
                    SET `name` = '$name', `description` = '$description', `price` = '$price', `category_id` = '$category_id'
                    WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);
        $affectedRow = mysqli_affected_rows($conn);

        if($affectedRow >= 1) {
            $_SESSION['success'] = "Product Updated Successfully";
            header("Location:" . URL . "views/products/all.php");
            exit;
        }
        

    } else {
        $_SESSION['errors'] = $errors;
        header("Location:" . URL . "views/products/edit.php?id=$id");
        exit;
    }

} else {

    header("Location:" . URL . "views/products/all.php");
    exit;
}
?>