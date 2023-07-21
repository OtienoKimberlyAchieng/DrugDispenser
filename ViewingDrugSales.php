<?php
require_once("connect.php");
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Drugs Dispensed</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <h2>Drugs Dispensed</h2>

    <?php
    // Create a new PDO instance
    $pdo = new PDO('mysql:host=localhost;dbname=drugdispensingtool;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute a SELECT query
    $statement = $pdo->query("SELECT * FROM drugsdispensed");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <thead>
            <tr>
                <th>DSID</th>
                <th>Trade Names</th>
                <th>quantity</th>
                <th>price</th>
                <th>dateSold</th>
                <th>PSSN</th>
                <th>PHSSN</th>
                <th>pharmaceutical</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $row['DSID']; ?></td>
                    <td><?php echo $row['tradeName']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['dateSold']; ?></td>
                    <td><?php echo $row['PSSN']; ?></td>
                    <td><?php echo $row['PHSSN']; ?></td>
                    <td><?php echo $row['pharmaceutical']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
