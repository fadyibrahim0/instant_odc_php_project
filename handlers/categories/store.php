<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    $name           = trim(htmlentities(htmlspecialchars($_POST['name'])));
    $description    = trim(htmlentities(htmlspecialchars($_POST['description'])));


    if(empty($name)) {
        $errors[] = "The name is empty! <br>";
    } elseif(strlen($name) < 3) {
        $errors[] = "Category name should be greater than 3 characters <br>";
    }

    if(empty($description)) {
        $errors[] = "The description is empty! <br>";
    }

    if(empty($errors)) {

        $query = "INSERT INTO `categories` (`name`, `description`)
                    VALUES ('$name', '$description')";
        $result = mysqli_query($conn, $query);
        $affectedRow = mysqli_affected_rows($conn);

        // Close DB Connection
        mysqli_close($conn);

        if($affectedRow >= 1) {
            $_SESSION['success'] = "Category Inserted Successfully";
            header("Location:" . URL . "views/categories/all.php");
            exit;
        }
        

    } else {
        $_SESSION['errors'] = $errors;
        header("Location:" . URL . "views/categories/add.php");
        exit;
    }

} else {

    header("Location:" . URL . "views/categories/all.php");
    exit;
}
?>