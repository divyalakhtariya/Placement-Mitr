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
    $uname = trim($_POST['uname']);
    $cname = trim($_POST['cname']);
    $cgpa = trim($_POST['cgpa']);
    $gender = trim($_POST['gender']); 
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    
    if (empty($name) || empty($uname) || empty($cname) || empty($cgpa) || empty($gender) || empty($email) || empty($password)) {
        echo "<h2>All fields are required.</h2>";
        exit();
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h2>Invalid email format.</h2>";
        exit();
    }

    

    
    $stmt = $conn->prepare("INSERT INTO student_info (name, university, city, cgpa, gender, email, password) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");

    
    $stmt->bind_param("sssssss", $name, $uname, $cname, $cgpa, $gender, $email, $password);

    if ($stmt->execute()) {
        echo "<h2>Registration Successful, $name!</h2>";
        echo '<a href="student.html">Login</a>';
    } else {
        echo "<h2>Error: " . $stmt->error . "</h2>";
    }

    
    $stmt->close();
    $conn->close();
}
?>
