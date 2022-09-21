<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php require_once PATH . 'views/inc/header.php'; ?>

<?php
if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION['logged'])) {

    $authUserId = $_SESSION['logged']['user_id'];

($_SESSION['logged']['type'] == 'super_admin')
?$query = "SELECT `orders`.*, `users`.`f_name`
            FROM `orders`
            INNER JOIN `users` ON `orders`.`user_id` = `users`.`user_id`"
:$query = "SELECT * FROM `orders` WHERE `user_id` = '$authUserId'";

$result = mysqli_query($conn, $query);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

$i = 1;

?>

<h1 class="my-2 text-center">All Orders</h1>

<?php
if($_SESSION['logged']['type'] == 'super_admin') {
?>
<!-- <div>
    <a href="<?= URL . "views/products/add.php" ?>" class="btn btn-primary mb-5">
        Add New Product
    </a>
</div> -->
<?php
} elseif(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
?>
<div>
    <a href="<?= URL . "views/orders/add.php" ?>" class="btn btn-primary mb-5">
        Make Order
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
            <th scope="col">Notes</th>
            <th scope="col">Total Price</th>
            <?php
            if($_SESSION['logged']['type'] == 'super_admin') {
                echo '<th scope="col">Ordered By</th>';
            }
            ?>
            
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($orders as $order) {
        ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $order['customer_message'] ?></td>
                <td><?= $order['total_price'] ?></td>
                <?php
                if($_SESSION['logged']['type'] == 'super_admin') {
                    echo "<td>" . $order['f_name'] . "</td>";
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