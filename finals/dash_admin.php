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

$user_data = check_login($conn);


//user

$user_table = "<div class='mt-3 py-5'>
<div class='mt-3 mb-3'>
                        <form method='POST'>
                            <div class='input-group'>
                                <input type='text' class='form-control' placeholder='Search by User ID' name='search_user_id'>
                                <button type='submit' class='btn btn-primary'>Search</button>
                            </div>
                        </form>
                    </div>
                    <h3 class='fw-bold fs-4'>User Table <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#adduser'>Add User</button></h3>                  
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Contact Number</th>
                                <th>Type</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

if (isset($_POST['search_user_id'])) {
    $search_user_id = $_POST['search_user_id'];

    $user_query = "SELECT * FROM tbl_users WHERE user_id = '$search_user_id'";
    $user_result = mysqli_query($conn, $user_query);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        while ($row = mysqli_fetch_assoc($user_result)) {
            // Fetch user details
            $id = $row['id'];
            $user_id = $row['user_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $gender = $row['gender'];
            $contact_number = $row['contact_number'];
            $type = $row['typed'];
            $date_created = $row['date'];
            $formatted_date = date("m-d-Y", strtotime($date_created));

            // Display user details
            $user_table .= "<tr>
            <td>$id</td>
            <td>$user_id</td>
            <td>$first_name</td>
            <td>$last_name</td>
            <td>$email</td>
            <td>$gender</td>
            <td>$contact_number</td>
            <td>$type</td>
            <td>$formatted_date</td>
            <td>
                <div class='btn-group'>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateModal$user_id'>Update</button>
                    <form method='post'>
                        <input type='hidden' name='user_id' value='$user_id'>
                        <button type='submit' class='btn btn-danger' name='delete_user'>Delete</button>
                    </form>
                </div>
                <div class='modal fade' id='updateModal$user_id' tabindex='-1' aria-labelledby='updateModalLabel$user_id' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='updateModalLabel$user_id'>Update User Information</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form method='post' action='dash_admin.php'>
                                    <div class='mb-3'>
                                        <label for='update_firstname$user_id'>First Name</label>
                                        <input type='text' class='form-control' id='update_firstname$user_id' name='update_firstname' value='$first_name'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='update_lastname$user_id'>Last Name</label>
                                        <input type='text' class='form-control' id='update_lastname$user_id' name='update_lastname' value='$last_name'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='update_email$user_id'>Email</label>
                                        <input type='email' class='form-control' id='update_email$user_id' name='update_email' value='$email'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='update_contact$user_id'>Contact Number</label>
                                        <input type='text' class='form-control' id='update_contact$user_id' name='update_contact' value='$contact_number'>
                                    </div>
                                    <input type='hidden' name='user_id' value='$user_id'>
                                    <button type='submit' class='btn btn-primary' name='update_user'>Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>";
        }
    } else {
        $user_table .= "<tr><td colspan='10'>No users found</td></tr>";
    }
} else {
    // If search form is not submitted, display all users
    $user_query = "SELECT * FROM tbl_users";
    $user_result = mysqli_query($conn, $user_query);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        while ($row = mysqli_fetch_assoc($user_result)) {
            // Fetch user details
            $id = $row['id'];
            $user_id = $row['user_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $gender = $row['gender'];
            $contact_number = $row['contact_number'];
            $type = $row['typed'];
            $date_created = $row['date'];
            $formatted_date = date("m-d-Y", strtotime($date_created));

            // Display user details
            $user_table .= "<tr>
            <td>$id</td>
            <td>$user_id</td>
            <td>$first_name</td>
            <td>$last_name</td>
            <td>$email</td>
            <td>$gender</td>
            <td>$contact_number</td>
            <td>$type</td>
            <td>$formatted_date</td>
            <td>
                <div class='btn-group'>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateModal$user_id'>Update</button>
                    <form method='post'>
                        <input type='hidden' name='user_id' value='$user_id'>
                        <button type='submit' class='btn btn-danger' name='delete_user'>Delete</button>
                    </form>
                </div>
                <div class='modal fade' id='updateModal$user_id' tabindex='-1' aria-labelledby='updateModalLabel$user_id' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='updateModalLabel$user_id'>Update User Information</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form method='post' action='dash_admin.php'>
                                    <div class='mb-3'>
                                        <label for='update_firstname$user_id'>First Name</label>
                                        <input type='text' class='form-control' id='update_firstname$user_id' name='update_firstname' value='$first_name'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='update_lastname$user_id'>Last Name</label>
                                        <input type='text' class='form-control' id='update_lastname$user_id' name='update_lastname' value='$last_name'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='update_email$user_id'>Email</label>
                                        <input type='email' class='form-control' id='update_email$user_id' name='update_email' value='$email'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='update_contact$user_id'>Contact Number</label>
                                        <input type='text' class='form-control' id='update_contact$user_id' name='update_contact' value='$contact_number'>
                                    </div>
                                    <input type='hidden' name='user_id' value='$user_id'>
                                    <button type='submit' class='btn btn-primary' name='update_user'>Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>";
        }
    } else {
        $user_table .= "<tr><td colspan='10'>No users found</td></tr>";
    }
}
$user_table .= "</tbody></table></div>";

