<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php require_once PATH . 'core/validations.php'; ?>

<?php

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION['logged'])) {
    header("Location: " . URL . "views/home.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    // Inputs
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'");
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0) {

        mysqli_free_result($result);

        $_SESSION['logged'] = $user;
        $_SESSION['logged']['full_name'] = $user['f_name'] . " " . $user['l_name'];
        header("Location:" . URL . "views/home.php");
        exit;
    } 

} else {
    header("Location: " . URL . "views/auth/login.php");
    exit;
}
