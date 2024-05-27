<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "example";

$con = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Using prepared statements to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO login (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        echo "<h1>welcome $email</h1>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($con);
}
?>