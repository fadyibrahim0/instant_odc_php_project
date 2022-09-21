<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'views/inc/header.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>


<?php
if(isset($_SESSION['logged'])) {
?>

<h1 class="my-2 text-center">Make Order</h1>

<div>
    <a href="<?= URL . "views/products/all.php" ?>" class="btn btn-primary mb-5">
        All Products
    </a>
</div>

<div class="row">

</div>

<!-- Display Messages -->
<?php require_once PATH . 'views/inc/messages.php' ?>

<div class="row">
    <div class="buttons">
        <!-- Notes Form -->
        <form class="d-inline-block" method="POST" action="<?= URL . "handlers/orders/store.php" ?>">
            <div class="mb-3">
                <label for="notes" class="form-label">Any Notes?</label>
                <input type="text" name="notes" class="form-control" id="notes">
            </div>
            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
        <!-- Notes Form -->

        <a href="<?= URL . "handlers/cart/clear.php" ?>" class="btn btn-secondary">
            Clear Cart
        </a>

        <?php
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        ?>
        <!-- Begin Table -->
        <table class="table my-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $existedProducts = [];
                foreach($_SESSION['cart'] as $product) {
                
                    if(!in_array($product['id'], $existedProducts)) {

                
                ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['price'] ?></td>
                            <td>
                                <img src="<?= URL . "uploads/images/products/" . $product['image'] ?>" style="width: 90px; height:90px; border-radius: 50%;" alt="Image">
                            </td>
                        </tr>
                <?php
                    $existedProducts[] = $product['id'];
                    }
                }
                ?>
            </tbody>
        </table>
        <!-- End Table -->
        <?php
        } else {
            echo "<h1>Your Cart Is Empty</h1>";
        }
        ?>
    </div>
</div>


<?php
} else {
    header("Location: " . URL . "views/auth/login.php");
    exit;
}
?>

<?php require_once PATH . 'views/inc/footer.php'; ?>