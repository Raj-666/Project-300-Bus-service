<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Assuming you have no password set for your local MySQL server
$database = "bus"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve items from the database
$sql = "SELECT * FROM lost_found_items ORDER BY post_date DESC";
$result = $conn->query($sql);

// Display items
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item'>";
        echo "<h2>Lost/Found Item - " . $row['post_date'] . "</h2>";
        echo "<p>" . $row['item_description'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No items found.";
}

// Close connection
$conn->close();
?>
