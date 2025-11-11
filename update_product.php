<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_POST['id']);
$name = $conn->real_escape_string($_POST['name']);
$price = floatval($_POST['price']);
$description = $conn->real_escape_string($_POST['description']);

// Handle image upload
$image = '';
if (!empty($_FILES['image']['name'])) {
    $image = basename($_FILES['image']['name']);
    $target_dir = "../images/";
    $target_file = $target_dir . $image;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $sql = "UPDATE products SET name='$name', price=$price, description='$description', image='$image' WHERE id=$id";
} else {
    $sql = "UPDATE products SET name='$name', price=$price, description='$description' WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    header("Location: manage_products.php");
    exit();
} else {
    echo "Error updating product: " . $conn->error;
}

$conn->close();
?>