$add_user_modal = '
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="add_first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="add_first_name" name="add_first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="add_last_name" name="add_last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="add_email" name="add_email" required>
                    </div>
                    <div class="form-check form-check-inline mt-3 mb-3">
                            <input class="form-check-input" type="radio" name="add_gender" id="male_gender" value="Male">
                            <label class="form-check-label" for="male_gender">
                                Male
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="add_gender" id="female_gender" value="Female">
                            <label class="form-check-label" for="female_gender">
                                Female
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="add_gender" id="other_gender" value="Other">
                            <label class="form-check-label" for="other_gender">
                                Other
                            </label>
                        </div>
                    <div class="mb-3">
                        <label for="add_contact_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="add_contact_number" name="add_contact_number" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $delete_user_id = $_POST['user_id'];
    $delete_query = "DELETE FROM tbl_users WHERE user_id = '$delete_user_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo '<script>alert("User deleted successfully")';
        header("Location: " . $_SERVER['PHP_SELF'] . "?action=user");
        die;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $update_firstname = $_POST['update_firstname'];
    $update_lastname = $_POST['update_lastname'];
    $update_email = $_POST['update_email'];
    $update_contact = $_POST['update_contact'];
    $update_pass = "pass";
    $update_hashed_password = password_hash($update_pass, PASSWORD_DEFAULT);


    $update_query = "UPDATE tbl_users SET first_name = '$update_firstname', last_name = '$update_lastname', email = '$update_email', pass ='$update_hashed_password',  contact_number = '$update_contact' WHERE user_id = '$user_id'";

    if (mysqli_query($conn, $update_query)) {
        echo '<script>alert("User information updated successfully")';
        header("Location: " . $_SERVER['PHP_SELF'] . "?action=user");
        die;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $add_first_name = $_POST['add_first_name'];
    $add_last_name = $_POST['add_last_name'];
    $add_email = $_POST['add_email'];
    $add_contact_number = $_POST['add_contact_number'];
    $add_pass = 'pass';
    $hashed_password = password_hash($add_pass, PASSWORD_DEFAULT);
    $user_id = random_num(10);
    $typed = 'g';
    $add_gender = $_POST['add_gender'];

    $insert_query = "INSERT INTO tbl_users (user_id,first_name, last_name, email, pass, gender, contact_number,typed)
                    VALUES ('$user_id', '$add_first_name', '$add_last_name', '$add_email', '$hashed_password', '$add_gender', '$add_contact_number', '$type')";

    if (mysqli_query($conn, $insert_query)) {
        echo '<script>alert("User added successfully")</script>';
        header("Location: " . $_SERVER['PHP_SELF'] . "?action=user");
        die;
    }
}



//product
$product_table = "<div class='mt-3 py-5'>
                    <div class='mt-3 mb-3'>
                        <form method='POST'>
                            <div class='input-group'>
                                <input type='text' class='form-control' placeholder='Search by Product ID' name='search_product_id'>
                                <button type='submit' class='btn btn-primary'>Search</button>
                            </div>
                        </form>
                    </div>
                    <h3 class='fw-bold fs-4'>Product Table<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addproduct'>Add Product</button></h3>                
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Featured</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";


