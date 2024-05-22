<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Assuming you have no password set for your local MySQL server
$database = "bus"; // Change this to your database name

// Get the item description from the POST request
$message = $_POST['message'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to insert the item description into the database
$stmt = $conn->prepare("INSERT INTO lost_found_items (item_description) VALUES (?)");
$stmt->bind_param("s", $message);

// Execute the statement
if ($stmt->execute()) {
    // Fetch and display the updated list of items
    include 'display_items.php';
} else {
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
?>
