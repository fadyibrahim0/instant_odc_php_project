<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'views/inc/header.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php

if(isset($_SESSION['logged'])) {

$query = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h1 class="my-2 text-center">Add New Product</h1>

<div>
    <a href="<?= URL . "views/products/all.php" ?>" class="btn btn-primary mb-5">
        All Products
    </a>
</div>

<!-- Display Messages -->
<?php require_once PATH . 'views/inc/messages.php' ?>

<form action="<?= URL . "handlers/products/store.php" ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Product Description</label>
        <input type="text" name="description" class="form-control" id="description">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Product Price</label>
        <input type="number" name="price" class="form-control" id="price">
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Category Name</label>
        <select class="form-control" name="category_id" id="category_id">
            <?php
            foreach($categories as $category) {
            ?>
            <option value="<?= $category['id'] ?>"> <?= $category['name'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</but>
</form>

<?php 

} else {
    header("Location:" . URL . "views/auth/login.php");
    exit;
}
?>

<?php require_once PATH . 'views/inc/header.php'; ?>