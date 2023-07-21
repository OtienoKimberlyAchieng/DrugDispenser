<?php
require_once("connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
$PSSN= $_POST["PSSN"];
$DSSN=$_POST["DSSN"];
$diagnosis = $_POST["diagnosis"];
$tradeName= $_POST["tradeName"];
$frequency = $_POST["frequency"];
$date= $_POST["date"];




$sql = "INSERT INTO prescription(PSSN, DSSN,diagnosis,tradeName,frequency,date)
VALUES('$PSSN', '$DSSN','$diagnosis','$tradeName','$frequency','$date')";


if($conn->query($sql)==TRUE){
echo "Prescription record added successfully";
}else{
echo "Error:".$sql ."<br>".$conn->error;
}
}
$conn->close();

?>