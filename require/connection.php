<?php

function connectdb() {


$dbHostname='localhost';
   $dbUsername= 'root';
   $dbPassword= '';
   $db= 'pcr1db'; 

   //Database connection
   $con= new mysqli($dbHostname,$dbUsername,$dbPassword,$db);
  if($con->connect_error)
  {
    echo "<script>alert('Error');</script>";
      die('Connection Failed :' .$con->connect_error);
  }
  else
  {
    return $con;
  }
}

?>