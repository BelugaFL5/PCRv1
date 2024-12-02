<?php

if ($_SERVER['REQUEST_METHOD']==='POST')
{

    //convert id to int
    $id=intval($_POST['id']);
    $lecturerName=$_POST['name'];
    $lecturerEmail=$_POST['email'];


    //check action 
    $action=$_POST['action'];

    $con= mysqli_connect("localhost","root","","pcr1db");
    if(!$con)
    {
        die("". mysqli_connect_error());
    }
   

    //edit function
    if ($action === 'edit')
    {

        echo 
        "<script>
        window.location.href = 'adminEditLecturer.php?id=" . urlencode($id) . "';
        </script>";
        
    }
    // delete function (works)
    elseif ($action === 'delete')
    {   
       $stmt= $con->prepare("DELETE FROM lecturer WHERE id=?");
       $stmt->bind_param("i", $id);
       if($stmt->execute())
       {
           htmlspecialchars(trim($lecturerName), ENT_QUOTES, 'UTF-8');
           echo "<script> alert('".$lecturerName." is removed from database');
           window.location.href = 'lecturerManagement.php';
           </script>;";
        }
        $stmt->close();
        $con->close();

        exit;
    }
    else
    {
        //do something
    }
}
?>