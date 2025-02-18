<?php
include 'db_connect.php';

$sql = "SELECT job_id, job_title, company_name, job_location, job_description FROM jobs ORDER BY job_id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='job-box'>";
        echo "<h3>" . $row["job_title"] . "</h3>";
        echo "<p><strong>Company:</strong> " . $row["company_name"] . "</p>";
        echo "<p><strong>Location:</strong> " . $row["job_location"] . "</p>";
        echo "<p>" . $row["job_description"] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No job postings available.</p>";
}

$conn->close();
?>