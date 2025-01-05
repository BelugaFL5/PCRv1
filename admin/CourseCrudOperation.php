<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pcr1db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS course (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    description TEXT NOT NULL
)";
$conn->query($sql);

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $sql = "INSERT INTO course (name, description) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $description);
        $stmt->execute();
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $sql = "UPDATE course SET name=?, description=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $description, $id);
        $stmt->execute();
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM course WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

// Fetch all course
$course = $conn->query("SELECT * FROM course");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
</head>
<body>
    <h1>Course Management</h1>

    <h2>Add New Course</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Course Name" required>
        <textarea name="description" placeholder="Course Description" required></textarea>
        <button type="submit" name="create">Add Course</button>
    </form>

    <h2>All Course</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $course->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                        <textarea name="description" required><?php echo $row['description']; ?></textarea>
                        <button type="submit" name="update">Update</button>
                    </form>
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>