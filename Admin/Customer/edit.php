<?php require_once '../../layouts/header.php'; ?>
<?php require_once '../../layouts/navigation.php'; ?>

<?php
spl_autoload_register(function ($class) {
    require '../classes/' . $class . '.php';
});

$databaseClass = new Database();

$customerClass = new Customer($databaseClass->connect());

$id = $_GET['id'];

if (!isset($id) || $id == '') {
    header('Location: index.php');
}

$customer = $customerClass->getCustomerById($id);

if (isset($_POST['submit'])) {

    $data = $_POST;

    $data = array_merge($data, $_FILES);

    $result = $customerClass->update($data, $id);

    if ($result) {
        $_SESSION['success'] = 'Customer updated successfully';
    } else {
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
                <h1 class="sticky-top" style="height: 50px;background-color:#fff">Customer Edit
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary mx-2" style="float: right;">
                    <a href="./index.php" class="btn btn-primary " style="float: right;">Back</a>
                </h1>
                <hr>
                <div style="border:2px solid #dee2e6; padding:20px">

                    <div class="mb-3 row">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $customer['first_name'] ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $customer['last_name'] ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" value="<?= $customer['email'] ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="image" class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image" id="image" value="">
                            <div class="mt-4">
                                <img src="../<?= $customer['image_path'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../../layouts/footer.php'; ?>