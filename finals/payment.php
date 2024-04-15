<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

include 'conn.php';

if (isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];
    $total_order = $_POST['total_order'];
}

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


    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">
            <!-- for order_details -->
            <?php if (isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
                <?php $amount = strval($_POST['total_order']); ?>
                <?php $order_id = $_SESSION['order_id']; ?>
                <p>Total Payment: <?php echo $_POST['total_order']; ?></p>
                <div class="d-flex justify-content-center">
                    <div id="paypal-button-container"></div>
                    <p id="result-message"></p>
                </div>
                <!-- for cart -->
            <?php } elseif (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
                <?php $amount = strval($_SESSION['total']); ?>
                <?php $order_id = $_SESSION['order_id']; ?>
                <p>Total Payment: ₱<?php echo $_SESSION['total']; ?></p>
                <div class="d-flex justify-content-center">
                    <div id="paypal-button-container"></div>
                    <p id="result-message"></p>
                </div>

            <?php } else { ?>
                <p>You dont have an Order</p>
            <?php }  ?>
        </div>
    </section>
    <?php include 'footer.php' ?>
    <script src="https://www.paypal.com/sdk/js?client-id=AXoknVjEfnIJkdqB7LaIP1EnWFHrVGrsvaYf--Ys0ZF6WCCvoDrV9GxbFKM2X24e4Gt9UIHfjAki90G7&currency=USD"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $amount; ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                    window.location.href = "compelete_payment.php?transaction_id=" + transaction.id + "&order_id=" +
                        <?php echo $order_id; ?>;
                });
            }
        }).render('#paypal-button-container');
    </script>

</body>

</html>