<?php
session_start();

include 'conn.php';
include 'function.php';

function random_num($length)
{
    $text = "";
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['create_account'])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $gender = $_POST["gender"];
    $contact_number = $_POST["contact_number"];
    $user_id = random_num(10);
    $typed = 'g';

    $check = "SELECT * FROM tbl_users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $check);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        echo '<script>alert("Email already exists, please choose another email.");</script>';
    } else {
        $statement = "INSERT INTO tbl_users (user_id,first_name, last_name, email, pass, gender, contact_number,typed)
            VALUES 
            ('$user_id','$first_name', '$last_name','$email','$hashed_password','$gender','$contact_number','$typed')";

        if (mysqli_query($conn, $statement)) {
            echo '<script>alert("Register Successfully");</script>';
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $statement . "<br>" . mysqli_error($conn);
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/login.css"> <!-- Assuming you want to use the same CSS file -->
</head>

<body class="bg-light">
    <div class="container px-4 py-5 mx-auto">
        <div class="card card0">
            <form action="registration_form.php" method="post">
                <div class="d-flex flex-lg-row flex-column-reverse">
                    <div class="card card2">
                        <div class="my-auto mx-md-5 px-md-5 right">
                            <h3 class="text-white">Sign up Now</h3>
                            <small class="text-white">Quality Shoes, Affordable Prices. Step into Style Today!</small>
                        </div>
                    </div>
                    <div class="card card1">
                        <div class="row justify-content-center my-auto">
                            <div class="col-md-8 col-10 my-5">
                                <div class="row justify-content-center mb-3 image-link text-center">
                                    <a href="index.php">
                                        <img id="logo" src="./assets/images/logo.jpg" alt="Logo">
                                    </a>
                                </div>
                                <h3 class="mb-5 text-center heading">SoleHub</h3>
                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required>
                                </div>
                                <div class="input-group mb-3">

                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                                </div>
                                <div class="input-group mb-3">

                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                </div>
                                <div class="input-group mb-3">

                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                </div>
                                <div class="form-check form-check-inline mt-3 mb-3">
                                    <input class="form-check-input" type="radio" name="gender" id="male_gender" value="Male">
                                    <label class="form-check-label" for="male_gender">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female_gender" value="Female">
                                    <label class="form-check-label" for="female_gender">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other_gender" value="Other">
                                    <label class="form-check-label" for="other_gender">
                                        Other
                                    </label>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" required>
                                </div>

                                <div class="row justify-content-center my-3 px-3">
                                    <button type="submit" class="btn-block btn-color" name="create_account">Signup Now</button>
                                </div>

                                <div class="d-grid mb-3">
                                    <p class="text-center">
                                        Already have an Account? <a href="login.php">Login here</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bottom text-center mb-5">
                            <p href="#" class="sm-text mx-auto mb-3 pad">Already have an Account? &nbsp;&nbsp;<a href="login.php" class="btn btn-white ml-2">Login here</a></p>
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