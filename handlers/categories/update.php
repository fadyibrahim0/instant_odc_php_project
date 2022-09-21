<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    $id = $_POST['id'];

    $name           = trim(htmlentities(htmlspecialchars($_POST['name'])));
    $description    = trim(htmlentities(htmlspecialchars($_POST['description'])));


    if(empty($name)) {
        $errors[] = "The name is empty! <br>";
    } 
    if(strlen($name) < 3) {
        $errors[] = "Category name should be greater than 3 characters <br>";
    }

    if(empty($description)) {
        $errors[] = "The description is empty! <br>";
    }

    if(empty($errors)) {

        $query = "UPDATE `categories` 
                    SET `name` = '$name', `description` = '$description'
                    WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);
        $affectedRow = mysqli_affected_rows($conn);

        if($affectedRow >= 1) {
            $_SESSION['success'] = "Category Updated Successfully";
            header("Location:" . URL . "views/categories/all.php");
            exit;
        }
        

    } else {
        $_SESSION['errors'] = $errors;
        header("Location:" . URL . "views/categories/edit.php?id=$id");
        exit;
    }

} else {

    header("Location:" . URL . "views/categories/all.php");
    exit;
}
?>