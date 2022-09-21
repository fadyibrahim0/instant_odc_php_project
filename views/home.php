<?php require_once '../core/config.php'; ?>
<?php require_once PATH . 'views/inc/header.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php
if(isset($_SESSION['logged'])) {
?>

<h1 class="my-2 text-center">Home Page</h1>

<?php 

} else {
    header("Location:" . URL . "views/auth/login.php");
    exit;
}
?>

<?php require_once PATH . 'views/inc/footer.php'; ?>