<?php
session_start();

include 'conn.php';
function totalCart()
{

    $total = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total = $total + ($price * $quantity);
    }
    $_SESSION['total'] = $total;
}

if (isset($_POST['add_to_cart'])) {

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    if (isset($_SESSION['cart'])) {
        $product_array_ids = array_column($_SESSION['cart'], "product_id");
        if (!in_array($_POST['product_id'], $product_array_ids)) {
            //if product is in cart
            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_img' => $_POST['product_img'],
                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            //redirect if it is
            echo '<script>alert("Product already in cart")</script>';
        }
    } else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_img' => $product_img,
            'product_quantity' => $product_quantity,
        );
        $_SESSION['cart'][$product_id] = $product_array;
    }
    totalCart();
} else if (isset($_POST['remove_product'])) {

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    totalCart();
} else if (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = $_SESSION['cart'][$product_id];

    $product_array['product_quantity'] = $product_quantity;

    $_SESSION['cart'][$product_id] = $product_array;

    totalCart();
} else {
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <?php if (!empty($_SESSION['cart'])) { ?>
        <section class="cart container my-5 pb-5">
            <div class="container mt-5">
                <h2 class="font-weight-bolde">Your Cart</h2>
                <hr>
            </div>

            <table class="mt-5 pt-5">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                <?php if (isset($_SESSION['cart'])) { ?>
                    <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="./assets/prod/<?php echo $value['product_img'] ?>" alt="">
                                    <div>
                                        <p><?php echo $value['product_name'] ?></p>
                                        <small><span>$</span><?php echo $value['product_price'] ?></small>
                                        <br>
                                        <form method="POST" action="cart.php">
                                            <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                            <input type="submit" name="remove_product" class="remove-btn" value="remove">
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'] ?>">
                                    <input type="submit" class="edit-btn" value="edit" name="edit_quantity">
                                </form>
                            </td>
                            <td>
                                <span>$</span>
                                <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price'];  ?></span>
                            </td>
                        </tr>
                <?php }
                } ?>

            </table>


            <div class="cart-total">
                <table>
                    <tr>
                        <td>Total Amount</td>
                        <?php if (isset($_SESSION["cart"]) && isset($_SESSION["total"])) { ?>
                            <td>$ <?php echo $_SESSION['total']; ?></td>
                        <?php } ?>
                    </tr>
                </table>
            </div>


            <div class="checkout-container">
                <form action="checkout.php" method="POST">
                    <input type="submit" value="Checkout" name="checkout" class="btn checkout-btn">
                </form>
            </div>
        </section>
    <?php } else { ?>
        <div class="container mt-5 text-center py-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr class="mx-auto">
            <p class="text-center py-5 mb-5">Cart is empty</p>
        </div>
    <?php } ?>





    <?php include 'footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

</html>