<?php

session_start();

include 'conn.php';

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    $order_id =  $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items where order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    $order_details = $stmt->get_result();

    $total_order = totalOrder($order_details);
} else {
    header("location: index.php");
    exit();
}

function totalOrder($order_details)
{

    $total = 0;
    foreach ($order_details as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total = $total + ($product_price * $product_quantity);
    }
    return $total;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="orders container my-5 pb-5" id="orders">
        <div class="container mt-5">
            <h3>Your Orders</h3>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php foreach ($order_details as $row) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="./assets/prod/<?php echo $row['product_img']; ?>" alt="">
                            <p class="mt-3"><?php echo $row['product_name']; ?></p>
                        </div>
                    </td>
                    <td>
                        <span>₱<?php echo $row['product_price']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['product_quantity']; ?></span>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php if ($order_status == "not paid") { ?>

            <form action="payment.php" style="float: right;" method="POST">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <input type="hidden" name="total_order" value="<?php echo $total_order; ?>" />
                <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" />
                <input type="submit" name="order_pay_btn" value="Pay Now" class="btn btn-primary">
            </form>

        <?php } ?>
    </section>


    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>