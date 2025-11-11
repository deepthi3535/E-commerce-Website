<?php
session_start();
include 'includes/db.php'; // Include the database connection

// Fetch products from the database
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Deals</title>
    <style>
        /* General Reset and Body */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background-color:wheat;
  color: #333;
  line-height: 1.6;
}

/* Header Styling */
header {
  background: #333;
  color: white;
  padding: 5px;
  text-align: center;
  position: relative;
  font-style: italic;
  font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  font-size: 211;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  text-align:left;
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: auto;
  text-align: left;
}

header h1 {
  margin: 0;
  font-size: 2.2em;
  font-weight: 700;
  color: white;
  font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
  font-style: oblique;
}
h2 {
  font-family:fantasy;
  border: #2c3e50;
  padding: 11;
}

/* Navigation */
nav {
  display: flex;
  align-items: center;
  text-decoration: underline;
}

nav a, .logout-button {
  color: white;
  text-decoration: none;
  margin: 0 12px;
  font-size: 1.1em;
  text-transform: uppercase;
  transition: color 0.3s ease-in-out;
}

nav a:hover, .logout-button:hover {
  color: #1abc9c;
}

/* Logout Button */
.logout-button {
  background-color: #e74c3c;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

.logout-button:hover {
  background-color: #c0392b;
}

/* Cart Link */
.cart-link {
  display: flex;
  align-items: center;
  color: white;
  font-size: 1.1em;
  text-decoration: none;
}

.cart-link:hover {
  color: #1abc9c;
}

.cart-icon {
  width: 26px;
  height: 26px;
  margin-right: 10px;
  text-decoration: line-through;
}

/* Main Container */
.main-container {
  padding: 30px;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

/* Product List */
.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  max-width: 1000px;
  height: 1%;
}

/* Product Card */
.product {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 220px;
  height: 400px; /* consistent height */
  background-color: white;
  border-radius: 10px;
  padding: 15px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.product:hover {
  transform: translateY(-8px);
}

.product h3 {
  margin-bottom: 12px;
  font-size: 1.4em;
  color: #2c3e50;
}

.product p {
  font-size: 1em;
  color: #666;
  margin-bottom: 12px;
}

.product-image {
  width: 100%;
  height:180px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 15px;
  max-height: 150px;
  object-fit: contain;
}

/* Add to Cart Button */
.add-to-cart-button {
  background:rgb(174, 39, 149);
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 6px;
  font-size: 1.1em;
  cursor: pointer;
  transition: background 0.3s, transform 0.3s;
}

.add-to-cart-button:hover {
  background:rgb(65, 33, 145);
  transform: scale(1.08);
}

/* Checkout Page */
.checkout-container {
  max-width: 500px;
  background: white;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
  text-align: center;
  margin: 50px auto;
}

.checkout-container h2 {
  color: #2c3e50;
  font-size: 1.8em;
}

.checkout-container form {
  display: flex;
  flex-direction: column;
}

.checkout-container input {
  padding: 12px;
  margin: 10px 0;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 1em;
}

.checkout-button {
  background: #3498db;
  color: white;
  padding: 12px;
  border: none;
  border-radius: 6px;
  font-size: 1.2em;
  cursor: pointer;
  transition: background 0.3s ease-in-out;
}

.checkout-button:hover {
  background: #2980b9;
}

/* Footer */
footer {
  background: linear-gradient(to right, #2c3e50, #34495e);
  color: white;
  text-align: center;
  padding: 20px;
  margin-top: 40px;
  font-size: 1.1em;
}
body {
    background-color:wheat; /* Matches the logo background */
    text-align:left;
}

.logo img {
    width: 80px; /* Adjust size as needed */
    height: auto;
}
.site-title {
    color: white;
    font-size: 24px;
    font-weight: bold;
    font-family: 'Arial', sans-serif;
}


    </style>
</head>
<body>
    <header>
        <div class="header-container">
        <header>
        <div class="logo">
            <img src="images/logo.png" alt="Daily Deals Logo">
            <h1 class="site-title">Daily Deals</h1>
        </div>
    </header>
            <nav>
                <a href="pages/login.php">Login</a>
                <a href="pages/register.php">Register</a>
                <a href="pages/cart.php" class="cart-link">
                    <img src="images/cart-icon.png" alt="Cart" class="cart-icon">
                    Cart
                </a>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="logout" class="logout-button">Logout</button>
                </form>
            </nav>
        </div>
    </header>
    <div class="main-container">
        <main>
            <h2>Products</h2>
            <div class="product-list">
            <?php if (empty($products)) : ?>
    <p>No products available.</p>
<?php else : ?>
    <?php foreach ($products as $product) : ?>
        <div class="product">
            <h3><?= htmlspecialchars($product['name']); ?></h3>
            <p>Price: $<?= number_format($product['price'], 2); ?></p>
            <p><?= htmlspecialchars($product['description']); ?></p>
            <?php if (!empty($product['image'])) : ?>
                <img src="images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="product-image">
            <?php endif; ?>
            <form method="POST" action="pages/cart.php">
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                <button type="submit" name="add_to_cart" class="add-to-cart-button">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; <?= date('Y'); ?> Online Store. All rights reserved.</p>
    </footer>
</body>
</html>