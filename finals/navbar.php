<?php
include 'conn.php';
include 'function.php';

$loggedin = check_login($conn);

if ($loggedin) {
    $firstname = $loggedin['first_name'];
}
?>
<header class="welcome">
    <?php if ($loggedin) : ?>
        <span>Welcome, <?php echo $loggedin['first_name']; ?></span>
        <div class="dropdown">
            <a class="my-account dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">My Account</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="redi_user.php">Profile</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>
    <?php else : ?>
        <span>Welcome,</span>
        <a href="redi_user.php" class="login-btn">Login</a>
    <?php endif; ?>
</header>


<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container">
        <a href="index.php"><img src="assets/images/logo.jpg" alt="logo" style="width: 50px; margin-right: 16px;"></a>
        <h1 style="font-family: Verdana, sans-serif;">Sole<span>Hub</span></h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 navb">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#aboutus">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link"> <i class="icolor fa-solid fa-cart-shopping"></i></a>
                </li>

            </ul>
        </div>
    </div>
</nav>