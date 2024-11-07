<?php
// Include the configuration file for database connection
require "config.php";

// Prepare and execute the SQL statement
$stmt = $pdo->prepare("SELECT * FROM products ORDER BY id");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Product List</h2>
        <a href="create.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Create Product</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2 text-left">ID</th>
                <th class="border px-4 py-2 text-left">Product Name</th>
                <th class="border px-4 py-2 text-left">Description</th>
                <th class="border px-4 py-2 text-left">Price</th>
                <th class="border px-4 py-2 text-left">Quantity</th>
                <th class="border px-4 py-2 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row): ?>
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['id']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['product_name']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['description']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['price']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['quantity']); ?></td>
                    <td class="border px-4 py-2 text-center">
                        <a href="edit.php?id=<?= htmlspecialchars($row['id']); ?>" class="text-blue-500">Edit</a>
                        <a href="delete.php?id=<?= htmlspecialchars($row['id']); ?>" class="text-red-500 ml-2" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>