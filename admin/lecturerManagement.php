<?php
    require_once '../require/requireLecturer.php';

    $filter= 0;
    $keyword =  '';
    $result = '';
    $searchInputError = '';

    
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $action=$_POST['search-bar'];
        
        if ($action === 'search')
        {
            $filter= 1;
            $keyword =$_POST['email-search'];
        }
        elseif ($action === 'reset')
        {
            $filter= 0;
            $keyword = '';
        }
    }
    
    if ($filter === 0 )
    {
        $result = loadAllLecturers();
    }
    elseif ($filter === 1)
    {
        try
        {
            $result= searchLecturerByEmail($keyword);

        }
        catch (Exception $e)
        {
            $searchInputError = "Please enter a valid email";
            $result = loadAllLecturers();

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Lecturer</title>
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
<div  class="gradient-custom vh-100">

    <section>
        <div class=" container">
<div class="row d-flex justify-content-center align-items-center">
    <div class="search-bar col-md-6 pb-1">
        <form action="" method="post" id="emailForm">
            <div>
                <label class="form-label" for="email-search">Email</label>
                <input type="text" 
                       class="form-control form-input"
                       placeholder="search"
                       id="email-search"
                       name="email-search">
                <div class=""><?php echo $searchInputError ;?></div>

            </div>
        </form>
    </div>
    <!-- Search Button -->
    <div class="search-control col-md-6 pb-1">
        <button type="submit" form="emailForm" name="search-bar" value="search">
            <img src="../icons/search.png" alt="" title="Search by email">
        </button>
        <!-- Reset button -->
        <button type="submit" form="emailForm" name="search-bar" value="reset">
            <img src="../icons/refresh.png" alt="Reset Form" title="Reset table">
        </button>

            <a href="adminAddLecturer.php">
                <img src="../icons/user-add.png" alt="" title="Add lecturer">
            </a>

    </div>
</div>


        </div>
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <div class="card mt-5">
                        <div class="card-header">
                            <div class="card-body">
                                <table class="table table-bordered text-center table-striped">
                                    <tr class="bg-dark">
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                    <tr>
                                        <?php



                                            while($row=mysqli_fetch_assoc( $result ))
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['email'];?></td>

                                            <td class="table-icons">
                                                <form action="lecturerEntry.php" method="post" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                                    <input type="hidden" name="name" value="<?php echo $row['name'];?>">
                                                    <input type="hidden" name="email" value="<?php echo $row['email'];?>">
                                                    <button type="submit" name="action" value="edit">
                                                        <img src="../icons/edit.png" alt="">
                                                    </button>
                                                    
                                                    
                                                </form>
                                                
                                                <form action="lecturerEntry.php" method="post" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                                    <input type="hidden" name="name" value="<?php echo $row['name'];?>">
                                                    <button type="submit" name="action" value="delete">
                                                        <img src="../icons/delete.png" alt="">
    
                                                    </button>

                                                </form>

                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        
                                        ?>
                                    </tr>

                                </table>
    
                            </div>
    
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