<?php
require_once("connect.php");
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="top-right">
    <?php echo $username; ?>
    </div>
    <h2>Doctors</h2>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>

    <?php
    // Create a new PDO instance
    $pdo = new PDO('mysql:host=localhost;dbname=drugdispensingtool;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['update'])) {
        // Get the updated values from the form
        $DSSN = $_POST['DSSN'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $YOE = $_POST['YOE'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute the UPDATE query
        $statement = $pdo->prepare("UPDATE doctors SET fname = :fname, lname = :lname, YOE = :YOE, address = :address, phoneNumber = :phoneNumber, email = :email, username = :username, password = :password WHERE DSSN = :DSSN");
        $statement->execute([
            'fname' => $fname,
            'lname' => $lname,
            'YOE' => $YOE,
            'address' => $address,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'DSSN' => $DSSN
        ]);

        // Redirect to the same page after the update
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    }

    if (isset($_POST['delete'])) {
        // Get the doctor ID to delete
        $DSSN = $_POST['DSSN'];

        // Prepare and execute the DELETE query
        $statement = $pdo->prepare("DELETE FROM doctors WHERE DSSN = :DSSN");
        $statement->execute([
            'DSSN' => $DSSN
        ]);

        // Redirect to the same page after the delete
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    }

    // Prepare and execute a SELECT query
    $statement = $pdo->query("SELECT * FROM doctors");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <thead>
            <tr>
                <th>DoctorID</th>
                <th>First Name</th>
                <th>Second Name</th>
                <th>YOE</th>
                <th>Address</th>
                <th>phoneNumber</th>
                <th>specialty</th>
                <th>email</th>
                <th>username</th>
                <th>password</th>
                <th>confirmPassword</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $row['DSSN']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="DSSN" value="<?php echo $row['DSSN']; ?>">
                            <input type="text" name="fname" value="<?php echo $row['fname']; ?>">
                    </td>
                    <td>
                            <input type="text" name="lname" value="<?php echo $row['lname']; ?>">
                    </td>
                    <td>
                            <input type="text" name="YOE" value="<?php echo $row['YOE']; ?>">
                    </td>
                    <td>
                            <input type="text" name="address" value="<?php echo $row['address']; ?>">
                    </td>
                    <td>
                            <input type="text" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>">
                    </td>
                    <td><?php echo $row['specialty']; ?></td>
                    <td>
                        <input type="text" name="email" value="<?php echo $row['email']; ?>">
                    </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $row['username']; ?>">
                    </td>
                    <td>
                        <input type="text" name="password" value="<?php echo $row['password']; ?>">
                    </td>
                    <td>
                        <input type="submit" name="update" value="Update">
                        </form>
                        <form method="POST">
                            <input type="hidden" name="DSSN" value="<?php echo $row['DSSN']; ?>">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
                
            <?php } ?>
        </tbody>
    </table>
</body>
</html>