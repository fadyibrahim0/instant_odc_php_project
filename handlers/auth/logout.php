<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>

<?php

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION['logged'])) {
    
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location:" . URL . "views/auth/login.php");
    exit;

} else {
    header("Location:" . URL . "views/auth/login.php");
    exit;
}