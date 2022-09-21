<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php require_once PATH . 'views/inc/header.php'; ?>

<?php
if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION['logged'])) {
    
    $query = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $query);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $i = 1;


?>

<h1 class="my-2 text-center">All Categories</h1>

<?php
if($_SESSION['logged']['type'] == 'super_admin') {
?>
<div>
    <a href="<?= URL . "views/categories/add.php" ?>" class="btn btn-primary mb-5">
        Add New Category
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
            <th scope="col">Category Name</th>
            <th scope="col">Category Description</th>
            <?php
            if($_SESSION['logged']['type'] == 'super_admin') {
            ?>
            <th scope="col">Actions</th>
            <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($categories as $category) {
        ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $category['name'] ?></td>
                <td><?= $category['description'] ?></td>
                <?php
                if($_SESSION['logged']['type'] == 'super_admin') {
                ?>
                <td>
                    <a href="<?= URL . 'views/categories/edit.php?id=' . $category['id'] ?>" class="btn btn-secondary">
                        Edit
                    </a>
                    <a href="<?= URL . 'handlers/categories/delete.php?id=' . $category['id'] ?>" class="btn btn-danger">
                        Delete
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