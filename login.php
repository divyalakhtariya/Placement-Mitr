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

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;
        echo "<h2>Welcome, $user!</h2>";
        echo '<a href="logout.php">Logout</a>';
    } else {
        echo "<h2>Invalid username or password</h2>";
        echo '<a href="index.html">Try again</a>';
    }


    $stmt->close();
    $conn->close();
}
?>
