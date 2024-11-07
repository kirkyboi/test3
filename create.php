<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $course_section = $_POST['course_section'];

    // Insert new student data into the database
    $sql = "INSERT INTO students (firstname, middlename, lastname, age, address, course_section) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$firstname, $middlename, $lastname, $age, $address, $course_section]);

    // Redirect with success message
    header("Location: create.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
     <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert script -->
</head>
<body>
<center><div class="container mt-5">
    <form action="create.php" method="POST">
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="mb-3">
            <label for="middlename" class="form-label">Middle Name:</label>
            <input type="text" class="form-control" id="middlename" name="middlename">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="text" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="course_section" class="form-label">Course & Section:</label>
            <input type="text" class="form-control" id="course_section" name="course_section" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</center>

<!-- SweetAlert Success Notification -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<script>
    Swal.fire({
        title: 'Success!',
        text: 'User submitted successfully',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        // Redirect to index.php after confirmation
        window.location.href = 'index.php';
    });
</script>
<?php endif; ?>

</body>
</html>