if (isset($_POST['search_product_id'])) {
    $search_product_id = $_POST['search_product_id'];

    $product_query = "SELECT * FROM tbl_products WHERE product_id = '$search_product_id'";
    $product_result = mysqli_query($conn, $product_query);

    if ($product_result && mysqli_num_rows($product_result) > 0) {
        while ($product_row = mysqli_fetch_assoc($product_result)) {
            $product_id = $product_row['product_id'];
            $product_name = $product_row['product_name'];
            $product_price = $product_row['product_price'];
            $product_img = $product_row['product_img'];
            $product_description = $product_row['product_description'];
            $product_category = $product_row['product_category'];
            $product_brand = $product_row['product_brand'];
            $product_featured = $product_row['product_featured'];

            $product_image_process = "<img src='./assets/prod/$product_img' style='max-width: 100px;'>";

            $product_table .= "<tr>
                                <td>$product_id</td>
                                <td>$product_name</td>
                                <td>$product_price</td>
                                <td>$product_image_process</td>
                                <td>$product_description</td>
                                <td>$product_category</td>
                                <td>$product_brand</td>
                                <td>$product_featured</td>
                                <td>
                                    <div class='btn-group'>
                                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateModal$product_id'>Update</button>
                                        <form method='post'>
                                            <input type='hidden' name='product_id' value='$product_id'>
                                            <button type='submit' class='btn btn-danger' name='delete_product'>Delete</button>
                                        </form>
                                    </div>
                                    <div class='modal fade' id='updateModal$product_id' tabindex='-1' aria-labelledby='updateModalLabel$product_id' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='updateModalLabel$product_id'>Update Product Information</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <form method='post' enctype='multipart/form-data' action='dash_admin.php'>
                                                        <div class='mb-3'>
                                                            <label for='update_product_name$product_id'>Product Name</label>
                                                            <input type='text' class='form-control' id='update_product_name$product_id' name='update_product_name' value='$product_name'>
                                                        </div>

                                                        <div class='mb-3'>
                                                            <label for='update_product_price$product_id'>Price</label>
                                                            <input type='number' class='form-control' id='update_product_price$product_id' name='update_product_price' value='$product_price'>
                                                        </div>

                                                        <div class='mb-3'>
                                                            <label for='update_product_description$product_id'>Description</label>
                                                            <textarea class='form-control' id='update_product_description$product_id' name='update_product_description' rows='3'>$product_description</textarea>
                                                        </div>
                                                    
                                                        <div class='mb-3'>
                                                            <label for='update_product_brand$product_id'>Brand</label>
                                                            <select class='form-select' id='update_product_brand$product_id' name='update_product_brand' required>
                                                                <option value='adidas' " . ($product_brand === 'adidas' ? 'selected' : '') . ">Adidas</option>
                                                                <option value='nike' " . ($product_brand === 'nike' ? 'selected' : '') . ">Nike</option>
                                                                <option value='puma' " . ($product_brand === 'puma' ? 'selected' : '') . ">Puma</option>
                                                                <option value='vans' " . ($product_brand === 'vans' ? 'selected' : '') . ">Vans</option>
                                                            </select>
                                                        
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='update_product_category$product_id'>Category</label>
                                                            <select class='form-select' id='update_product_category$product_id' name='update_product_category' required>
                                                                <option value='women' " . ($product_category === 'women' ? 'selected' : '') . ">Women</option>
                                                                <option value='men' " . ($product_category === 'men' ? 'selected' : '') . ">Men</option>
                                                                <option value='kids' " . ($product_category === 'kids' ? 'selected' : '') . ">Kids</option>
                                                            </select>
                                                        </div>
                    
                                                        <div class='mb-3'>
                                                            <label for='update_product_featured$product_id'>Featured</label>
                                                            <select class='form-select' id='update_product_featured$product_id' name='update_product_featured'>    
                                                                <option value='f' " . ($product_featured === 'f' ? 'selected' : '') . ">F</option>
                                                                <option value='s' " . ($product_featured === 's' ? 'selected' : '') . ">S</option>
                                                            </select>
                                                        </div>
                                        
                                                        <div class='mb-3'>
                                                            <label for='update_product_image$product_id'>Update Image</label>
                                                            <input type='file' class='form-control' id='update_product_image$product_id' name='update_product_image' accept='image/*'>
                                                        </div>
                                                        <input type='hidden' name='product_id' value='$product_id'>
                                                        <button type='submit' class='btn btn-primary' name='update_product'>Update Product</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
        }
    } else {
        $product_table .= "<tr><td colspan='9'>No products found</td></tr>";
    }
} else {
    $product_query = "SELECT * FROM tbl_products";
    $product_result = mysqli_query($conn, $product_query);

    if ($product_result && mysqli_num_rows($product_result) > 0) {
        while ($product_row = mysqli_fetch_assoc($product_result)) {
            $product_id = $product_row['product_id'];
            $product_name = $product_row['product_name'];
            $product_price = $product_row['product_price'];
            $product_img = $product_row['product_img'];
            $product_description = $product_row['product_description'];
            $product_category = $product_row['product_category'];
            $product_brand = $product_row['product_brand'];
            $product_featured = $product_row['product_featured'];

            $product_image_process = "<img src='./assets/prod/$product_img' style='max-width: 100px;'>";

            $product_table .= "<tr>
                                <td>$product_id</td>
                                <td>$product_name</td>
                                <td>$product_price</td>
                                <td>$product_image_process</td>
                                <td>$product_description</td>
                                <td>$product_category</td>
                                <td>$product_brand</td>
                                <td>$product_featured</td>
                                <td>
                                    <div class='btn-group'>
                                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateModal$product_id'>Update</button>
                                        <form method='post'>
                                            <input type='hidden' name='product_id' value='$product_id'>
                                            <button type='submit' class='btn btn-danger' name='delete_product'>Delete</button>
                                        </form>
                                    </div>
                                    <div class='modal fade' id='updateModal$product_id' tabindex='-1' aria-labelledby='updateModalLabel$product_id' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='updateModalLabel$product_id'>Update Product Information</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <form method='post' enctype='multipart/form-data' action='dash_admin.php'>
                                                        <div class='mb-3'>
                                                            <label for='update_product_name$product_id'>Product Name</label>
                                                            <input type='text' class='form-control' id='update_product_name$product_id' name='update_product_name' value='$product_name'>
                                                        </div>

                                                        <div class='mb-3'>
                                                            <label for='update_product_price$product_id'>Price</label>
                                                            <input type='number' class='form-control' id='update_product_price$product_id' name='update_product_price' value='$product_price'>
                                                        </div>

                                                        <div class='mb-3'>
                                                            <label for='update_product_description$product_id'>Description</label>
                                                            <textarea class='form-control' id='update_product_description$product_id' name='update_product_description' rows='3'>$product_description</textarea>
                                                        </div>
                                                    
                                                        <div class='mb-3'>
                                                            <label for='update_product_brand$product_id'>Brand</label>
                                                            <select class='form-select' id='update_product_brand$product_id' name='update_product_brand' required>
                                                                <option value='adidas' " . ($product_brand === 'adidas' ? 'selected' : '') . ">Adidas</option>
                                                                <option value='nike' " . ($product_brand === 'nike' ? 'selected' : '') . ">Nike</option>
                                                                <option value='puma' " . ($product_brand === 'puma' ? 'selected' : '') . ">Puma</option>
                                                                <option value='vans' " . ($product_brand === 'vans' ? 'selected' : '') . ">Vans</option>
                                                            </select>
                                                        
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='update_product_category$product_id'>Category</label>
                                                            <select class='form-select' id='update_product_category$product_id' name='update_product_category' required>
                                                                <option value='women' " . ($product_category === 'women' ? 'selected' : '') . ">Women</option>
                                                                <option value='men' " . ($product_category === 'men' ? 'selected' : '') . ">Men</option>
                                                                <option value='kids' " . ($product_category === 'kids' ? 'selected' : '') . ">Kids</option>
                                                            </select>
                                                        </div>
                    
                                                        <div class='mb-3'>
                                                            <label for='update_product_featured$product_id'>Featured</label>
                                                            <select class='form-select' id='update_product_featured$product_id' name='update_product_featured'>    
                                                                <option value='f' " . ($product_featured === 'f' ? 'selected' : '') . ">F</option>
                                                                <option value='s' " . ($product_featured === 's' ? 'selected' : '') . ">S</option>
                                                            </select>
                                                        </div>
                                        
                                                        <div class='mb-3'>
                                                            <label for='update_product_image$product_id'>Update Image</label>
                                                            <input type='file' class='form-control' id='update_product_image$product_id' name='update_product_image' accept='image/*'>
                                                        </div>
                                                        <input type='hidden' name='product_id' value='$product_id'>
                                                        <button type='submit' class='btn btn-primary' name='update_product'>Update Product</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
        }
    } else {
        $product_table .= "<tr><td colspan='9'>No products found</td></tr>";
    }
}
$product_table .= "</tbody></table></div>";


