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
    $user = $_POST['email'];
    $pass = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM student_info WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;
        header("location:student-dashboard.html");
    } else {
        echo "<h2>Invalid username or password</h2>";
        echo '<a href="student.html">Try again</a>';
    }

 
    $stmt->close();
    $conn->close();
}
?>
