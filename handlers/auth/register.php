<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php require_once PATH . 'core/validations.php'; ?>

<?php

if(session_status() === PHP_SESSION_NONE) session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    // Sanitize Inputs
    $f_name = validString($_POST['f_name']);
    $l_name = validString($_POST['l_name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ?? "";
    $password = trim($_POST['password']);

    // Check if email already exists
    $result = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '$email'");

    if(mysqli_num_rows($result) > 0) {
        $errors[] = "Sorry this email already exists choose another one";
        mysqli_free_result($result);
    }

    if(empty($f_name)) $errors[] = "First Name is required";
    if(minVal($f_name, 3) || maxVal($f_name, 50)) $errors[] = "First Name should be between 3 and 50 characters";

    if(empty($l_name)) $errors[] = "First Name is required";
    if(minVal($l_name, 3) || maxVal($l_name, 50)) $errors[] = "Last Name should be between 3 and 50 characters";

    if(empty($email)) $errors[] = "Email field is required";

    if(empty($password)) $errors[] = "Password field is required";

    // if there are no errors
    if(empty($errors)) {

        // Encrypt password
        $password = sha1($password);

        // Insert Statement
        $query = "INSERT INTO `users` (`f_name`, `l_name`, `email`, `password`, `type`)
                    VALUES ('$f_name', '$l_name', '$email', '$password', 'user')";
        $result = mysqli_query($conn, $query);
        $affectedRows = mysqli_affected_rows($conn);

        // close connection
        mysqli_close($conn);

        $_SESSION['success'] = "You Have been registered successfully!";
        header("Location: " . URL . "views/auth/login.php");
        exit;
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: " . URL . "views/auth/register.php");
        exit;
    }
} else {
    header("Location: " . URL . "views/auth/login.php");
    exit;
}
