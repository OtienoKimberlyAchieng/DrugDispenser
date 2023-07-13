<?php
require_once("connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
$PSSN= $_POST["PSSN"];
$DSSN=$_POST["DSSN"];
$diagnosis = $_POST["diagnosis"];
$tradeName= $_POST["tradeName"];
$quantity = $_POST["quantity"];
$date= $_POST["date"];




$sql = "INSERT INTO prescription(PSSN, DSSN,diagnosis,tradeName,quantity,date)
VALUES('$PSSN', '$DSSN','$diagnosis','$tradeName','$quantity','$date')";


if($conn->query($sql)==TRUE){
echo "Prescription record added successfully";
}else{
echo "Error:".$sql ."<br>".$conn->error;
}
}
$conn->close();

?>