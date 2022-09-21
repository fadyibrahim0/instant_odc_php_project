<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'views/inc/header.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>

<?php
if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION['logged'])) {

$query = "SELECT `products`.*, `categories`.`name` AS `category_name`
            FROM `products`
            INNER JOIN `categories` ON `products`.`category_id` = `categories`.`id`";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

$i = 1;

?>

<h1 class="my-2 text-center">All Products</h1>

<?php
if($_SESSION['logged']['type'] == 'super_admin') {
?>
<div>
    <a href="<?= URL . "views/products/add.php" ?>" class="btn btn-primary mb-5">
        Add New Product
    </a>
</div>
<?php
} elseif(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
?>
<div>
    <a href="<?= URL . "views/orders/add.php" ?>" class="btn btn-primary mb-5">
        Make Order
    </a>
</div>
<?php
}
?>

<!-- Display Messages -->
<?php require_once PATH . 'views/inc/messages.php' ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Description</th>
            <th scope="col">Product Price</th>
            <th scope="col">Related Category</th>
            <th scope="col">Product Image</th>
            <th scope="col">Actions</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($products as $product) {
        ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $product['name'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['category_name'] ?></td>
                <td>
                    <img class="image-rounded" style="border-radius: 50%; width: 70px" src="<?= URL . "uploads/images/products/" . $product['image'] ?>" alt="Product Image" >
                </td>
                <?php
                if($_SESSION['logged']['type'] == 'super_admin') {
                ?>
                <td>
                    <a href="<?= URL . 'views/products/edit.php?id=' . $product['id'] ?>" class="btn btn-secondary">
                        Edit
                    </a>
                    <a href="<?= URL . 'handlers/products/delete.php?id=' . $product['id'] ?>" class="btn btn-danger">
                        Delete
                    </a>
                </td>
                <?php
                } elseif($_SESSION['logged']['type'] == 'user') {
                ?>
                <td>
                    <a href="<?= URL . 'handlers/cart/store.php?id=' . $product['id'] ?>" class="btn btn-info">
                        Add To Cart
                    </a>
                </td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>

<?php 

} else {
    header("Location:" . URL . "views/auth/login.php");
    exit;
}
?>

<?php require_once PATH . 'views/inc/footer.php'; ?>