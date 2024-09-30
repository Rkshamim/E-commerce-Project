<?php require_once 'layouts/header.php'; ?>
<?php require_once 'layouts/navigation.php'; ?>

<?php
spl_autoload_register(function ($class) {
    require './admin/classes/' . $class . '.php';
});

$cartId = isset($_SESSION['cart_id']) ? (int)$_SESSION['cart_id'] : 0;

$databaseClass = new Database();

$cartClass = new Cart($databaseClass->connect());

$productClass = new Product($databaseClass->connect());

$productImageClass = new ProductImage($databaseClass->connect());

$cartItems = $cartClass->getCartItems($cartId);

if (isset($_POST['submit'])) {

    $data = $_POST;

    foreach ($_POST as $key => $value) {

        if ($key === 'submit') continue;
        $cartItemId = (int)explode('-', $key)[1];

        $quantity = (int) $value;

        $cartClass->updateCartItem($quantity, $cartItemId);
    }

    header('Location: cart.php');
}

?>

<form action="" method="post">
    <div class="container mt-2  mb-4">
        <h1>Cart</h1>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">S No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($cartItems) == 0) : ?>
                    <tr>
                        <td colspan="5">
                            No Item is added to cart
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($cartItems as $key => $item) : ?>
                    <?php
                    $product = $productClass->getProductById($item['product_id']);

                    $images = $productImageClass->getProductImageByProductId($item['product_id']);
                    ?>

                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td>
                            <img src="admin/<?= $images[0]['image_path'] ?>" alt="">
                        </td>
                        <td><?= $product['name'] ?></td>
                        <td>$<?= $product['price'] ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" onclick="decrementItem('<?= $item['id'] ?>')">-</button>
                                <input name="cartitem-<?= $item['id'] ?>" id="cartitem-<?= $item['id'] ?>" type="text" id class="form-control" value="<?= $item['quantity'] ?>" style="width: 50px; border-top:2px solid #0d6efd; border-bottom:2px solid #0d6efd; border-radius:0px">
                                <button type="button" class="btn btn-primary" onclick="incrementItem('<?= $item['id'] ?>')">+</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (count($cartItems) != 0) : ?>
            <button class="btn btn-primary" name="submit"> Update Cart</button>
            <a href="index.php" class="btn btn-primary" type="button">Continue Shopping</a>
            <a href="checkout.php" class="btn btn-primary" type="button">Proceed To checkout</a>
        <?php endif; ?>
    </div>
</form>

<?php require_once 'layouts/footer.php'; ?>