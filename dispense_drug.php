<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tradeName = $_POST["tradeName"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $dateSold = $_POST["date"];
    $PSSN = $_POST["PSSN"];
    $PHSSN = $_POST["PHSSN"];
    


  

    $sql = "INSERT INTO drugsdispensed ( tradeName, quantity, price, dateSold,PSSN,PHSSN)
            VALUES ( '$tradeName', '$quantity', '$price', '$dateSold', '$PSSN', '$PHSSN')";

    if ($conn->query($sql) === TRUE) {
        echo "Drug Dispensed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
