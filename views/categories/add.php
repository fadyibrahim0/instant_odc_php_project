<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'views/inc/header.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php
if(isset($_SESSION['logged'])) {
?>
<h1 class="my-2 text-center">Add New Category</h1>

<div>
    <a href="<?= URL . "views/categories/all.php" ?>" class="btn btn-primary mb-5">
        All Categories
    </a>
</div>

<!-- Display Messages -->
<?php require_once PATH . 'views/inc/messages.php' ?>

<form action="<?= URL . "handlers/categories/store.php" ?>" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" id="description">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</but>
</form>
<?php
} else {
    header("Location:" . URL . "views/auth/login.php");
    exit;
}
?>
<?php require_once PATH . 'views/inc/footer.php'; ?>