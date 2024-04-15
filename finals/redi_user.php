<?php
session_start();

include 'conn.php';
include 'function.php';

$user_data = check_login($conn);


if ($user_data) {
    if ($user_data['typed'] == 'g') {
        header("Location: dash_guest.php");
        die;
    } elseif ($user_data['typed'] == 'a') {
        header("Location: dash_admin.php");
        die;
    }
} else {
    header("Location: login.php");
    die;
}
