<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>ShopYard, the Fashion Store</title>
    <!--Bootstrap library css cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome library for all the modern project icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Bootstrap js library cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- StyleSheets -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-------------------------- JS Scripts ---------------------------------->
    <script src="js/nav-drawer.js"></script>
    <!------------------------------------------------------------------------>

    <!-------- Header (Toolbar & Navigation Bar)------------>
    <?php
        include 'common/header.html';
    ?>

    <!-- Banner Carousel -->
    <div class="banner">
        <div id="banner-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#banner-carousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#banner-carousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#banner-carousel" data-bs-slide-to="2"></li>
                <li data-bs-target="#banner-carousel" data-bs-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/img-2.jpeg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="img/img-3.jpeg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="img/img-1.jpeg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="img/img-4.jpeg" class="d-block w-100">
                </div>
            </div>
            <a class="carousel-control-prev" href="#banner-carousel" role="button" data-bs-slide="prev">
                <i class="fa fa-chevron-left"></i>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#banner-carousel" role="button" data-bs-slide="next">
                <i class="fa fa-chevron-right"></i>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <?php
        include 'common/footer.html';
    ?>
</body>

</html>
