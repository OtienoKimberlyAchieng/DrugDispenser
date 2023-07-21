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

    // Search for the SSN in different tables
    $queryPatients = "SELECT * FROM patients WHERE PSSN = '$ssn'";
    $queryDoctors = "SELECT * FROM doctors WHERE DSSN = '$ssn'";
    $queryPharmacists = "SELECT * FROM pharmacists WHERE PHSSN = '$ssn'";
    $queryAdmins = "SELECT * FROM admins WHERE ASSN = '$ssn'";

    $resultPatients = $conn->query($queryPatients);
    $resultDoctors = $conn->query($queryDoctors);
    $resultPharmacists = $conn->query($queryPharmacists);
    $resultAdmins = $conn->query($queryAdmins);

    if ($resultPatients->num_rows > 0) {
        $row = $resultPatients->fetch_assoc();
        $userTable = "patients";
    } elseif ($resultDoctors->num_rows > 0) {
        $row = $resultDoctors->fetch_assoc();
        $userTable = "doctors";
    } elseif ($resultPharmacists->num_rows > 0) {
        $row = $resultPharmacists->fetch_assoc();
        $userTable = "pharmacists";
    } elseif ($resultAdmins->num_rows > 0) {
        $row = $resultAdmins->fetch_assoc();
        $userTable = "admins";
    } else {
        echo "User not found.";
        exit;
    }

    // Display the user details in a form for editing
    echo '<h2>Edit User Details</h2>';
    echo '<form method="POST" action="update_user.php">';
    echo '<input type="hidden" name="ssn" value="' . $row['SSN'] . '">';
    echo 'First Name: <input type="text" name="fname" value="' . $row['fname'] . '"><br>';
    echo 'Last Name: <input type="text" name="lname" value="' . $row['lname'] . '"><br>';
    echo 'Username: <input type="text" name="username" value="' . $row['username'] . '"><br>';
    
    echo '<input type="hidden" name="userTable" value="' . $userTable . '">';
    echo '<input type="submit" value="Update">';
    echo '</form>';
} else {
    echo "Invalid request.";
}

// Close database connection
$conn->close();
?>
