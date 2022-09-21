<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'views/inc/header.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php 

if(isset($_SESSION['logged']) && $_SESSION['logged']['type'] == 'super_admin') {

$id = $_GET['id'];

$query = "SELECT * FROM `products` WHERE `id` = $id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

$categories = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `categories`"), MYSQLI_ASSOC);
?>

<h1 class="my-2 text-center">Edit - <?= $product['name'] ?></h1>

<div>
    <a href="<?= URL . "views/products/all.php" ?>" class="btn btn-primary mb-5">
        All Products
    </a>
</div>

<!-- Display Messages -->
<?php require_once PATH . 'views/inc/messages.php' ?>

<form action="<?= URL . 'handlers/products/update.php' ?>" method="POST">
    <input type="hidden" name="id" value="<?= $product['id'] ?>" />
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" id="name" value="<?= $product['name'] ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Product Description</label>
        <input type="text" name="description" class="form-control" id="description" value="<?= $product['description'] ?>">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Product Price</label>
        <input type="number" name="price" class="form-control" id="price" value="<?= $product['price'] ?>">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Category Name</label>
        <select name="category_id" class="form-control">
            <?php
            foreach($categories as $category) {
            ?>
            <option value="<?= $category['id'] ?>" <?php if($category['id'] == $product['category_id']) echo "selected"; ?>>

                <?= $category['name'] ?>
            </option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Update</but>
</form>

<?php 

} else {
    header("Location:" . URL . "views/auth/login.php");
    exit;
}
?>

<?php require_once PATH . 'views/inc/footer.php'; ?>