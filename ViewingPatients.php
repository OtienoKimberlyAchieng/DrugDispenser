<?php
require_once("connect.php");
// Start the session (if not already started)
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
?>
<!DOCTYPE html>
<html>
<head>
<title>Patients</title>
<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
<div class="top-right">
    <?php echo $username; ?>
    </div>
    <h2>Patients</h2>
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
        $PSSN = $_POST['PSSN'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $primary_physician = $_POST['primary_physician'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute the UPDATE query
        $statement = $pdo->prepare("UPDATE patients SET fname = :fname, lname = :lname, address = :address, primary_physician = :primary_physician, phoneNumber = :phoneNumber, email = :email, username = :username, password = :password WHERE PSSN = :PSSN");
        $statement->execute([
            'fname' => $fname,
            'lname' => $lname,
            'address' => $address,
            'primary_physician' => $primary_physician,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'PSSN' => $PSSN
        ]);

        // Redirect to the same page after the update
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    }

    // Handle delete form submission
    if (isset($_POST['delete'])) {
        $PSSN = $_POST['PSSN'];

        // Prepare and execute the DELETE query
        $statement = $pdo->prepare("DELETE FROM patients WHERE PSSN = :PSSN");
        $statement->execute([
            'PSSN' => $PSSN
        ]);

        // Redirect to the same page after the delete
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    }

    // Prepare and execute a SELECT query
    $statement = $pdo->query("SELECT * FROM patients");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <table>
        <thead>
            <tr>
            <th>PSSSN</th>
                <th>fName</th>
                <th>lname</th>
                <th>address</th>
                <th>DOB</th>
                <th>Primary Physician</th>
                <th>phoneNumber</th>
                <th>email</th>
                <th>username</th>
                <th>password</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $row['PSSN']; ?></td>
                    <td><input type="text" name="fname" value="<?php echo $row['fname']; ?>"></td>
                    <td><input type="text" name="lname" value="<?php echo isset($row['lname']) ? $row['lname'] : ''; ?>"></td>
                    <td><input type="text" name="address" value="<?php echo $row['address']; ?>"></td>
                    <td><?php echo $row['DOB']; ?></td>
                    <td><input type="text" name="primary_physician" value="<?php echo $row['primary_physician']; ?>"></td>
                    <td><input type="text" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>"></td>
                    <td><input type="text" name="email" value="<?php echo $row['email']; ?>"></td>
                    <td><input type="text" name="username" value="<?php echo $row['username']; ?>"></td>
                    <td><input type="text" name="password" value="<?php echo $row['password']; ?>"></td>
                    <td><input type="submit" name="update" value="Update"></td>
                    <td><input type="submit" name="delete" value="Delete"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>