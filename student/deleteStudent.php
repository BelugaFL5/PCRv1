<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    // Sanitize ID input
    $id = intval($_GET['id']);

    // Delete query
    $sql = "DELETE FROM student WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Student deleted successfully!');
                window.location.href = 'studentList.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting student: " . $conn->error . "');
                window.location.href = 'studentList.php';
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>
            alert('Invalid request!');
            window.location.href = 'studentList.php';
          </script>";
}

$conn->close();
?>
