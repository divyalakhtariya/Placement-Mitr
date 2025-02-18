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
    $user = $_POST['username'];
    $pass = $_POST['password'];

    
    if (empty($user) || empty($pass)) {
        die("Username and password cannot be empty.");
    }



    $stmt = $conn->prepare("INSERT INTO `users` (`username`, `password`) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $pass);

    if ($stmt->execute()) {
        echo "<h2>Registration Successful, $user!</h2>";
        echo '<a href="index.html">Login</a>';
    } else {
        echo "<h2>Error: " . $stmt->error . "</h2>";
    }


    $stmt->close();
    $conn->close();
}
?>
