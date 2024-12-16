<?php

require_once 'connection.php';

function selectLecturer($id)
{
    $con= connectdb();

        $stmt=$con-> prepare("SELECT * FROM lecturer where id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result= $stmt->get_result();
        return $result;
}


function saveLecturer($id, $name, $email, $password)
{
    $con = connectdb();
    $stmt=$con->prepare("UPDATE lecturer SET name = ?, email = ?, password = ? 
    WHERE id = ?");
    $stmt->bind_param("sssi",$name, $email, $password, $id);
    if ($stmt->execute())
    {
        return "Entry information updated in database.";
    }
    else
    {
        return "Error updating entry information.";
    }

}

function validateEmail($email)
{
    $con = connectdb();
    $stmt=$con->prepare("SELECT * from lecturer where email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result= $stmt->get_result();
    if ($result->num_rows === 0)
    {
        echo $result->num_rows;
        return 1;
    }
    else
    {
        return 0;
    }
}

function searchLecturer($input)
{
    $con = connectdb();
    $stmt=$con->prepare("SELECT * from lecturer where email like ?");
    $email = "%".$input."%";
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result= $stmt->get_result();
    if (!$result)
    {
        throw new Exception("Error in search query" .mysqli_error($con));
    }
    else
    {
        return $result;

    }
    
}

function loadAllLecturers() {
    
    $con = connectdb();
    if(!$con)
    {
        die("". mysqli_connect_error());
    }
   
        $query= "select * from lecturer";
        $statement=$con-> prepare($query);
        $statement->execute();
        $result= $statement->get_result();
        return $result;
}


?>