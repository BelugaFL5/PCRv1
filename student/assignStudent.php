<?php
// assignStudent.php

require_once '../require/connection.php';

// Function to get all students
function getAllStudents()
{
    $con = connectdb();
    $query = "SELECT id, name FROM student";
    $result = $con->query($query);
    $con->close();
    return $result;
}

// Function to get all courses
function getAllCourses()
{
    $con = connectdb();
    $query = "SELECT id, name FROM course";
    $result = $con->query($query);
    $con->close();
    return $result;
}

// Function to search courses assigned to a specific student
function searchStudentAssignedCourses($studentID)
{
    $con = connectdb();
    $query = "SELECT course.id, course.name FROM student_course 
              JOIN course ON student_course.course_id = course.id 
              WHERE student_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $con->close();
    return $result;
}

// Function to assign a student to a course
function assignStudentToCourse($studentID, $courseID)
{
    $con = connectdb();
    $query = "INSERT INTO student_course (student_id, course_id) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $studentID, $courseID);
    $success = $stmt->execute();
    $stmt->close();
    $con->close();
    return $success ? "Assigned successfully." : "Failed to assign.";
}

// Function to unassign (remove) a student from a course
function removeStudentAssignment($studentID, $courseID)
{
    $con = connectdb();
    $query = "DELETE FROM student_course WHERE student_id = ? AND course_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $studentID, $courseID);
    $success = $stmt->execute();
    $stmt->close();
    $con->close();
    return $success ? "Unassigned successfully." : "Failed to unassign.";
}

function getStudentName($studentID)
{
    $con = connectdb();
    $query = "SELECT name FROM student WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $con->close();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name'];
    }
    return null; // If student not found
}

// Handle form submissions
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['search_student_id'])) {
        $studentID = $_POST['search_student_id'];
        $searchResult = searchStudentAssignedCourses($studentID);
    } elseif (isset($_POST['assign_student_id'], $_POST['assign_course_id'])) {
        $studentID = $_POST['assign_student_id'];
        $courseID = $_POST['assign_course_id'];
        $message = assignStudentToCourse($studentID, $courseID);
    } elseif (isset($_POST['delete_student_id'], $_POST['delete_course_id'])) {
        $studentID = $_POST['delete_student_id'];
        $courseID = $_POST['delete_course_id'];
        $message = removeStudentAssignment($studentID, $courseID);
    }
}

$students = getAllStudents();
$courses = getAllCourses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Student to Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h2>Assign Student to Course</h2>
    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="assign_student_id" class="form-label">Student:</label>
            <select name="assign_student_id" id="assign_student_id" class="form-select">
                <option value="">Select Student</option>
                <?php while ($row = $students->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="assign_course_id" class="form-label">Course:</label>
            <select name="assign_course_id" id="assign_course_id" class="form-select">
                <option value="">Select Course</option>
                <?php while ($row = $courses->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign</button>
    </form>

    <h2>Search Student's Assigned Courses</h2>
    <form action="" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="search_student_id" class="form-label">Student:</label>
            <select name="search_student_id" id="search_student_id" class="form-select">
                <option value="">Select Student</option>
                <?php $students->data_seek(0); while ($row = $students->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php if (isset($searchResult)): 
        
         // Fetch the student name
         $studentName = getStudentName($_POST['search_student_id']);
         ?>
        <h3>Results for <?php echo htmlspecialchars($studentName); ?></h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $searchResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>
                            <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="delete_student_id" value="<?php echo htmlspecialchars($_POST['search_student_id']); ?>">
                                <input type="hidden" name="delete_course_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
