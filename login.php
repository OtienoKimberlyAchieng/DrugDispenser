<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drugdispensingtool";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) { // Fixed the typo in the '$_POST' variable

    $username = $_POST['Username']; // Updated the variable names to match the form field names
    $password = $_POST['Password']; // Updated the variable names to match the form field names

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];

        header('Location: dashboard.php');
        exit();
    } else {
        echo '<script type="text/javascript">';
        echo "alert('Invalid username or password');"; // Updated the code to show an alert message
        echo 'window.location.href="dashboard.php";';
        echo '</script>';
        exit(); // Added an exit statement to prevent further execution
    }
} else {
    header('Location: login.html');
    exit();
}
?>
