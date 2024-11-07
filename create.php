<?php
// Include the configuration file for database connection
require "config.php";

// Initialize variables for error and success messages
$error = "";
$success = "";

// Handle form submission (POST method) for creating the product
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and trim input data
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);

    // Validate required fields
    if (!empty($product_name) && !empty($description) && !empty($price) && !empty($quantity)) {
        // Prepare the SQL query to create the product details
        $stmt = $pdo->prepare("INSERT INTO products (product_name, description, price, quantity) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $product_name);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $price);
        $stmt->bindParam(4, $quantity);

        // Execute the query and check if create was successful
        if ($stmt->execute()) {
            // Display success message if create is successful
            $success = "Your product was added successfully.";
        } else {
            // Display error message if create fails
            $error = "Failed to insert data. Please try again.";
        }
    } else {
        // Display an error if any of the required fields are empty
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 max-w-lg mx-auto p-6">
<div class="max-w-lg w-full">
    <!-- Display success message if available -->
    <?php if (!empty($success)): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline"><?= $success; ?></span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                <span class="text-green-700">×</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Display error message if available -->
    <?php if (!empty($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline"><?= $error; ?></span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                <span class="text-red-700">×</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Page header with the title and link to show all products -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Add Product</h2>
        <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Show Products</a>
    </div>

    <!-- Form to create the product details -->
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Product Name Input -->
            <div class="mb-4">
                <label for="product_name" class="block text-gray-700 font-medium">Product Name <span class="text-red-500">*</span></label>
                <input type="text" id="product_name" name="product_name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Description Input -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <!-- Price Input -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium">Price <span class="text-red-500">*</span></label>
                <input type="number" step="0.01" id="price" name="price" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Quantity Input -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-medium">Quantity <span class="text-red-500">*</span></label>
                <input type="number" id="quantity" name="quantity" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">Add Product</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>