<?php

//initialize message

$emailErr = $passwordErr = $confirmPasswordErr ='';
require '../require/selectOneLecturer.php';


//declare variables
$id='';
$name='';
$email= '';
$password= '';
$con = connectdb();

if (isset($_GET['id']))
{
  $id= intval($_GET['id']) ;
  $result=mysqli_fetch_assoc(selectLecturer($id));
  $name=$result['name'];
  $email=$result['email'];
  $password=$result['password'];


}

//Add lecturer php code
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{ 
  // $id= $_POST['id'];
  $newName= $_POST['name'];
  $newEmail= $_POST['email'];
  $newPassword= $_POST['password'];
  $confirmPassword= $_POST['confirmPassword'];


  if (validateEmail($newEmail) === 0 && !($newEmail===$email))
  {
    $emailErr = "Email is repeated. Please use another email";
            //focus on email bracket
        //     echo "<script>
        //     document.addEventListener('DOMContentLoaded',function()
        //     {
        //     document.getElementById('email').focus();
        //     document.getElementById('name').value = '".htmlspecialchars($name,ENT_QUOTES). "'
        //     document.getElementById('email').value = '".htmlspecialchars($email,ENT_QUOTES). "'
        //     document.getElementById('password').value = '".htmlspecialchars($password,ENT_QUOTES). "'
        //     });
        // </script>";
  }
  //change to 8 after debugging 
  if (strlen($newPassword) <1)
  {
    $passwordErr = "Please enter a password with at least 8 characters";
  }

  if (strcmp($newPassword, $confirmPassword) !== 0)
  {
    $confirmPasswordErr = 'Passwords do not match';
  }

  if (empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr))
   //save new credentials to database
  {
    echo $newName;
    $id=intval($id);
    echo 
    "<script>
      alert('".saveLecturer($id,$newName,$newEmail,$newPassword)."');
      
      </script>
      ";
     header("Location: lecturerManagement.php");
    exit();
  }


    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lecturer</title>

</head>
<body>
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
                                    <li><a class="dropdown-item" href="">BlaBla</a></li>
                                    <hr class="dropdown-split">
                                    <li><a class="dropdown-item" href="">BlaBla</a></li>
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
    <section class="gradient-custom">

      <div class="container py-5 h-80 ">
          <div class="row d-flex justify-content-center align-items-center h-90">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-warning login-custom-card" style="border-radius: 1rem;">
            <div class="card-body p-5">
          <form action="" method="post">
              <div class="mb-md-5 mt-md-4 pb-5">
                <div class="text-center">
                  <h2 class="fw-bold mb-2 text-center">Edit Lecturer</h2>
                  <p class="mb-5"></p>
                </div>
  
                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <label class="form-label" for="name">Name</label>
                  <input type="text" id="name" class="form-control form-control-lg" name="name" value="<?php echo (isset($name)) ? $name : '' ?>" required/>
                </div>
                
                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" id="email" class="form-control form-control-lg" name="email" value="<?php echo (isset($email)) ? $email : '' ?>" required/>
                  <div style="color: red;"><?php echo $emailErr; ?></div>
                </div>
                
                
                <div data-mdb-input-init class="form-outline form-white mb-4" >
                  <label class="form-label" for="email">Password</label>

                  <input type="password" id="password" class="form-control form-control-lg" name="password" value="<?php echo (isset($password)) ? $password : '' ?>" required/>
                  <div style="color: red;"><?php echo $passwordErr; ?></div>
                </div>
                
                <div data-mdb-input-init class="form-outline form-white mb-4" >
                  <label class="form-label" for="email">Confirm Password</label>
                  <input type="password" id="confirmPassword" class="form-control form-control-lg" name="confirmPassword"  required />
                  <div style="color: red;"><?php echo $confirmPasswordErr; ?></div>
              </div>
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5 login-button" type="submit">Save</button>
              
          </form>
  
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/custom.css">
</body>
</html>