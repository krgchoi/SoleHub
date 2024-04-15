<?php
include 'conn.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["psw"];

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM tbl_users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['pass'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Invalid Password Please try again!");</script>';
        }
    } else {
        echo '<script>alert("Email does not exist");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/login.css">
</head>

<body class="bg-light">



    <body class="bg-light">
        <div class="container px-4 py-5 mx-auto">
            <div class="card card0">
                <form method="POST">
                    <div class="d-flex flex-lg-row flex-column-reverse">
                        <div class="card card1">
                            <div class="row justify-content-center my-auto">
                                <div class="col-md-8 col-10 my-5">
                                    <div class="row justify-content-center mb-3 image-link text-center">
                                        <a href="index.php">
                                            <img id="logo" src="./assets/images/logo.jpg" alt="Logo">
                                        </a>
                                    </div>
                                    <h3 class="mb-5 text-center heading">SoleHub</h3>
                                    <h6 class="msg-info">Please login to your account</h6>
                                    <div class="form-group">
                                        <label class="form-control-label text-muted">Email</label>
                                        <input type="text" id="email" name="email" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label text-muted">Password</label>
                                        <input type="password" id="psw" name="psw" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="row justify-content-center my-3 px-3">
                                        <button type="submit" name="login" class="btn-block btn-color">Login</button>
                                    </div>
                                    <div class="row justify-content-center my-2">
                                        <a href="#"><small class="text-muted">Forgot Password?</small></a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom text-center mb-5">
                                <p href="#" class="sm-text mx-auto mb-3 pad">Don't have an account? &nbsp;&nbsp;<a href="registration_form.php" class="btn btn-white ml-2">Create new</a></p>
                            </div>
                        </div>
                        <div class="card card2">
                            <div class="my-auto mx-md-5 px-md-5 right">
                                <h3 class="text-white">Welcome</h3> <small class="text-white">Quality Footwear, Unbeatable Prices: Find Your Perfect Pair..</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    </body>

</html>