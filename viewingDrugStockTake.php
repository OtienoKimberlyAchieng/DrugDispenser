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
    <h2>Drug Stock</h2>

    <?php
    try {
        // Create a new PDO instance
        $pdo = new PDO('mysql:host=localhost;dbname=drugdispensingtool;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the form has been submitted for updating
        if (isset($_POST['update'])) {
            $DID = $_POST['DID'];
            $tradeName = $_POST['tradeName'];
            $formula = $_POST['formula'];
            $quantity = $_POST['quantity'];
            $companyName = $_POST['companyName'];
            $drugType = $_POST['drugType'];
            $price = $_POST['price'];

            // Prepare and execute an update query
            $updateStatement = $pdo->prepare("UPDATE drugs SET tradeName=?, formula=?, quantity=?, companyName=?, drugType=?, price=? WHERE DID=?");
            $updateStatement->execute([$tradeName, $formula, $quantity, $companyName, $drugType, $price, $DID]);
        }

        // Check if the form has been submitted for deleting
        if (isset($_POST['delete'])) {
            $DID = $_POST['DID'];

            // Prepare and execute a delete query
            $deleteStatement = $pdo->prepare("DELETE FROM drugs WHERE DID=?");
            $deleteStatement->execute([$DID]);
        }

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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $row['DID']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="DID" value="<?php echo $row['DID']; ?>">
                            <input type="text" name="tradeName" value="<?php echo $row['tradeName']; ?>">
                    </td>
                    <td>
                            <input type="text" name="formula" value="<?php echo $row['formula']; ?>">
                    </td>
                    <td>
                            <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>">
                    </td>
                    <td>
                            <input type="text" name="companyName" value="<?php echo $row['companyName']; ?>">
                    </td>
                    <td>
                            <input type="text" name="drugType" value="<?php echo $row['drugType']; ?>">
                    </td>
                    <td>
                            <input type="text" name="price" value="<?php echo $row['price']; ?>">
                    </td>
                    <td>
                        <button type="submit" name="update">Update</button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="DID" value="<?php echo $row['DID']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
