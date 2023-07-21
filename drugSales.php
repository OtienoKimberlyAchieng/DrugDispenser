<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tradeName = $_POST["tradeName"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"]; 
    $dateSold = $_POST["dateSold"];
    $PSSN= $_POST["PSSN"];
    $PHSSN= $_POST["PHSSN"];
    $pharmaceutical= $_POST["pharmaceutical"];


    $sql = "INSERT INTO drugsales (tradeName, quantity , price, dateSold,PSSN,PHSSN,pharmaceutical)
            VALUES ('$tradeName','$quantity','$price', '$dateSold','$PSSN','$PHSSN','$pharmaceutical')";

    if ($conn->query($sql) === TRUE) {
        echo "Drug dispensed successfully :)";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
