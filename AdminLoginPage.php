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
print_r($_POST);
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["StudentID"];
    $password = $_POST["Password"];

    // Validate input
    if (empty($student_id) || empty($password)) {
        $error = "Please fill in all fields";
    } else {
		
        // Authenticate user
        $query = "SELECT * FROM admins WHERE id = $student_id";
        $res = mysqli_query($conn,$query); 
		$numRows = mysqli_num_rows($res);
        //$stmt->bind_param("s", $student_id);
        //$stmt->execute();
        //$result = $stmt->get_result();

        if ($numRows==1 ) {

    $row = mysqli_fetch_assoc($res);  // fetch database
    if($password==$row['password'])
    {
        $_SESSION["login_sess"]="1";  //login session set 1
        $_SESSION["admin_id"]=$row['id'];

        header("location: AdminDashboard.html");
    }
    else{
        header("location: adminlogin.html?loginerror=".$username);
    }

        } else {
            $error = "User not found";
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