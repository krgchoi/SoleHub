<?php

session_start();

include 'conn.php';


if (isset($_POST['place_order'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders(order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                    VALUES(?,?,?,?,?,?,? );");

    $stmt->bind_param('isissss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

    $protect = $stmt->execute();
    if (!$protect) {
        header('location: login.php');
        exit();
    }

    $order_id = $stmt->insert_id;


    //get products
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_img = $product['product_img'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        $items = $conn->prepare("INSERT into order_items(order_id,product_id,product_name,product_img,product_price,product_quantity,user_id,order_date)
                        VALUES(?,?,?,?,?,?,?,?)");

        $items->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_img, $product_price, $product_quantity, $user_id, $order_date);

        $items->execute();
    }
    $_SESSION['order_id'] = $order_id;
    unset($_SESSION['cart']);

    header('location: payment.php?order_status=order place successfully');
}
