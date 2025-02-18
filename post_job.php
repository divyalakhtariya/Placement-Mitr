<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];
    $location = $_POST['job_location'];
    $description = $_POST['job_description'];

    $sql = "INSERT INTO jobs (job_title, company_name, job_location, job_description) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $job_title, $company_name, $location, $description);

    if ($stmt->execute()) {
        echo "Job posted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>