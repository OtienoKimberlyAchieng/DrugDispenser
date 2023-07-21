<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $primary_physician = $_POST["primary_physician"];
    $phoneNumber = $_POST["phoneNumber"];
    $address = $_POST["address"];
    $email=$_POST["email"];
    $DOB = $_POST["DOB"];
    $username = $_POST["username"];
    $password = $_POST["password"];


    $sql = "INSERT INTO patients (fname, lname, primary_physician,phoneNumber, address,email, DOB,username,password)
            VALUES ('$fname', '$lname', '$primary_physician','$phoneNumber', '$address','$email','$DOB','$username','$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New Patients record added successfully :)";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>
