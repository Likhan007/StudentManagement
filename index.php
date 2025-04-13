<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include 'navbar.php'; ?>


    <h2>Student Registration</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $student_id = $_POST["student_id"];
        $department = $_POST["department"];
        $major = $_POST["major"];
        $dob = $_POST["dob"];
        $address = $_POST["address"];

        $errors = [];

        if (empty($name)) $errors[] = "Name is required.";
        if (empty($email)) $errors[] = "Email is required.";

        if (empty($errors)) {
            $stmt = $conn->prepare("INSERT INTO students (name, email, student_id, department, major, dob, address)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $email, $student_id, $department, $major, $dob, $address);
            $stmt->execute();
            echo "<p style='color:green;'>Student registered successfully!</p>";
        } else {
            foreach ($errors as $e) echo "<p style='color:red;'>$e</p>";
        }
    }
    ?>

    <form method="POST">
        Name*: <input type="text" name="name" required><br><br>
        Email*: <input type="email" name="email" required><br><br>
        Student ID: <input type="text" name="student_id"><br><br>
        Department: 
        <select name="department">
            <option>CSE</option><option>EEE</option><option>BBA</option>
        </select><br><br>
        Major:
        <select name="major">
            <option>Software</option><option>Network</option><option>AI</option>
        </select><br><br>
        Date of Birth: <input type="date" name="dob"><br><br>
        Address: <textarea name="address"></textarea><br><br>
        <button type="submit">Submit</button>
    </form>
<!-- <div class="parentContainer">

</div> -->

</body>
</html>
