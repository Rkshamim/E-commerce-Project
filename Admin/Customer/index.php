<?php require_once '../../layouts/header.php'; ?>
<?php require_once '../../layouts/navigation.php'; ?>

<?php 
    spl_autoload_register(function($class){
        require '../classes/'.$class.'.php';
    });

    $databaseClass = new Database();
    
    $customerClass = new Customer($databaseClass->connect());

    $customers = $customerClass->getAllCustomers();
?>

<div class="container  mb-4">
    <div class="container mt-2  mb-2">
        <div class="row">
            <div class="col-sm-2">
                <?php require_once '../layouts/sidebar.php'; ?>
            </div>
            <div class="col-sm-10">
                <h1>Customer
                    <a href="create.php" class="btn btn-primary" style="float:right">Create Customer</a>
                </h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">S No</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customers as $key => $customer): ?>
                        <tr>
                            <th scope="row"><?=$key+1?></th>
                            <td><?=$customer['first_name']?></td>
                            <td><?=$customer['last_name']?></td>
                            <td><?=$customer['email']?></td>
                            <td>
                            <a href="./edit.php?id=<?=$customer['id']?>" class="btn btn-primary">Edit</a>
                                <a 
                                    href="./delete.php?id=<?=$customer['id']?>"  
                                    onclick="deleteRecord(event)" 
                                    class="btn btn-primary">
                                        Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php require_once '../../layouts/footer.php'; ?>