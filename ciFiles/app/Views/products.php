<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="<?php echo site_url("assets/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/app.min.css"); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


</head>
<body>


    <main class="page-content" id="products" style="margin: 3em 0;">

        <div class="container">

            <h1 class="page-title">Products</h1>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
            Add Product
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open(site_url("add-product-exe"),array("id"=>"addProductForm")); ?>

                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input required class="form-control" type="text" name="product_name" id="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product Price in INR</label>
                                    <input required class="form-control" type="text" name="product_price" id="product_price">
                                </div>
                                <div class="form-group">
                                    <label for="product_description">Product Description</label>
                                    <textarea required class="form-control" name="product_description" id="product_description" class="product_description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="product_images">Product images</label>
                                    <input required class="form-control" type="file" name="product_images[]" accept="image/*" id="product_images" multiple>
                                </div>

                                <button type="submit" class="btn btn-success">Add Product</button>



                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table">
                
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Featured Image</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsBox">
                        <?php foreach($products as $product): $productImages = json_decode($product["product_images"]); ?>

                        <tr>

                            <td><?php echo $product["product_name"]; ?></td>
                            <td class="w-25"><img src="<?php echo site_url("assets/images/".$productImages[0]); ?>" style="width: 20%;"></td>
                            <td>₹ <?php echo $product["product_price"]; ?></td>
                            <td><?php echo $product["product_description"]; ?></td>
                            <td>

                                <a class="btn btn-primary" href="<?php echo site_url("product/".$product["uid"]); ?>">
                                    View Details
                                </a>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editProductModal-<?php echo $product["uid"]; ?>">
                                Edit
                                </button>

                                <div class="modal fade" id="editProductModal-<?php echo $product["uid"]; ?>" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addProductModalLabel">Edit Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open(site_url("update-product-exe"),array("class"=>"updateform")); ?>

                                                    <input type="hidden" name="pid" value="<?php echo $product["id"]; ?>">

                                                    <div class="form-group">
                                                        <label for="product_name">Product Name</label>
                                                        <input class="form-control" type="text" name="product_name" value="<?php echo $product["product_name"]; ?>" id="product_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_price">Product Price in INR</label>
                                                        <input class="form-control" value="<?php echo $product["product_price"]; ?>" type="text" name="product_price" id="product_price">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_description">Product Description</label>
                                                        <textarea class="form-control" name="product_description" id="product_description" class="product_description"><?php echo $product["product_description"]; ?></textarea>
                                                    </div>



                                                    <div class="form-group">
                                                        <label for="product_images">Replace Product images</label>
                                                        <input class="form-control" type="file" name="product_images[]" accept="image/*" id="product_images" multiple>
                                                    </div>

                                                    <button type="submit" class="btn btn-success">Update Product</button>



                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php echo form_open(site_url("delete-product-exe"),array("class"=>"deleteProdForm")); ?>
                                <input type="hidden" name="pid" value="<?php echo $product["id"]; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <?php echo form_close(); ?>

                            </td>

                        </tr>

                        <?php endforeach; ?>
                </table>
            </div>
            

           
        </div>

    </main>




    <script src="<?php echo site_url("assets/js/jquery.min.js"); ?>"></script>
    <script src="<?php echo site_url("assets/js/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo site_url("assets/js/products.min.js"); ?>"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


    <script>

        function fetchAllProductsJson(){

            $.ajax({
                type: "GET",
                url: "<?php echo site_url("fetch-all-products-html"); ?>",
                success: function (response) {
                    
                    $("tbody#productsBox").html(response);
                }
            });

        }


        $("form#addProductForm").submit(function (e) { 
            e.preventDefault();

            let formData = new FormData(this);


            $.ajax({
                type: $(this).attr("method"),
                url: $(this).attr("action"),
                data: formData,
                processData: false,
                cache: false,
                contentType: false, 
                success: function (response) {

                    if (response=="success") {
                
                        Toastify({
                        text: "Product Added successfully",
                        duration: 3000,
                        // destination: "https://github.com/apvarun/toastify-js",
                        // newWindow: true,
                        // close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        // stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#03c03c",
                        },
                        // onClick: function(){} // Callback after click
                        }).showToast();



                        fetchAllProductsJson();

                        $('#addProductModal').modal('hide')


                    } else {
                        
                        Toastify({
                        text: "Product not added",
                        duration: 3000,
                        // destination: "https://github.com/apvarun/toastify-js",
                        // newWindow: true,
                        // close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        // stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#FF6961",
                        },
                        // onClick: function(){} // Callback after click
                        }).showToast();


                    }

                }
            });

            
        });

        $("body").on('submit', 'form.updateform', function(e) {

            e.preventDefault();
            
            let formData = new FormData(this);


            $.ajax({
                type: $(this).attr("method"),
                url: $(this).attr("action"),
                data: formData,
                processData: false,
                cache: false,
                contentType: false, 
                success: function (response) {



                    if (response=="success") {
                
                        Toastify({
                        text: "Product Updated successfully",
                        duration: 3000,
                        // destination: "https://github.com/apvarun/toastify-js",
                        // newWindow: true,
                        // close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        // stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#03c03c",
                        },
                        // onClick: function(){} // Callback after click
                        }).showToast();



                        fetchAllProductsJson();

                        $('.modal').modal('hide')


                    } else {
                        
                        Toastify({
                        text: "Product not updated",
                        duration: 3000,
                        // destination: "https://github.com/apvarun/toastify-js",
                        // newWindow: true,
                        // close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        // stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#FF6961",
                        },
                        // onClick: function(){} // Callback after click
                        }).showToast();


                    }

                }
            });

            
        });

        $("body").on('submit', 'form.deleteProdForm', function(e) {
            
            e.preventDefault();

            let formData = new FormData(this);


            $.ajax({
                type: $(this).attr("method"),
                url: $(this).attr("action"),
                data: formData,
                processData: false,
                cache: false,
                contentType: false, 
                success: function (response) {



                    if (response=="success") {
                
                        Toastify({
                        text: "Product deleted successfully",
                        duration: 3000,
                        // destination: "https://github.com/apvarun/toastify-js",
                        // newWindow: true,
                        // close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        // stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#03c03c",
                        },
                        // onClick: function(){} // Callback after click
                        }).showToast();



                        fetchAllProductsJson();

                        $('.modal').modal('hide')


                    } else {
                        
                        Toastify({
                        text: "Product not deleted",
                        duration: 3000,
                        // destination: "https://github.com/apvarun/toastify-js",
                        // newWindow: true,
                        // close: true,
                        gravity: "bottom", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        // stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#FF6961",
                        },
                        // onClick: function(){} // Callback after click
                        }).showToast();


                    }

                }
            });
            
        });
        
        






    </script>

</body>
</html>