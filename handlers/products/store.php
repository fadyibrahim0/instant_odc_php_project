<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    $name           = trim(htmlentities(htmlspecialchars($_POST['name'])));
    $description    = trim(htmlentities(htmlspecialchars($_POST['description'])));
    $price          = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $category_id    = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);


    // Product Image
    $imgName        = $_FILES['image']['name'];
    $imgSize        = $_FILES['image']['size'];
    $imgType        = $_FILES['image']['type'];
    $imgTmp         = $_FILES['image']['tmp_name'];

    $allowedEXT = ['jpg', 'png', 'svg', 'jpeg'];

    $explodes = explode('.', $imgName);
    $imgEXT = strtolower(end($explodes));

    // Validate Product Image
    if(empty($imgName)) $errors[] = "Product Image is required";
    if(!in_array($imgEXT, $allowedEXT)) $errors[] = "This Extension isn't allowed";
    if($imgSize > 2097152) $errors[] = "Image size should be less than 2MB";

    // Validate product name
    if(empty($name)) {
        $errors[] = "The name is empty! <br>";
    } elseif(strlen($name) < 3) {
        $errors[] = "Product name should be greater than 3 characters <br>";
    }

    if(empty($description)) {
        $errors[] = "The description is empty! <br>";
    }

    if(empty($price)) $errors[] = "The Product Price is required!";

    if(empty($errors)) {

        $image = time() . "_" . $imgName;
        move_uploaded_file($imgTmp, PATH . "uploads/images/products/" . $image);

        $query = "INSERT INTO `products` (`name`, `description`, `price`, `image`, `category_id`)
                    VALUES ('$name', '$description', '$price', '$image', '$category_id')";
        $result = mysqli_query($conn, $query);
        $affectedRow = mysqli_affected_rows($conn);

        // Close DB Connection
        mysqli_close($conn);

        if($affectedRow >= 1) {
            $_SESSION['success'] = "Product Inserted Successfully";
            header("Location:" . URL . "views/products/all.php");
            exit;
        }
        

    } else {
        $_SESSION['errors'] = $errors;
        header("Location:" . URL . "views/products/add.php");
        exit;
    }

} else {

    header("Location:" . URL . "views/products/all.php");
    exit;
}
?>