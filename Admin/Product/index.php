<?php require_once '../../layouts/header.php'; ?>
<?php require_once '../../layouts/navigation.php'; ?>

<?php 
    spl_autoload_register(function($class){
        require '../classes/'.$class.'.php';
    });

    $databaseClass = new Database();
    
    $productClass = new Product($databaseClass->connect());

    $products = $productClass->getAllProducts();
?>



<div class="container mt-4 mb-2">
    <div class="row">
        <div class="col-sm-2">
            <?php require_once '../layouts/sidebar.php'; ?>
        </div>
        <div class="col-sm-10">
            <h1>Product
                <a href="create.php" class="btn btn-primary" style="float:right">Create Product</a>
            </h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">S No</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $key => $product): ?>
                    <tr>
                        <th scope="row"><?=$key+1?></th>
                        <td><?=$product['name']?></td>
                        <td>$<?=$product['price']?></td>
                        <td>
                            <a href="./edit.php?id=<?=$product['id']?>" class="btn btn-primary">Edit</a>
                            <a href="./delete.php?id=<?=$product['id']?>"  onclick="deleteRecord(event)" class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../layouts/footer.php'; ?>