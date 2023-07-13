<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $SSSN = $_POST["SSSN"];
    $companyName = $_POST["companyName"];
    $pharmacyName = $_POST["pharmacyName"];

  

    $sql = "INSERT INTO contracts (startDate, endDate, SSSN, companyName, pharmacyName)
            VALUES ('$startDate', '$endDate', '$SSSN', '$companyName', '$pharmacyName')";

    if ($conn->query($sql) === TRUE) {
        echo "Contract record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