$add_product_modal = '
<div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="product_img" name="product_img" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="product_description" name="product_description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="product_brand" class="form-label">Brand</label>
                        <select class="form-select" id="product_brand" name="product_brand" required>
                            <option value="Adidas">Adidas</option>
                            <option value="Nike">Nike</option>
                            <option value="Vans">Vans</option>
                            <option value="Puma">Puma</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="product_category" class="form-label">Category</label>
                        <select class="form-select" id="product_category" name="product_category" required>
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                            <option value="Kids">Kids</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="featured" class="form-label">Featured</label>
                        <select class="form-select" id="product_featured" name="product_featured" required>
                            <option value="f">F</option>
                            <option value="s">S</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_product">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_brand = $_POST['product_brand'];
    $product_category = $_POST['product_category'];
    $product_featured = $_POST['product_featured'];

    $target_dir = "./assets/prod/";
    $target_file = $target_dir . basename($_FILES["product_img"]["name"]);
    $check_error = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["product_img"]["tmp_name"]);
    if ($check !== false) {
        $check_error = 1;
    } else {
        echo '<script>alert("File is not an image.")</script>';
        $check_error = 0;
    }

    if ($_FILES["product_img"]["size"] > 5000000) {
        echo '<script>alert("Sorry, your file is too large.")</script>';
        $check_error = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
        $check_error = 0;
    }

    if ($check_error == 0) {
        echo '<script>alert("Sorry, your file was not uploaded.")</script>';
    } else {
        if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {

            $filename = basename($_FILES["product_img"]["name"]);
            $insert_query = "INSERT INTO tbl_products (product_name, product_img, product_price, product_description, product_brand, product_category, product_featured) 
                        VALUES ('$product_name', '$filename', '$product_price', '$product_description', '$product_brand', '$product_category', '$product_featured')";
            if (mysqli_query($conn, $insert_query)) {
                echo '<script>alert("Product added successfully");</script>';
                header("Location: " . $_SERVER['PHP_SELF'] . "?action=product");
            } else {
                echo '<script>alert("Error adding product:")</script>';
            }
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $update_product_id = $_POST['product_id'];
    $update_product_name = $_POST['update_product_name'];
    $update_product_price = $_POST['update_product_price'];
    $update_product_description = $_POST['update_product_description'];
    $update_product_brand = $_POST['update_product_brand'];
    $update_product_category = $_POST['update_product_category'];
    $update_product_featured = $_POST['update_product_featured'];

    if ($_FILES['update_product_image']['name'] != '') {
        $target_dir = "./assets/prod/";
        $target_file = $target_dir . basename($_FILES["update_product_image"]["name"]);
        $check_error = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["update_product_image"]["tmp_name"]);
        if ($check !== false) {
            $check_error = 1;
        } else {
            echo '<script>alert("File is not an image.")</script>';
            $check_error = 0;
        }

        if ($_FILES["update_product_image"]["size"] > 5000000) {
            echo '<script>alert("File must be 50mb  or less.")</script>';
            $check_error = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo '<script>alert("Invalid File Format")</script>';
            $check_error = 0;
        }

        if ($check_error == 0) {
            echo '<script>alert("Image was not uploaded.")</script>';
        } else {
            if (move_uploaded_file($_FILES["update_product_image"]["tmp_name"], $target_file)) {
                $filename = basename($target_file);
                $update_query = "UPDATE tbl_products SET product_name = '$update_product_name', product_price = '$update_product_price', product_description = '$update_product_description', product_brand = '$update_product_brand', product_category = '$update_product_category', product_featured = '$update_product_featured', product_img = '$filename' WHERE product_id = '$update_product_id'";
                if (mysqli_query($conn, $update_query)) {
                    echo '<script>alert("Product information updated successfully")</script>';
                    header("Location: " . $_SERVER['PHP_SELF'] . "?action=product");
                    die;
                } else {
                    echo '<script>alert("Error updating product")</script>';
                }
            } else {
                echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
            }
        }
    } else {
        $update_query = "UPDATE tbl_products SET product_name = '$update_product_name', product_price = '$update_product_price', product_description = '$update_product_description', product_brand = '$update_product_brand', product_category = '$update_product_category', product_featured = '$update_product_featured' WHERE product_id = '$update_product_id'";
        if (mysqli_query($conn, $update_query)) {
            echo '<script>alert("Product information updated successfully")</script>';
            header("Location: " . $_SERVER['PHP_SELF'] . "?action=product");
            die;
        } else {
            echo '<script>alert("Error updating product")</script>';
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $delete_product_id = $_POST['product_id'];
    $delete_query = "DELETE FROM tbl_products WHERE product_id = '$delete_product_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo '<script>alert("Product deleted successfully")</script>';
        header("Location: " . $_SERVER['PHP_SELF'] . "?action=product");
        die;
    } else {
        echo '<script>alert("Error deleting product: ' . mysqli_error($conn) . '")</script>';
    }
}

//orders
$orders_table = "<div class='mt-3 py-5'>
                    <div class='mt-3 mb-3'>
                        <form method='POST'>
                            <div class='input-group'>
                                <input type='text' class='form-control' placeholder='Search by Order ID' name='search_order_id'>
                                <button type='submit' class='btn btn-primary'>Search</button>
                            </div>
                        </form>
                    </div>
                    <h3 class='fw-bold fs-4'>Order Table</h3>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Status</th>
                                <th>User ID</th>
                                <th>Order Date</th>
                                <th>User Phone</th>
                                <th>User Address</th>
                            </tr>
                        </thead>
                        <tbody>";


if (isset($_POST['search_order_id'])) {
    $search_order_id = $_POST['search_order_id'];


    $order_query = "SELECT order_id, order_status, user_id, order_date, user_phone, user_address FROM orders WHERE order_id = '$search_order_id'";
    $order_result = mysqli_query($conn, $order_query);

    if ($order_result && mysqli_num_rows($order_result) > 0) {
        while ($order_row = mysqli_fetch_assoc($order_result)) {
            $order_id = $order_row['order_id'];
            $order_status = $order_row['order_status'];
            $user_id = $order_row['user_id'];
            $order_date = $order_row['order_date'];
            $user_phone = $order_row['user_phone'];
            $user_address = $order_row['user_address'];

            $formatted_order_date = date("m-d-Y H:i:s", strtotime($order_date));

            $orders_table .= "<tr>
                                <td>$order_id</td>
                                <td>$order_status</td>
                                <td>$user_id</td>
                                <td>$formatted_order_date</td>
                                <td>$user_phone</td>
                                <td>$user_address</td>
                            </tr>";
        }
    } else {
        $orders_table .= "<tr><td colspan='7'>No orders found</td></tr>";
    }
} else {
    $order_query = "SELECT order_id, order_status, user_id, order_date, user_phone, user_address FROM orders";
    $order_result = mysqli_query($conn, $order_query);

    if ($order_result && mysqli_num_rows($order_result) > 0) {
        while ($order_row = mysqli_fetch_assoc($order_result)) {

            $order_id = $order_row['order_id'];
            $order_status = $order_row['order_status'];
            $user_id = $order_row['user_id'];
            $order_date = $order_row['order_date'];
            $user_phone = $order_row['user_phone'];
            $user_address = $order_row['user_address'];


            $formatted_order_date = date("m-d-Y H:i:s", strtotime($order_date));

            $orders_table .= "<tr>
                                <td>$order_id</td>
                                <td>$order_status</td>
                                <td>$user_id</td>
                                <td>$formatted_order_date</td>
                                <td>$user_phone</td>
                                <td>$user_address</td>
                            </tr>";
        }
    } else {
        $orders_table .= "<tr><td colspan='7'>No orders found</td></tr>";
    }
}

$orders_table .= "</tbody></table></div>";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/dash.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="expand">
            <div class="d-flex flex-column align-items-center pt-3">
                <div class="sidebar-logo">
                    <a href="index.php"><img src="./assets/images/logo.jpg" alt="" style="height: 4rem; "></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="?action=product" class="sidebar-link">
                        <i class="fa-solid fa-cart-arrow-down"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?action=user" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?action=orders" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Orders</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-5 py-4 ad justify-content-center">
                <h3 class="fw-bold fs-4">Admin Dashboard</h3>
            </nav>
            <div class="container">
                <?php
                if (isset($_GET['action'])) {
                    $action = $_GET['action'];

                    if ($action == 'user') {
                        echo $user_table;
                    }
                    if ($action == 'product') {
                        echo $product_table;
                    }
                    if ($action == 'orders') {
                        echo "$orders_table";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <?php echo $add_user_modal; ?>
    <?php echo $add_product_modal; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>