<?php
require_once("connect.php");
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; 

// Assuming you have the patient's pssn as a variable, retrieve the prescription history
$PSSN = $_POST["PSSN"];

// Construct the SQL query to fetch the prescription history for the given pssn
$sql = "SELECT * FROM prescription WHERE PSSN = '$PSSN'";

// Execute the query
$result = $conn->query($sql);

// Check if the query execution was successful
if ($result) {
    // Check if there are any results
    if ($result->num_rows > 0) {
        // Start creating the HTML table
        echo '<table class="prescription-table">';
        echo '<tr><th>Diagnosis</th><th>Prescription ID</th><th>Date</th><th>Trade Name</th></tr>';

        // Loop through the results and output each row as a table row
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["diagnosis"] . '</td>';
            echo '<td>' . $row["PID"] . '</td>';
            echo '<td>' . $row["date"] . '</td>';
            echo '<td>' . $row["tradeName"] . '</td>';
            // Output other columns as needed
            echo '</tr>';
        }

        // Close the HTML table
        echo '</table>';
    } else {
        echo 'No prescriptions found for the given patient.';
    }
} else {
    echo 'Error executing the query: ' . mysqli_error($conn);
}

// Close the database connection
$conn->close();
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="top-right">
    <?php echo $username; ?>
</div>
</body>
<style>
    .prescription-table {
        width: 100%;
        border-collapse: collapse;
    }

    .prescription-table th,
    .prescription-table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .prescription-table th {
        background-color: #f2f2f2;
    }

    .prescription-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .prescription-table tr:hover {
        background-color: #ddd;
    }
</style>
</html>
