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
    die("Connection failed: ". $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $univarsity_id = $_POST["Univarsity_ID"];
    $Password = $_POST["Password"];

    // Validate input
    if (empty($univarsity_id) || empty($Password)) {
        $error = "Please fill in all fields";
    } else {
        // Prepare statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE univarsity_id = ? AND password = ?");
        $stmt->bind_param("ss", $univarsity_id, $Password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any row is returned
        if ($result->num_rows == 1) {
            // Login successful
            session_start();
            $_SESSION["login_sess"] = "1";  // Set login session
            $_SESSION["univarsity_id"] = $univarsity_id;

            // Redirect to index.html
            header("Location: index.html");
            exit();
        } else {
            // Login failed
            $error = "Invalid University ID or password";
        }
    }
}

// Close connection
$conn->close();
?>

<!-- Display error message -->
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>