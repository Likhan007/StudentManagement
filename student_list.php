<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include 'navbar.php'; ?>
<h2>Student List</h2>

<?php
$result = $conn->query("SELECT name, student_id, department, major, email FROM students");

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'><tr><th>Name</th><th>Student ID</th><th>Department</th><th>Major</th><th>Email</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['department']}</td>
                <td>{$row['major']}</td>
                <td>{$row['email']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No data in the table.</p>";
}
?>
</body>
</html>
