<?php
            // Start session
            session_start();
        
            // Check if user is logged in, if not redirect to login page
            if (!isset($_SESSION['email'])) {
                header("Location: login.html");
                exit();
            }
        
            // Retrieve user details from session
            $Student_ID = $_SESSION['Student_ID'];
            $Username = $_SESSION['Username'];
            $Phone_Number = $_SESSION['Phone_Number'];
?>



<!DOCTYPE html>
          <html lang="en">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Profile</title>
          </head>
          <body>
              <div class="dashboard-container">
                  <h2>Profile</h2>
                  <div class="details">

                      <p><strong>Full Name:</strong> <?php echo $Username; ?></p>
                      <p><strong>Student_ID:</strong> <?php echo $Student_ID; ?></p>
                      <p><strong>Mobile:</strong> <?php echo $Phone_Number; ?></p>
        
                  </div>
              </div>
          </body>
          </html>