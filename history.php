<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Enrollment History</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include 'navbar.php'; ?>
<h2>Enrollment History</h2>

<form method="GET">
    Student ID: <input type="text" name="student_id" required>
    <button type="submit">Search</button>
</form>

<?php
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $stmt = $conn->prepare("SELECT course_code, course_title, semester, grade FROM enrollments WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>
                <tr><th>Course Code</th><th>Course Title</th><th>Semester</th><th>Grade</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['course_code']}</td>
                    <td>{$row['course_title']}</td>
                    <td>{$row['semester']}</td>
                    <td>" . ($row['grade'] ?? "N/A") . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No data available.</p>";
    }
}
?>
</body>
</html>
