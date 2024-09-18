<?php require_once '../../layouts/header.php'; ?>
<?php require_once '../../layouts/navigation.php'; ?>

<?php 
    spl_autoload_register(function($class){
        require '../classes/'.$class.'.php';
    });

    $databaseClass = new Database();
    
    $customerClass = new Customer($databaseClass->connect());

    if(isset($_POST['submit'])) {  

        $data = $_POST;    

        $data = array_merge($data, $_FILES);

        $result = $customerClass->store($data);

        if($result) {
            $_SESSION['success'] = 'Customer created successfully';
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
                <h1 class="sticky-top" style="height: 50px;background-color:#fff">Customer Create

                    <input type="submit" name="submit" value="Submit" class="btn btn-primary mx-2" style="float: right;">
                    <a href="./index.php" class="btn btn-primary " style="float: right;">Back</a>
                </h1>
                <hr>
                <div style="border:2px solid #dee2e6; padding:20px">

                    <div class="mb-3 row">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="first_name" id="first_name" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select name="role" id="role" class="form-control">
                                <option value="1">Admin</option>
                                <option value="0">Customer</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="image" class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image" id="image" value="">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../../layouts/footer.php'; ?>