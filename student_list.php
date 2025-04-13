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
// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    echo "<p class='success'>Student deleted successfully!</p>";
}

// Fetch Students
$result = $conn->query("SELECT * FROM students");

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Name</th><th>Student ID</th><th>Department</th><th>Major</th><th>Email</th><th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['department']}</td>
                <td>{$row['major']}</td>
                <td>{$row['email']}</td>
                <td>
                    <a href='edit_student.php?id={$row['id']}'>Edit</a> | 
                    <a href='student_list.php?delete={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No data in the table.</p>";
}
?>
</body>
</html>
