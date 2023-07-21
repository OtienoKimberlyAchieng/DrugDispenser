<?php
require_once("connect.php");
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Drug Stock</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
<div class="top-right">
    <?php echo $username; ?>
</div>
<h2>Drug Details</h2>

<?php
try {
    // Create a new PDO instance
    $pdo = new PDO('mysql:host=localhost;dbname=drugdispensingtool;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute a SELECT query
    $statement = $pdo->query("SELECT * FROM drugs");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); // Display the error message for debugging
}
?>

<table>
    <thead>
        <tr>
            <th>DID</th>
            <th>tradeName</th>
            <th>formula</th>
            <th>quantity</th>
            <th>companyName</th>
            <th>drugType</th>
            <th>price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['DID']; ?></td>
                <td><?php echo $row['tradeName']; ?></td>
                <td><?php echo $row['formula']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['companyName']; ?></td>
                <td><?php echo $row['drugType']; ?></td>
                <td><?php echo $row['price']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>
