<?php
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; 
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Admin Dashboard</h1>

    <div class="top-right">
    Welcome, <?php echo $username; ?>
    </div>


    <ul class="button-group">
 
  <li><a class="button" href="ViewingPatients.php">View patients</a></li>
  <li><a class="button" href="ViewingDoctors.php">View Doctors</a></li>
  <li><a class="button" href="ViewingAdmins.php">View Admins</a></li>
  <li><a class="button" href="ViewingPhamacists.php">View Pharmacists </a></li>

</ul>
<button onclick="logout()">Logout</button>
<script>
        // Function for logout functionality
        function logout() {
            // Add your logout code here
            window.location.href = "login.html";
        }
</script>
</body>
</html>