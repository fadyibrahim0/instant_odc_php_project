<?php

require_once '../../core/config.php';
require_once PATH . 'core/connection.php';
require_once PATH . 'core/validations.php';
if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION['logged']) && $_SESSION['logged']['type'] == 'user') {

    if(!empty($_SESSION['cart'])) {

        $currentUserID = $_SESSION['logged']['user_id'];

        $notes = validString($_POST['notes']);
        $notes = (isset($notes) && !empty($notes)) ? $notes : "";

        $noneRepeatedIDs = [];
        $price = 0;

        foreach($_SESSION['cart'] as $product) {
            if(!in_array($product['id'], $noneRepeatedIDs)) {
                $noneRepeatedIDs[] = $product['id'];
                $price = $price + $product['price'];
            }
        }

        // Insert Order
        $query = "INSERT INTO `orders` (`customer_message`, `total_price`, `user_id`)
                    VALUES('$notes', '$price', '$currentUserID')";
        $result = mysqli_query($conn, $query);

        if($result) {

            $lastOrderID = mysqli_insert_id($conn);

            $numItems = count($noneRepeatedIDs);
            $i = 0;

            // Start intermediate table insertion
            $query = "INSERT INTO `order_product` (`order_id`, `product_id`)
                        VALUES";

            // Build Query
            foreach($noneRepeatedIDs as $productID) {

                // last index
                if(++$i === $numItems) {
                    $query .= "('$lastOrderID', '$productID');";
                    break;
                }

                $query .= "('$lastOrderID', '$productID'),";
            }

            if(mysqli_query($conn, $query)) {
                unset($_SESSION['cart']);
                $_SESSION['success'] = "order generated Successfully";
                header("Location:" . URL . "views/orders/all.php");
                exit;
            }
        }


    } else {
        $_SESSION['errors'] = ['Please Add at least one product to your cart first'];
        header("Location:" . URL . "views/products/all.php");
        exit;
    }

} else {
    header("Location:" . URL . "views/auth/login.php");
    exit;
}