<?php
  require_once '../require/requireLecturer.php';
  require_once '../require/requireCourse.php';
  $resultLecturers = loadAllLecturers();
  $resultCourses = loadAllCourses();
  $resultCourseAssignment = loadAllCourseAssignments();
  $selectLecturerErr = $selectCourseErr = '';


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    $lecturerName = $_POST['lecturer'];
    $courseName = $_POST['course'];

    $lecturerResult = searchLecturerByName($lecturerName);
    $lecturerData = $lecturerResult->fetch_assoc();
    $lecturerID = $lecturerData['id'];


    $courseResult = searchCourseByName($courseName);
    $courseData = $courseResult->fetch_assoc();
    $courseID = $courseData['id'];
  }
  if (empty($lecturerName))
  {
      $selectLecturerErr = "Please do not leave this field empty!";
    }
    else if (empty($courseName))
    {
    $selectCourseErr = "Please do not leave this field empty!";
  }

  if (empty($selectLecturerErr)&& empty($selectCourseErr))
  {
    # check for repetitive entries
    





    echo
    "
    <script>
      alert('".saveLecturer()."');
    </script>

    ";
  }

  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Course</title>
</head>
<body>
    <div class="gradient-custom vh-auto min-vh-100">

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
                          <h2 class="fw-bold mb-2 text-center">Assign Course</h2>
                          <p class="mb-5"></p>
                        </div>
          
                        <div data-mdb-input-init class="form-outline form-white mb-4">
                          <label class="form-label" for="name">Lecturer</label>
                          <input class="form-control" id="lecturer" list="lecturerList">
                          <datalist id="lecturerList">
                          <?php
                                while($row = mysqli_fetch_assoc($resultLecturers)) 
                                {

                                  echo '<option value="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '"></option>';
                                }
                                ?>
                                </datalist>
                              <div style="color: red;"><?php echo $selectLecturerErr; ?></div>

                              </div>
                              
                              <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="course">Course</label>
                                <input class="form-control" id="course" list="courseList">
                                <datalist id="courseList">
                                  <?php
                                while($row = mysqli_fetch_assoc($resultCourses)) 
                                {
                                  echo '<option value="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '"></option>';
                                
                                }
                            ?>
                          </datalist>
                          <div style="color: red;"><?php echo $selectCourseErr; ?></div>

                        </div>
                      
                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5 login-button" type="submit">Save</button>
                      
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