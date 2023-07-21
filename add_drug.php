<?php
require_once("connect.php");

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    $tradeName = $_POST['tradeName'];
    $formula = $_POST['formula'];
    $quantity = $_POST['quantity'];
    $companyName = $_POST['companyName'];
    $drugType = $_POST['drugType'];
    $price = $_POST['price'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO drugs (tradeName, formula, quantity, companyName, drugType, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $tradeName, $formula, $quantity, $companyName, $drugType, $price);

    if ($stmt->execute()) {
        echo "Drug inserted successfully";
    } else {
        echo "Insertion failed";
    }

    $stmt->close();
}

$conn->close();
?>
