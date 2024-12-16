<?php

require_once 'connection.php';


function loadAllCourses()
{
    $con = connectdb();
    if(!$con)
    {
        die("". mysqli_connect_error());
    }
    $query = "select * from course";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $result=$stmt->get_result();
    return $result;
}

function assignLecturerToCourse($lecturerID, $courseID )
{
    $con = connectdb();
    if($con)
    {
        die("". mysqli_connect_error());
    }
    $query = "insert into lecturer_course values (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $lecturerID,$courseID);
    $stmt->execute();
    if ($stmt->execute())
    {
        return "Entry information updated in database.";
        header()
    }
    else
    {
        return "Error updating entry information.";
    }

}

?>