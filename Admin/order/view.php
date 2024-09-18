<?php require_once '../../layouts/header.php'; ?>
<?php require_once '../../layouts/navigation.php'; ?>

<div class="container mt-2 mb-2">
    <div class="row">
        <div class="col-sm-2">
            <?php require_once '../layouts/sidebar.php'; ?>
        </div>
        <div class="col-sm-10">
            <h1>Order id</h1>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Order Summary
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    Order Created On
                                </div>
                                <div class="col-sm-9">
                                    12-10-2022
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item mt-2">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Shipping Details
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-group">
                                        <li class="list-group-item active" aria-current="true">Billing Details</li>
                                        <li class="list-group-item">A - 43 Sector 16 </li>
                                        <li class="list-group-item">noida</li>
                                        <li class="list-group-item">Uttar Pardesh</li>
                                        <li class="list-group-item">201301</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-group">
                                        <li class="list-group-item active" aria-current="true">Shipping Details</li>
                                        <li class="list-group-item">A - 43 Sector 16 </li>
                                        <li class="list-group-item">noida</li>
                                        <li class="list-group-item">Uttar Pardesh</li>
                                        <li class="list-group-item">201301</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item mt-2">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Product Details
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">S No</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>
                                            <img src="https://via.placeholder.com/50/0000FF/808080?Text=Digital.com" alt="">
                                        </td>
                                        <td>Product Name</td>
                                        <td>$19.25</td>
                                        <td>10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../layouts/footer.php'; ?>