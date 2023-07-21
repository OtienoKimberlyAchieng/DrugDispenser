<?php
require_once("connect.php");
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; 
$_SESSION['user_id'] = $row['PHSSN'];
// Check if the PSSN parameter is present in the URL
if (isset($_GET["PSSN"])) {
    // Retrieve the PSSN from the URL parameter
    $PSSN = $_GET["PSSN"];

    // Construct the SQL query to fetch the prescription history for the given PSSN
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
} else {
    echo 'PSSN not provided in the URL.';
}

