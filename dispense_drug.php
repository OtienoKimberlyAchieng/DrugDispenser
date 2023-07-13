<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tradeName = $_POST["tradeName"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $date = $_POST["date"];

  

    $sql = "INSERT INTO drugsdispensed ( tradeName, quantity, price, date)
            VALUES ( '$tradeName', '$quantity', '$price', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "Drug Dispensed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
