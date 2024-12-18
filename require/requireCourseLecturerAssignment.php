<?php

require_once 'connection.php';
require_once 'requireCourse.php'

function loadAllCourseAssignments()
{
    $con = connectdb();
    if(!$con)
    {
        die("". mysqli_connect_error());
    }
    $query = "select * from lecturer_course";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $result=$stmt->get_result();
    return $result;
}

function addCourseAssignment($lecturerID, $courseID)
{
    $con = connectdb();
    if(!$con)
    {
        die("". mysqli_connect_error());
    }
    $results = loadAllCourseAssignments();
    $results = $results->fetch_assoc();

    #  Close and reestablish connection
    $query = 'select * from lecturer_course where lecturer_id = ? AND course_id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $lecturerID, $courseID);
    $stmt->execute();
    $result=$stmt->get_result();

    if ($result->num_rows > 0)
    {
        $stmt->close();
        $con->close();
        return "Entry exists in database.";
    }
    
    
        $stmt->close();
        $query = 'insert into lecturer_course(lecturer_id, course_id) values (?,?)';
        $stmt = $con->prepare($query);
        $stmt->bind_param("ii", $lecturerID, $courseID);
        

        if ($stmt->execute())
        {
            $stmt->close();
            $con->close();
            return "Entry saved to database!";
        }
        else
        {
            $stmt->close();
            $con->close();
            return "Entry is not saved to database.";
        }
        
    }

function searchLecturerAssignedCourses($lecuterID)
{
    $con = connectdb();
    if(!$con)
    {
        die("". mysqli_connect_error());
    }
    $results = loadAllCourseAssignments();
    $results = $results->fetch_assoc();

    #  Close and reestablish connection
    $query = 'select course_id from lecturer_course where lecturer_id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $lecturerID);
    $stmt->execute();
    $result=$stmt->get_result();
}

?>