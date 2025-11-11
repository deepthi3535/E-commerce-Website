<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is passed
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get product image filename
    $result = $conn->query("SELECT image FROM products WHERE id = $id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = "../images/" . $row['image'];

        // Delete image from server
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // Delete product from database
    $delete = $conn->query("DELETE FROM products WHERE id = $id");

    if ($delete) {
        $msg = "Product deleted successfully.";
    } else {
        $msg = "Error deleting product.";
    }
} else {
    $msg = "No product ID specified.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .message-box h2 {
            color: #2e7d32;
        }
        .message-box a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #388e3c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .message-box a:hover {
            background: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h2><?php echo htmlspecialchars($msg); ?></h2>
        <a href="manage_products.php">Back to Product List</a>
    </div>
</body>
</html>
