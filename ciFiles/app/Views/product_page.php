<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="<?php echo site_url("assets/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css" integrity="sha512-UiVP2uTd2EwFRqPM4IzVXuSFAzw+Vo84jxICHVbOA1VZFUyr4a6giD9O3uvGPFIuB2p3iTnfDVLnkdY7D/SJJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>


    <main class="page-content" id="products" style="margin: 3em 0;">

        <div class="container text-center">


            <a href="<?php echo site_url(); ?>">Back to Products</a>

            <?php $productImages = json_decode($pdata["product_images"],TRUE); ?>

            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12"></div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="<?php echo site_url("assets/images/".$productImages[0]) ?>" class="w-100">
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12"></div>
            </div>

            <h1 class="product-title"><?php echo $pdata["product_name"]; ?></h1>

            <h4>₹ <?php echo $pdata["product_price"]; ?></h4>


            <h5>Click to Zoom</h5>
            <?php foreach($productImages as $pi): ?>
                <a data-lity href="<?php echo site_url("assets/images/".$pi); ?>">
                <img src="<?php echo site_url("assets/images/".$pi); ?>" style="width: 10%;">
                </a>
            <?php endforeach; ?>
           


        </div>

    </main>




    <script src="<?php echo site_url("assets/js/jquery.min.js"); ?>"></script>
    <script src="<?php echo site_url("assets/js/bootstrap.min.js"); ?>"></script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js" integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        

</body>
</html>