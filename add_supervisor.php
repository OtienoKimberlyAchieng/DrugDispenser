<?php

require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $companyName = $_POST["companyName"];
    $phoneNumber = $_POST["phoneNumber"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    




    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO supervisor (fname, lname, companyName, phoneNumber, username, password)
            VALUES ('$fname', '$lname', '$companyName', '$phoneNumber', '$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "New Supervisor record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>