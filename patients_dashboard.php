<?php
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; 
$PSSN = isset($_SESSION['PSSN']) ? $_SESSION['PSSN']: "unknown";


?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="top-right">
    Welcome, <?php echo $username; ?>
    <div class="button-group">
      <center>
            <button onclick="logout()">Logout</button>
            <button onclick="location.href='patient_history.html'">Medical History</button><br>
      </center>    
    </div>


    <script>
        // Function for logout functionality
        function logout() {
            // Add your logout code here
            window.location.href = "logout.php";
        }

    </script>
       </div>
  
</body>
</html>
