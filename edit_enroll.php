<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Enrollment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<h2>Edit Enrollment</h2>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM enrollments WHERE id=$id");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_code = $_POST["course_code"];
    $course_title = $_POST["course_title"];
    $semester = $_POST["semester"];
    $grade = $_POST["grade"];

    $stmt = $conn->prepare("UPDATE enrollments SET student_id=?, course_code=?, course_title=?, semester=?, grade=? WHERE id=?");
    $stmt->bind_param("sssssi", $student_id, $course_code, $course_title, $semester, $grade, $id);
    $stmt->execute();
    echo "<p class='success'>Enrollment updated!</p>";
    $result = $conn->query("SELECT * FROM enrollments WHERE id=$id");
    $data = $result->fetch_assoc();
}
?>

<form method="POST">
    Student ID*: <input type="text" name="student_id" value="<?= $data['student_id'] ?>" required><br><br>
    Course Code*: <input type="text" name="course_code" value="<?= $data['course_code'] ?>" required><br><br>
    Course Title: <input type="text" name="course_title" value="<?= $data['course_title'] ?>"><br><br>
    Semester:
    <select name="semester">
        <option <?= $data['semester'] == 'Spring' ? 'selected' : '' ?>>Spring</option>
        <option <?= $data['semester'] == 'Summer' ? 'selected' : '' ?>>Summer</option>
        <option <?= $data['semester'] == 'Fall' ? 'selected' : '' ?>>Fall</option>
    </select><br><br>
    Grade: <input type="text" name="grade" value="<?= $data['grade'] ?>"><br><br>
    <button type="submit">Update</button>
</form>

</body>
</html>
