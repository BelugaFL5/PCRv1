<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
</head>
<body class="gradient-custom">
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
                                    <li><a class="dropdown-item" href="">Blabla</a></li>
                                    <hr class="dropdown-split">
                            <li><a class="dropdown-item" href="../login/login.php">Logout</a></li>
                        </ul>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/custom.css">
    
</body>
</html>