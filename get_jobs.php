<?php
session_start();
$conn = new mysqli("localhost", "root", "", "login_system");

$sql = "SELECT job_id, job_title, company_name, job_location FROM jobs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['job_title']}</td>
                <td>{$row['company_name']}</td>
                <td>{$row['job_location']}</td>
                <td><a href='apply_job.php?job_id={$row['job_id']}' class='apply-btn'>Apply Now</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No jobs available</td></tr>";
}

$conn->close();
?>