<?php

session_start();


$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "login_system";   


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $user = trim($_POST['email']);
    $pass = trim($_POST['password']);


    if (empty($name) || empty($user) || empty($pass)) {
        die("Name, email, and password cannot be empty.");
    }

    
    $stmt = $conn->prepare("INSERT INTO `company_info` (`name`, `email`, `password`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $user, $pass);

    if ($stmt->execute()) {
        echo "<h2>Registration Successful, $user!</h2>";
        echo '<a href="company.html">Login</a>';
    } else {
        echo "<h2>Error: " . $stmt->error . "</h2>";
    }

    
    $stmt->close();
    $conn->close();
}
?>
