<?php
// Connect to your MySQL database
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password != $confirm_password) {
        echo "Passwords do not match. Please try again.";
    } else {
        // Check the user type in different tables (admins, pharmacists, doctors, or patients) and update the password accordingly
        $userTypes = array('admins', 'pharmacists', 'doctors', 'patients');
        foreach ($userTypes as $userType) {
            $sql = "UPDATE $userType SET password = '$new_password' WHERE username = '$username'";
            if ($conn->query($sql) === TRUE) {
                echo "Password reset successfully for $userType!";
                break; // If the password is updated in any of the tables, break the loop
            } else {
                // If there's an error, continue to the next user type
                continue;
            }
        }
        // If the loop completes without updating the password, it means the username was not found in any of the tables
        echo "Username not found. Password reset failed!";
    }
}

$conn->close();
?>
