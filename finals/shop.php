<?php
session_start();

include 'conn.php';


if (isset($_POST['submit_search'])) {

    $category = $_POST['category'];
    $price = $_POST['price'];


    if ($category == 'all') {
        $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE product_price<=?");
        $stmt->bind_param("i", $price);
        $stmt->execute();
        $products = $stmt->get_result();
    } else {
        $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE (product_brand=? OR product_category=?) AND product_price<=?");
        $stmt->bind_param("ssi", $category, $category, $price);
        $stmt->execute();
        $products = $stmt->get_result();
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_products");

    $stmt->execute();

    $products = $stmt->get_result();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/main.css">
    <style>
        .container-fluid {
            display: flex;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container-fluid">
        <section id="search" class="my-5 ms-2">
            <div class="container">
                <p>Search Products</p>
                <hr>
            </div>
            <form action="shop.php" method="POST">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>Category</p>
                        <div class="form-check">
                            <input type="radio" value="all" name="category" id="category_one" class="form-check-input" <?php if (isset($category) && $category == 'all') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                All
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="radio" value="nike" name="category" id="category_one" class="form-check-input" <?php if (isset($category) && $category == 'nike') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Nike
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="radio" value="adidas" name="category" id="category_two" class="form-check-input" <?php if (isset($category) && $category == 'adidas') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Adidas
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="radio" value="vans" name="category" id="category_two" class="form-check-input" <?php if (isset($category) && $category == 'vans') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Vans
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="radio" value="puma" name="category" id="category_two" class="form-check-input" <?php if (isset($category) && $category == 'puma') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Puma
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="radio" value="men" name="category" id="category_men" class="form-check-input" <?php if (isset($category) && $category == 'men') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label" for="category_men">
                                Men
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="radio" value="women" name="category" id="category_women" class="form-check-input" <?php if (isset($category) && $category == 'women') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                            <label class="form-check-label" for="category_women">
                                Women
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="radio" value="kids" name="category" id="category_kids" class="form-check-input" <?php if (isset($category) && $category == 'kids') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                            <label class="form-check-label" for="category_kids">
                                Kids
                            </label>
                        </div>

                    </div>
                </div>

                <div class="row mx-auto container mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>Price</p>
                        <input type="range" class="form-range w-50" min="1" max="5000" id="customRange2" name="price" value="<?php if (isset($price)) {
                                                                                                                                    echo $price;
                                                                                                                                } else {
                                                                                                                                    echo "100";
                                                                                                                                } ?>">
                        <div class="w-50">
                            <span style="float: left;">1</span>
                            <input type="text" class="form-control" id="rangeValue" readonly style="width: 50%; float: right;" value="<?php if (isset($price)) {
                                                                                                                                            echo $price;
                                                                                                                                        } else {
                                                                                                                                            echo "100";
                                                                                                                                        } ?>">
                        </div>
                    </div>
                </div>


                <div class="form-group my-3 mx-3">
                    <input type="submit" name="submit_search" value="Search" class="btn btn-primary">
                </div>
            </form>
        </section>

        <section id="products" class="my-5">
            <div class="container">
                <h3>Products</h3>
                <hr class=>
            </div>
            <div class="row col-md mx-auto container-fluid">
                <?php foreach ($products as $product) { ?>
                    <div class="product col-lg-3 col-md-4 col-sm-12 text-center">
                        <img class="img-fluid mb-3" src="./assets/prod/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="p-name"><?php echo $product['product_name']; ?></h5>
                        <h4 class="p-rice">$<?php echo $product['product_price']; ?></h4>
                        <a href="<?php echo "single_product.php?product_id=" . $product['product_id']; ?>"><button class="button shop-buy-btn">Buy Now</button></a>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>

    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        var rangeInput = document.getElementById('customRange2');
        var rangeValue = document.getElementById('rangeValue');

        rangeInput.addEventListener('input', function() {
            rangeValue.value = this.value;
        });
    </script>
</body>

</html>