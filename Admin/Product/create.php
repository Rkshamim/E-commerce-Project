<?php require_once '../../layouts/header.php'; ?>
<?php require_once '../../layouts/navigation.php'; ?>

<?php 
    spl_autoload_register(function($class){
        require '../classes/'.$class.'.php';
    });

    $databaseClass = new Database();
    
    $productClass = new Product($databaseClass->connect());

    if(isset($_POST['submit'])) {  

        $data = $_POST;

        $data = array_merge($data, $_FILES);

        $result = $productClass->store($data);

        if($result) {
            $_SESSION['success'] = 'Product created successfully';
        }else {
            $_SESSION['error'] = 'Something went wrong';
        }
       
        header('Location: index.php');
    }
?>

<div class="container mt-4 mb-2">
    <div class="row">
        <div class="col-sm-2">
            <?php require_once '../layouts/sidebar.php'; ?>
        </div>
        <div class="col-sm-10">
            <form action="" method="POST" enctype="multipart/form-data">
                <h1 class="sticky-top" style="height: 50px;background-color:#fff">Product Create

                    <input type="submit" name="submit" value="Submit" class="btn btn-primary mx-2" style="float: right;">
                    <a href="./index.php" class="btn btn-primary " style="float: right;">Back</a>
                </h1>
                <hr>
                <div style="border:2px solid #dee2e6; padding:20px">

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="short_description" id="short_description" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" name="description" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" id="price" value="" step="any">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity" id="quantity" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="image" class="col-sm-2 col-form-label">image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image[]" id="image" value="" multiple>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../../layouts/footer.php'; ?>