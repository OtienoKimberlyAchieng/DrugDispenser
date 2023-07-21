<?php

if(isset($POST)['login'])){
$username=$_POST['Username'];
$password=$_POST['Password'];

$select=mysqli_query($conn,"SELECT * FROM drugdispensingtool WHERE Username='$username' AND Password='$password'");
$row=mysql_fetch_array($select);

if(is_array($row)){
$_SESSION['username']= $row['username'];
$_SESSION['password']=$row['password']
 }else {
    echo'<script type=text/javascript">';
    echo "Invalid username or password";
    echo 'window.location.href="login.php"';
    echo'</script>;
      }
     if (!isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();

}
}