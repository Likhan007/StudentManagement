<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<h2>Edit Student</h2>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $student_id = $_POST["student_id"];
    $department = $_POST["department"];
    $major = $_POST["major"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];

    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, student_id=?, department=?, major=?, dob=?, address=? WHERE id=?");
    $stmt->bind_param("sssssssi", $name, $email, $student_id, $department, $major, $dob, $address, $id);
    $stmt->execute();
    echo "<p class='success'>Updated successfully!</p>";
    // Refresh data
    $result = $conn->query("SELECT * FROM students WHERE id=$id");
    $data = $result->fetch_assoc();
}
?>

<form method="POST">
    Name*: <input type="text" name="name" value="<?= $data['name'] ?>" required><br><br>
    Email*: <input type="email" name="email" value="<?= $data['email'] ?>" required><br><br>
    Student ID: <input type="text" name="student_id" value="<?= $data['student_id'] ?>"><br><br>
    Department: 
    <select name="department">
        <option <?= $data['department'] == 'CSE' ? 'selected' : '' ?>>CSE</option>
        <option <?= $data['department'] == 'EEE' ? 'selected' : '' ?>>EEE</option>
        <option <?= $data['department'] == 'BBA' ? 'selected' : '' ?>>BBA</option>
    </select><br><br>
    Major:
    <select name="major">
        <option <?= $data['major'] == 'Software' ? 'selected' : '' ?>>Software</option>
        <option <?= $data['major'] == 'Network' ? 'selected' : '' ?>>Network</option>
        <option <?= $data['major'] == 'AI' ? 'selected' : '' ?>>AI</option>
    </select><br><br>
    Date of Birth: <input type="date" name="dob" value="<?= $data['dob'] ?>"><br><br>
    Address: <textarea name="address"><?= $data['address'] ?></textarea><br><br>
    <button type="submit">Update</button>
</form>
</body>
</html>
