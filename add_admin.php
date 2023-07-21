<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"]; 
    $phoneNumber = $_POST["phoneNumber"];
    $email=$_POST["email"];
    $username=$_POST["username"];
    $password=$_POST["password"];


    $sql = "INSERT INTO admins (fname, lname , address, phoneNumber,email,username,password)
            VALUES ('$fname', '$lname', '$address', '$phoneNumber','$email','$username','$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New Admin record added successfully :)";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
