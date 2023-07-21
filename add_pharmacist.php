<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pharmacyName = $_POST["pharmacyName"];
    $address = $_POST["address"]; 
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];


    $sql = "INSERT INTO pharmacists (fname, lname, pharmacyName, address, phoneNumber, email, username, password)
            VALUES ('$fname', '$lname', '$pharmacyName', '$address', '$phoneNumber', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New Pharmacist record added successfully :)";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
