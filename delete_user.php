<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drugdispensingtool";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the SSN parameter is present in the URL
if (isset($_GET['ssn'])) {
    $ssn = $_GET['ssn'];

    // Delete the user based on the SSN
    $query = "DELETE FROM users WHERE SSN = '$ssn'";
    $result = $conn->query($query);

    if ($result) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close database connection
$conn->close();
?>
