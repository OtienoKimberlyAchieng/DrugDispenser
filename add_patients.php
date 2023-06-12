<?php
require_once("connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$primary_physician = $_POST["primary_physician"];
$phoneNumber= $_POST["phoneNumber"];
$address = $_POST["address"];
$DOB= $_POST["DOB"];



$sql = "INSERT INTO patients(fname,lname,primary_physician,phoneNumber,address,DOB)
VALUES('$fname','$lname','$primary_physician','$phoneNumber','$address','$DOB')";


if($conn->query($sql)==TRUE){
echo "New Patient record added successfully";
}else{
echo "Error:".$sql ."<br>".$conn->error;
}
}
$conn->close();

?>