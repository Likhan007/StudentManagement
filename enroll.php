<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Enrollment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<h2>Course Enrollment</h2>

<?php
// Handle Delete
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM enrollments WHERE id=" . $_GET['delete']);
    echo "<p class='success'>Enrollment deleted.</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_code = $_POST["course_code"];
    $course_title = $_POST["course_title"];
    $semester = $_POST["semester"];

    if (!empty($student_id) && !empty($course_code)) {
        $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_code, course_title, semester) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $student_id, $course_code, $course_title, $semester);
        $stmt->execute();
        echo "<p class='success'>Enrollment added!</p>";
    } else {
        echo "<p class='error'>Student ID and Course Code are required.</p>";
    }
}
?>

<form method="POST">
    Student ID*: <input type="text" name="student_id" required><br><br>
    Course Code*: <input type="text" name="course_code" required><br><br>
    Course Title: <input type="text" name="course_title"><br><br>
    Semester:
    <select name="semester">
        <option>Spring</option><option>Summer</option><option>Fall</option>
    </select><br><br>
    <button type="submit">Enroll</button>
</form>

<?php
$enrolls = $conn->query("SELECT * FROM enrollments");
if ($enrolls->num_rows > 0) {
    echo "<h3>All Enrollments</h3>";
    echo "<table>
            <tr><th>Student ID</th><th>Course Code</th><th>Course Title</th><th>Semester</th><th>Actions</th></tr>";
    while ($row = $enrolls->fetch_assoc()) {
        echo "<tr>
                <td>{$row['student_id']}</td>
                <td>{$row['course_code']}</td>
                <td>{$row['course_title']}</td>
                <td>{$row['semester']}</td>
                <td>
                    <a href='edit_enroll.php?id={$row['id']}'>Edit</a> |
                    <a href='enroll.php?delete={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No enrollment records found.</p>";
}
?>
</body>
</html>
