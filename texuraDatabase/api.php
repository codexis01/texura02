<?php
// Include the database connection file
require 'db.php';

// Set response headers
header("Content-Type: application/json");

// Parse the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// Handle the incoming request
switch ($method) {
    case 'GET': // Fetch all products or a specific product
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $query = "SELECT * FROM products WHERE id = $id";
        } else {
            $query = "SELECT * FROM products";
        }
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($data);
        break;

    case 'POST': // Add a new product
        $input = json_decode(file_get_contents('php://input'), true);
        $name = $input['name'];
        $description = $input['description'];
        $price = $input['price'];
        $image = $input['image'];
        $query = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', $price, '$image')";
        $result = mysqli_query($conn, $query);
        echo json_encode(["success" => $result]);
        break;

    case 'PUT': // Update an existing product
        $id = intval($_GET['id']);
        $input = json_decode(file_get_contents('php://input'), true);
        $name = $input['name'];
        $description = $input['description'];
        $price = $input['price'];
        $image = $input['image'];
        $query = "UPDATE products SET name = '$name', description = '$description', price = $price, image = '$image' WHERE id = $id";
        $result = mysqli_query($conn, $query);
        echo json_encode(["success" => $result]);
        break;

    case 'DELETE': // Delete a product
        $id = intval($_GET['id']);
        $query = "DELETE FROM products WHERE id = $id";
        $result = mysqli_query($conn, $query);
        echo json_encode(["success" => $result]);
        break;

    default:
        echo json_encode(["message" => "Invalid request"]);
        break;
}

// Close the database connection
mysqli_close($conn);
