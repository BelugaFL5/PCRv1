<?php

//initialize message
$nameErr= $emailErr = $passwordErr = $confirmPasswordErr ='';
$edit = false;

$passwordVisibility = $edit ? 'visible' : 'hidden';

//Add lecturer php code
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

  $name= $_POST['name'];
  $email= $_POST['email'];
  $password= '';
  $role='lecturer';


   //declare variables for mysql 
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
    //input and SQL validation
    $ok = 0;
    $stmt= $con->prepare("SELECT * FROM lecturer where email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->get_result();
    if ($result->num_rows >0)
    {
        $emailErr= "Email is already taken.";
        $stmt->close();

        //focus on email bracket
        echo "<script>
        document.addEventListener('DOMContentLoaded',function()
        {
        document.getElementById('email').focus();
        document.getElementById('name').value = '".htmlspecialchars($name,ENT_QUOTES). "'
        document.getElementById('password').value = '".htmlspecialchars($password,ENT_QUOTES). "'
        });
    </script>";
    }
    
    else
    {
        $stmt->close();
        
        $n=0;
        $letter=array_merge(range("a","z"),range("A","Z"),range(0,9));
        
        
        //random 8 chars for temporary password...
        while($n < 8)
        {
            $password.=$letter[rand(0,count($letter))];
            $n++;
          }

          //creator == admin (temporary)
          $creator='admin';

          //convert timestamp to string before saving
          $time=strval(date("Y-m-d H:i:s"));
          
          $stmt = $con->prepare("insert into lecturer(name, email, password, dateOfReg) VALUES (?,?,?,?)");
          $stmt->bind_param("ssss", $name,$email,$password,$time);
          
          //SQL execution and checking 
          if ($stmt->execute()) 
          {
            //return to lecturer management page
            
            echo "<script>alert('Password is ".$password."');</script>"; //works
              header("Location: lecturerManagement.php");
              exit();
          } 
          else
          {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }
            $stmt-> close();
            $con-> close();
            
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lecturer</title>
</head>
<body>
<div class="gradient-custom vh-100">

  <div class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark ms-auto">
          <div class="container-fluid p-3">
              <a class="navbar-brand brand-name px-4 fw-bolder" href="adminMainPage.php" style="font-size: 40px;">
                  <img src="../icons/square-terminal.png" alt="Logo" width="30" height="30" class="mx-2" style="filter: invert(100%);">
                  Logo</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                  <ul class="navbar-nav justify-content-center mr-4 text-end mt-4 mt-md-0 ">
                      <li class="nav-item dropdown px-3">
                          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">User Management</a>
                          <ul class="dropdown-menu ">
                              <li><a class="dropdown-item" href="lecturerManagement.php">
                                  <img src="../icons/lecture.png" alt="" width="40" height="40">
                                  Lecturers</a></li>
                                  <hr class="dropdown-split">
                                  <li><a class="dropdown-item" href="">
                                      <img src="../icons/students.png" alt="" width="40" height="40">
                                      Students</a></li>
                                  </ul>
                              </li>
                              <li class="nav-item dropdown px-3">
                                  <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">Course Management</a>
                                  <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="">Add Course</a></li>
                                  <hr class="dropdown-split">
                                  <li><a class="dropdown-item" href="lecturerCourse.php">Assign Course</a></li>
                                  </ul>
                              </li>
                              <li class="nav-item dropdown px-5">
                                  <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">Profile</a>
                                  <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="">BlaBla</a></li>
                                      <hr class="dropdown-split">
                              <li><a class="dropdown-item" href="../login/login.php">Logout</a></li>
                          </ul>
              </div>
          </div>
      </div>
      <section class="">
  
        <div class="container py-5 h-100 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-warning register-custom-card" style="border-radius: 1rem;">
              <div class="card-body p-5">
            <form action="" method="post">
                <div class="mb-md-5 mt-md-4 pb-5">
                  <div class="text-center">
                    <h2 class="fw-bold mb-2 text-center">Add Lecturer</h2>
                    <p class="mb-5"></p>
                  </div>
    
                  <div data-mdb-input-init class="form-outline form-white mb-4">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" id="name" class="form-control form-control-lg" name="name" required/>
                  </div>
                  
                  <div data-mdb-input-init class="form-outline form-white mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" class="form-control form-control-lg" name="email" required/>
                    <div style="color: red;"><?php echo $emailErr; ?></div>
                  </div>
                
                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5 login-button" type="submit">Add</button>
                
            </form>
    
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/custom.css">
</body>
</html>