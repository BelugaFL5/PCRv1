<?php

$errorMessage="";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    //declare variables for mysql 
    $dbHostname='localhost';
    $dbUsername= 'root';
    $dbPassword= '';
    $db= 'pcr1db'; 

    //Database connection
    $conn= new mysqli($dbHostname,$dbUsername,$dbPassword,$db);
    if ($conn->connect_error) {echo ''. $conn->connect_error; }
    else
    {
        $stmt = $conn->prepare("SELECT * FROM lecturer where email= ?");
        $stmt-> bind_param("s",$email);
        $stmt->execute();
        $result=$stmt->get_result();
        if ($result->num_rows > 0)
        {
            echo "Login SUccezssful"; //works
            //todo
        }
        elseif ($result->num_rows > 0 || $email == "admin@admin.com" && $password == "admin")
        {
            header("Location:../admin/adminMainPage.php");
        }
        else
        {
            $stmt->close();
            $stmt=$conn->prepare("SELECT * FROM student WHERE email =?");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result=$stmt->get_result();
            if ($result->num_rows > 0)
            {
                
            }
            else
            {
                
                $stmt->close();
                $errorMessage= "Email is not registered";

                echo "<script>
                    alert('" . $errorMessage . "');
                    document.addEventListener('DOMContentLoaded', function()
                    {
                        document.getElementById('loginform').reset();
                        document.getElementById('email').value = '';
                        document.getElementById('email').focus();
                    });
                </script>";

           }
        }

        
    }


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>
      window.onload = function()
      {
        const params = new URLSearchParams(window.location.search);
        if(params.has('success'))
      {
        alert('Registration successful!')
      }
      };
    </script>
</head>
<body>
    <section name="background" class="gradient-custom vh-auto min-vh-100">
        <div class="container">
            <div class="row d-flex justify-content-lg-end justify-content-center align-item-center py-5 mx-auto">
                <div class=" card login-custom-card">
                    <div class="card-body p-5">
                        <div class = "text-center p-3">
                            <h1>Peer Code Review</h1>
                        </div>
                        <div class="py-3" >
                            <h3>Login</h3>
                            <p class="my-5"></p>
                            <form action="" method="post" id="loginform">
                                <div class="form-group mb-5" >
                                    <label class="form-label"  for="email">Email Address</label>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Enter email" required>
                                </div>
                                
                                <div class="form-group">
                                    
                                    <label class="form-label"  for="password">Password</label>
                                    <input name="password" id="password" type="password" class="form-control" placeholder="Enter password" required>

                                </div>
                                <div class="py-5">
                                    <button type="submit" class="btn login-button">Login</button>

                                </div>
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