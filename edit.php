<?php
include 'db.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the student's existing data
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no student found, redirect
    if (!$student) {
        header("Location: index.php");
        exit();
    }
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $course_section = $_POST['course_section'];

    // Check if any data has changed
    $changesMade = false;
    if ($firstname != $student['firstname']) {
        $changesMade = true;
    }
    if ($middlename != $student['middlename']) {
        $changesMade = true;
    }
    if ($lastname != $student['lastname']) {
        $changesMade = true;
    }
    if ($age != $student['age']) {
        $changesMade = true;
    }
    if ($address != $student['address']) {
        $changesMade = true;
    }
    if ($course_section != $student['course_section']) {
        $changesMade = true;
    }

    if ($changesMade) {
        // Update student data in the database if there are changes
        $sql = "UPDATE students SET firstname = ?, middlename = ?, lastname = ?, age = ?, address = ?, course_section = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$firstname, $middlename, $lastname, $age, $address, $course_section, $id]);

        // Redirect with success message
        header("Location: edit.php?id=$id&success=1");
        exit();
    } else {
        // Inform the user that no changes were made
        header("Location: edit.php?id=$id&no_change=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
     <link rel="stylesheet" href="style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert script -->
</head>
<body>
<div class="container mt-5">
    <h2>Edit User</h2>
    <form action="edit.php?id=<?= $student['id'] ?>" method="POST">
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($student['firstname']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="middlename" class="form-label">Middle Name:</label>
            <input type="text" class="form-control" id="middlename" name="middlename" value="<?= htmlspecialchars($student['middlename']) ?>">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($student['lastname']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="text" class="form-control" id="age" name="age" value="<?= htmlspecialchars($student['age']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($student['address']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="course_section" class="form-label">Course & Section:</label>
            <input type="text" class="form-control" id="course_section" name="course_section" value="<?= htmlspecialchars($student['course_section']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<!-- SweetAlert Success Notification -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<script>
    Swal.fire({
        title: 'Updated!',
        text: 'User updated successfully',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        // Redirect to index.php after confirmation
        window.location.href = 'index.php';
    });
</script>
<?php endif; ?>

<!-- SweetAlert No Changes Notification -->
<?php if (isset($_GET['no_change']) && $_GET['no_change'] == 1): ?>
<script>
    Swal.fire({
        title: 'No Changes!',
        text: 'No changes were made to the data.',
        icon: 'info',
        confirmButtonText: 'OK'
    }).then(() => {
        // Stay on the page after clicking OK
    });
</script>
<?php endif; ?>

</body>
</html>
