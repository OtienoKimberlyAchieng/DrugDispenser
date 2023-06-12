<?php
$servername="localhost";
$username="root";
$password="";
$dbname="drugdispensingtool";

$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
die("connection failed:" .$conn->connect_error);
}

$sql='INSERT INTO drugs(tradeName,formula,companyName) VALUES("sevenseas","cod liver oil","czech")';

if ($conn->query($sql)==TRUE){
echo "Record inserted successfully";
}else{echo "Insertion failed";
}
$conn->close();
?>