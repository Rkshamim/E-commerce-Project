<?php require_once '../../layouts/header.php'; ?>
<?php require_once '../../layouts/navigation.php'; ?>

<div class="container  mb-4">

    <div class="row">
        <div class="col-sm-2">
            <?php require_once '../layouts/sidebar.php'; ?>
        </div>
        <div class="col-sm-10">
            <h1>Order</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">S No</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>#212121</td>
                        <td>$19.25</td>
                        <td><a href="#" class="btn btn-primary">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../layouts/footer.php'; ?>