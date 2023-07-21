<?php
require_once("connect.php");
require_once("session.php");
// Start the session (if not already started)
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; 
?>
<!DOCTYPE html>
<html>
<head>
<title>Prescriptions</title>
<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
    <h2>Prescriptions</h2>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
    <div class="top-right">
    <?php echo $username; ?>
    </div>
</head>
<body>
<html>    
    
    <?php
    // Create a new PDO instance
    $pdo = new PDO('mysql:host=localhost;dbname=drugdispensingtool;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute a SELECT query
    $statement = $pdo->query("SELECT * FROM prescription");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <thead>
            <tr>
                <th>PSSN</th>
                <th>DSSN</th>
                <th>Diagnosis</th>
                <th>Trade Name</th>
                <th>Frequency</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $row['PSSN']; ?></td>
                    <td><?php echo $row['DSSN']; ?></td>
                    <td><?php echo $row['diagnosis']; ?></td>
                    <td><?php echo $row['tradeName']; ?></td>
                    <td><?php echo $row['frequency']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Button to redirect to 'dispensedrug.php' -->
    <form class="button-group" method="GET" action="DispenseDrugForm.html">
        <button type="submit">Dispense Drug</button>
    </form>
</body>
</html>
