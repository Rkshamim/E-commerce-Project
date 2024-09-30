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
?>

<nav class="navbar bg-primary navbar-expand-lg" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="d-flex" style="margin-left: 10%;width: 60%;" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart
                        <?php if (count($cartItems) > 0) : ?>
                            <span class="badge bg-danger"><?= count($cartItems) ?></span>
                        <?php endif; ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>

    </div>
</nav>