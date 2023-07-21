<?php
require_once("connect.php");
session_start();
$_SESSION['username'] = $_POST['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM doctors WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (isset($row['DSSN'])) {
            $_SESSION['user_id'] = $row['DSSN'];
            $_SESSION['user_role'] = 'doctor';
            header("Location: doctors_dashboard.php");
            exit;
        }
    }

    $stmt = $conn->prepare("SELECT * FROM patients WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (isset($row['PSSN'])) {
            $_SESSION['user_id'] = $row['PSSN'];
            $_SESSION['user_role'] = 'patient';
            header("Location: patients_dashboard.php");
            exit;
        }
    }

    $stmt = $conn->prepare("SELECT * FROM pharmacists WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (isset($row['PHSSN'])) {
            $_SESSION['user_id'] = $row['PHSSN'];
            $_SESSION['user_role'] = 'pharmacist';
            header("Location: pharmacists_dashboard.php");
            exit;
        }
    }

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (isset($row['ASSN'])) {
            $_SESSION['user_id'] = $row['ASSN'];
            $_SESSION['user_role'] = 'admin';
            header("Location: admin_dashboard.php");
            exit;
        }
    }
else{ 
    // Invalid username or password
    echo '<script>alert("Invalid username or password. Please try again.");</script>';

    exit;
}
}

$conn->close();
?>
