<?php
// 1. Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Fetch product list
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f8fb;
}

.container {
    width: 90%;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
}

h2 {
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

table th {
    background-color: #28a745;
    color: white;
}

.btn {
    text-decoration: none;
    padding: 6px 12px;
    margin: 2px;
    border-radius: 5px;
    font-weight: bold;
}

.btn.edit {
    background-color: #007bff;
    color: white;
}

.btn.delete {
    background-color: #dc3545;
    color: white;
}

img {
    border-radius: 5px;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Products</h2>
        <table>
            <tr>
                <th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td>$<?= number_format($row['price'], 2); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td><img src="../images/<?= $row['image']; ?>" width="50" height="50"></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['id']; ?>" class="btn edit">Edit</a>
                    <a href="delete_product.php?id=<?= $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
