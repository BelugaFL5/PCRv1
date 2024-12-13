<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Student Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
  <div class="wrapper">
    <div class="container mt-5">
      <header class="mb-4 text-center">
        <h1>Manage Students</h1>
      </header>
      <div class="text-end mb-3">
        <a href="addStudent.php" class="btn btn-primary">Add Student</a>
      </div>
<table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date Registered</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch student data
        $sql = "SELECT * FROM student ORDER BY DateOfReg ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['DateOfReg']}</td>
                    <td>
                        <a href='../student/editStudent.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='deleteStudent.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr>
                    <td colspan='5' class='text-center'>No students found.</td>
                  </tr>";
        }
        ?>
    </tbody>
</table>

    </div>
  </div>
</body>
</html>
