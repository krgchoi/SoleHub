<?php
session_start();

include 'conn.php';

$w_stmt = $conn->prepare("SELECT * FROM tbl_products WHERE product_featured = 'f' AND product_category ='women' LIMIT 4");
$w_stmt->execute();
$w_featured_products = $w_stmt->get_result();

$m_stmt = $conn->prepare("SELECT * FROM tbl_products WHERE product_featured = 'f' AND product_category ='men' LIMIT 4");
$m_stmt->execute();
$m_featured_products = $m_stmt->get_result();

$k_stmt = $conn->prepare("SELECT * FROM tbl_products WHERE product_featured = 'f' AND product_category ='kids' LIMIT 4");
$k_stmt->execute();
$k_featured_products = $k_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>SoleHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS!</h5>
            <h1><span>Best Prices</span> This Season</h1>
            <p>Shop offers the best products for the most affordable prices </p>
            <a href="shop.php"><button>SHOP NOW</button></a>
        </div>
    </section>

    <section id="brand" class="container">
        <div class="row">
            <img src="./assets/brand1.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="./assets/brand2.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="./assets/brand3.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="./assets/brand4.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        </div>
    </section>

    <section id="womens" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Women's</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
            <?php while ($row = $w_featured_products->fetch_assoc()) { ?>
                <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
                    <img class="img-fluid mb-3" src="./assets/prod/<?php echo $row['product_img'] ?>" alt="<?php echo $row['product_name'] ?>">
                    <div class="star">
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <i class="fas fa-star"></i>
                        <?php } ?>
                    </div>
                    <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
                    <h4 class="p-price">₱<?php echo $row['product_price'] ?></h4>
                    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
                        <button class="buy-btn">Buy Now</button>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>

    <section id="mens" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Men's</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
            <?php while ($row = $m_featured_products->fetch_assoc()) { ?>
                <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
                    <img class="img-fluid mb-3" src="./assets/prod/<?php echo $row['product_img'] ?>" alt="<?php echo $row['product_name'] ?>">
                    <div class="star">
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <i class="fas fa-star"></i>
                        <?php } ?>
                    </div>
                    <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
                    <h4 class="p-price">₱<?php echo $row['product_price'] ?></h4>
                    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
                        <button class="buy-btn">Buy Now</button>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>

    <section id="kids" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Kids'</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
            <?php while ($row = $k_featured_products->fetch_assoc()) { ?>
                <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
                    <img class="img-fluid mb-3" src="./assets/prod/<?php echo $row['product_img'] ?>" alt="<?php echo $row['product_name'] ?>">
                    <div class="star">
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <i class="fas fa-star"></i>
                        <?php } ?>
                    </div>
                    <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
                    <h4 class="p-price">₱<?php echo $row['product_price'] ?></h4>
                    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
                        <button class="buy-btn">Buy Now</button>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>


    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>Exclusive Deals Just for You!</h4>
            <h2><span>Amazing Discounts</span> Await You!</h2>
            <p>Discover exclusive deals on top brands and styles.</p>
            <a href="shop.php"><button>SHOP NOW</button></a>
        </div>
    </section>
    <section id="aboutus">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <img src="./assets/images/logo.jpg" alt="About Us Image" class="img-fluid mx-auto d-block mb-2" style="margin-left:auto; margin-right:auto; width: 50%">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="container text-center ">
                        <h3>About SoleHub</h3>
                        <hr class="mx-auto">
                    </div>
                    <p class="text-center">
                        Welcome to SoleHub, your ultimate destination for stylish and comfortable footwear! We are a passionate team of shoe enthusiasts dedicated to providing top-quality footwear to customers worldwide.
                    </p>
                    <p class="text-center">
                        At SoleHub, our mission is to offer the latest trends in footwear while prioritizing comfort, style, and affordability. We believe that everyone deserves to step out in confidence, and our curated collection reflects our commitment to delivering shoes that empower you to look and feel your best. </p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>