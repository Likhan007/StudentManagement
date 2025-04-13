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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = trim($_POST["student_id"]);
    $course_code = trim($_POST["course_code"]);
    $course_title = $_POST["course_title"];
    $semester = $_POST["semester"];

    $errors = [];
    if (empty($student_id)) $errors[] = "Student ID is required.";
    if (empty($course_code)) $errors[] = "Course Code is required.";

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_code, course_title, semester) 
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $student_id, $course_code, $course_title, $semester);
        $stmt->execute();
        echo "<p style='color:green;'>Enrolled successfully!</p>";
    } else {
        foreach ($errors as $e) echo "<p style='color:red;'>$e</p>";
    }
}
?>

<form method="POST">
    Student ID*: <input type="text" name="student_id" required><br><br>
    Course Code*: <input type="text" name="course_code" required><br><br>
    Course Title: <input type="text" name="course_title"><br><br>
    Semester:
    <select name="semester">
        <option>Fall</option><option>Spring</option><option>Summer</option>
    </select><br><br>
    <button type="submit">Enroll</button>
</form>

</body>
</html>
