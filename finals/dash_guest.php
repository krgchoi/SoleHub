<?php
session_start();

include 'conn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM tbl_users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $contact_number = $row['contact_number'];
        $gender = $row['gender'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $contact_number = $_POST['contact_number'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $gender = $_POST['gender'];

        if ($password !== $confirm_password) {
            echo '<script>alert("Passwords do not match");</script>';
        } else {
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $update_query = "UPDATE tbl_users SET first_name = '$first_name', last_name = '$last_name', email = '$email', contact_number = '$contact_number', gender = '$gender', pass = '$hashed_password' WHERE user_id = $user_id";
            } else {
                $update_query = "UPDATE tbl_users SET first_name = '$first_name', last_name = '$last_name', email = '$email', contact_number = '$contact_number', gender = '$gender' WHERE user_id = $user_id";
            }

            if (mysqli_query($conn, $update_query)) {
                echo '<script>alert("Profile updated successfully");</script>';
            }
        }
    }

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $orders = $stmt->get_result();
} else {
    header("Location: login.php");
    exit();
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
    <div class="container text-center mt-5">
        <h3>Profile Settings</h3>
        <hr class="mx-auto">
    </div>
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold"><?php echo $first_name . " " . $last_name; ?></span>
                    <span class="text-black-50"><?php echo $email; ?></span>
                </div>
            </div>
            <div class="col-md border-right">
                <div class="p-3 py-5">
                    <form method="post" action="">
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>"></div>
                            <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" name="contact_number" value="<?php echo $contact_number; ?>"></div>
                            <div class="col-md-12"><label class="labels">Email Address</label><input type="text" class="form-control" name="email" value="<?php echo $email; ?>" readonly></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Password</label><input type="password" class="form-control" name="password" placeholder="Enter Password"></div>
                            <div class="col-md-12"><label class="labels">Confirm Password</label><input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="Male" <?php if ($gender === 'Male') echo 'selected'; ?>>Male</option>
                                    <option value="Female" <?php if ($gender === 'Female') echo 'selected'; ?>>Female</option>
                                    <option value="Other" <?php if ($gender === 'Other') echo 'selected'; ?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="update_profile">Save Profile</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="orders container my-5 pb-5">
        <div class="container text-center mt-5">
            <h3>Your Orders</h3>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Order ID</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Details</th>
            </tr>

            <?php while ($row = $orders->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <span><?php echo $row['order_id'] ?></span>
                    </td>
                    <td>
                        <span>₱<?php echo $row['order_cost'] ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_status'] ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_date'] ?></span>
                    </td>

                    <td>
                        <form method="POST" action="order_details.php">
                            <?php echo $row['order_id'] ?>
                            <input type="hidden" value="<?php echo $row['order_status'] ?>" name="order_status">
                            <input type="hidden" value="<?php echo $row['order_id'] ?>" name="order_id">
                            <input type="submit" value="details" class="btn order-details-btn" name="order_details_btn">
                        </form>
                    </td>
                </tr>

            <?php } ?>

        </table>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>