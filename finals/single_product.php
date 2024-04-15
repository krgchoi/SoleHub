<?php
session_start();

include 'conn.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE product_id =?");
    $stmt->bind_param("i", $product_id);

    $stmt->execute();

    $product = $stmt->get_result();

    $product_row = $product->fetch_assoc();
} else {
    header('location:index.php');
}

$product_title = $product_row['product_name']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title><?php echo $product_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <section class="container single-product my-5">
        <div class="row mt-5">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img src="./assets/prod/<?php echo $product_row['product_img'] ?>" alt="" class="img-fluid w-100 pb-1">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h3 class="py-4"><?php echo $product_row['product_name'] ?></h3>
                <h2>₱<?php echo $product_row['product_price'] ?></h2>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product_row['product_id'] ?>">
                    <input type="hidden" name="product_img" value="<?php echo $product_row['product_img'] ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product_row['product_name'] ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product_row['product_price'] ?>">

                    <input type="number" name="product_quantity" value="1">
                    <button type="submit" name="add_to_cart" class="buy-btn">Add To Cart</button>
                </form>

                <h4 class="mt-3 mb-3">Details</h4>
                <span><?php echo $product_row['product_description'] ?></span>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>