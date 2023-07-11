<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $YOE = $_POST["YOE"];
    $address = $_POST["address"]; 
    $phoneNumber = $_POST["phoneNumber"];
    $specialty = $_POST["specialty"];
    $email=$_POST["email"];

    $sql = "INSERT INTO Doctors (fname, lname, YOE, address, phoneNumber, specialty,email)
            VALUES ('$fname', '$lname', '$YOE', '$address', '$phoneNumber', '$specialty','$email')";
}
    if ($conn->query($sql) === TRUE) {
        echo "New Doctor record added successfully :)";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


$conn->close();
?>
