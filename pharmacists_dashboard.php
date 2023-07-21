<?php
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; 
?>


<!DOCTYPE html>
<html>
<head>
    <title>Pharmacists Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Pharmacist's Dashboard</h1>

    <div class="top-right">
    Welcome, <?php echo $username; ?>
    </div>

   <ul class="button-group">
   <li><a class="button" href="AddDrug.html">Add a Drug</a></li>
    <li><a class="button" href="ViewingDrugStockTake.php">View Drug Stock</a></li>
   <li><a class="button" href="ViewingDrugSales.php">View Drugs dispensed</a></li>
   <li><a class="button" href="ViewingPrescriptions.php">View Prescriptions </a></li>
   <li><a class="button" href="patient_history.html">View Patients prescription </a></li>
   
   </ul>
   <button onclick="logout()">Logout</button>
<script>
        // Function for logout functionality
        function logout() {
            // Add your logout code here
            window.location.href = "login.html";
        }
</body>
</html>