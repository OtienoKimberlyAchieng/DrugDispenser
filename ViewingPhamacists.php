<?php
require_once("connect.php");
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
?>
<!DOCTYPE html>
<html>
<head>
<title>Pharmacists</title>
<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
<div class="top-right">
    <?php echo $username; ?>
    </div>
    <h2>Pharmacists</h2>
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
<form>
<body>
<html>    
    
    
    
<?php
// Create a new PDO instance
$pdo = new PDO('mysql:host=localhost;dbname=drugdispensingtool;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Handle update form submission
if (isset($_POST['update'])) {
    $PHSSN = $_POST['PHSSN'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $pharmacyName = $_POST['pharmacyName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the UPDATE query
    $statement = $pdo->prepare("UPDATE pharmacists SET fname = :fname, lname = :lname, address = :address, pharmacyName = :pharmacyName, phoneNumber = :phoneNumber, email = :email, username = :username, password = :password WHERE PHSSN = :PHSSN");
    $statement->execute([
        'fname' => $fname,
        'lname' => $lname,
        'address' => $address,
        'pharmacyName' => $pharmacyName,
        'phoneNumber' => $phoneNumber,
        'email' => $email,
        'username' => $username,
        'password' => $password,
        'PHSSN' => $PHSSN
    ]);

    // Redirect to the same page after the update
    header("Location: $_SERVER[PHP_SELF]");
    exit();
}

// Handle delete form submission
if (isset($_POST['delete'])) {
    $PHSSN = $_POST['PHSSN'];

    // Prepare and execute the DELETE query
    $statement = $pdo->prepare("DELETE FROM pharmacists WHERE PHSSN = :PHSSN");
    $statement->execute([
        'PHSSN' => $PHSSN
    ]);

    // Redirect to the same page after the delete
    header("Location: $_SERVER[PHP_SELF]");
    exit();
}

// Prepare and execute a SELECT query
$statement = $pdo->query("SELECT * FROM pharmacists");
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

    <table>
        <thead>
            <tr>
                <th>fName</th>
                <th>lName</th>
                <th>pharmacyName</th>
                <th>address</th>
                
                <th>phoneNumber</th>
                <th>email</th>
                <th>username</th>
                <th>password</th>
                <th>PHSSN</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>

                     <td>
                    <input type="text" name="fname" value="<?php echo $row['fname']; ?>">
                    </td>
                    <td>
                            <input type="text" name="lname" value="<?php echo $row['lname']; ?>">
                    </td>
                    <td>
                    <input type="text" name="pharmacyName" value="<?php echo $row['pharmacyName']; ?>">
                    </td>
                    <td>
                
                            <input type="text" name="address" value="<?php echo $row['address']; ?>">
                    </td>
                    <td>
                    <input type="text" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>">
                    </td>
                    <td>
                    <input type="text" name="email" value="<?php echo $row['email']; ?>">
                    </td>
                    <td>
                
                    
                   
                   
                    <input type="text" name="username" value="<?php echo $row['username']; ?>">
                    </td>
                    <td>
                    <input type="text" name="password" value="<?php echo $row['password']; ?>">
                    </td>
                    
                    <td><?php echo $row['PHSSN']; ?></td>
                    <td>
                        <form method="POST">

                        <input type="submit" name="update" value="Update">
                        </form>
                        <form method="POST">
                            
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>