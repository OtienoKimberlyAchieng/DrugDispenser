<?php
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor's Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="top-right">
    Welcome, <?php echo $username; ?>
    </div>
    <h2>Doctor's Dashboard</h2>

      <a class="button" href="show_drugs.php">Drug Details</a>
      <a class="button" href="patient_history.html">Patient History</a>
      <a class="button" href="PrescriptionForm.html">Prescribe</a>
</body>
</html>
