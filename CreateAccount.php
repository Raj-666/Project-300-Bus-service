<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'bus';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $Univarsity_ID = $_POST["Univarsity_ID"];
    $Phone_Number = $_POST["Phone_Number"];
    $password = $_POST["Password"];

    // Validate input
    if (empty($username) || empty($Univarsity_ID) || empty($Phone_Number) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Prepare statement
        $stmt = $conn->prepare("INSERT INTO users (username, Univarsity_ID, Phone_Number, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $Univarsity_ID, $Phone_Number, $password);

        if ($stmt->execute()) {
            // Account created successfully
            echo "Account created successfully.";
        } else {
            // Error creating account
            $error = "Error creating account: " . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

<!-- Display error message -->
<?php if (isset($error)):?>
    <p style="color: red;"><?php echo $error;?></p>
<?php endif;?>
