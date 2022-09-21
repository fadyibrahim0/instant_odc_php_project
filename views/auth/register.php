<?php require_once "../../core/config.php"; ?>
<?php require_once PATH . "views/inc/header.php" ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<div class="row">
    <h1 class="text-center my-5">Register Page</h1>


    <?php require_once PATH . "views/inc/messages.php" ?>

    <form class="col-md-8 my-3 m-auto" method="POST" action="<?= URL . "handlers/auth/register.php"?>">
        <div class="mb-3 form-group">
            <label for="f_name" class="form-label">First Name</label>
            <input type="text" name="f_name" class="form-control" id="f_name">
        </div>
        <div class="mb-3 form-group">
            <label for="l_name" class="form-label">Last Name</label>
            <input type="text" name="l_name" class="form-control" id="l_name">
        </div>
        <div class="mb-3 form-group">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="mb-3 form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Login</button>
    </form>
</div>

<?php require_once PATH . "views/inc/footer.php" ?>
