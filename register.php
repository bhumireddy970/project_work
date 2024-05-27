<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "register";

$con = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Using prepared statements to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO details (name,email, password) VALUES (?,?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<h1><center>welcome $name</center></h1>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($con);
}
?>