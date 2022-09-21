<?php require_once "../../core/config.php"; ?>
<?php require_once PATH . "views/inc/header.php" ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php
if(isset($_SESSION['logged'])) {
    header("Location: " . URL . "views/home.php");
    exit;
}
?>

<div class="row">
    <h1 class="text-center my-5">Login Page</h1>


    <?php require_once PATH . "views/inc/messages.php" ?>

    <form class="col-md-8 my-3 m-auto" method="POST" action="<?= URL . "handlers/auth/login.php"?>">
        <div class="mb-3 form-group">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="mb-3 form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Login</button>
        <a class="btn btn-secondary" href="<?= URL . "views/auth/register.php" ?>">
            Or Register
        </a>
    </form>
    
</div>

<?php require_once PATH . "views/inc/footer.php" ?>
