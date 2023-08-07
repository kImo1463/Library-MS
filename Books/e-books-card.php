<?php
include "../Connection/connection.php"; // db configuration
// start the session
session_start();
// check if the user is logged in and their user type
if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'student') {
    // if the user type is student, include the student header file
    include "../Header/student_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // if the user type is not admin, include the regular header file
    include "../Header/staff_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'teacher') {
    // if the user type is teacher include the teacher header file
    include "../Header/teacher_header.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>E-Books list Page</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Bootstrap icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  

  <div class="container mt-3">
  <h2>E-Books</h2>
  <div class="row mt-3">
    <div class="col-md-4 mb-3">
      <a href="e-books-list.php?category=Computer Science" style="text-decoration:none;">
        <div class="card bg-primary text-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="fas fa-book-open fa-3x mb-3"></i>
            <h5 class="card-title text-center"><b>Computer Science</b></h5>
            <p class="card-text text-center">Click here to view e-books related to Computer Science.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="e-books-list.php?category=Information System" style="text-decoration:none;">
        <div class="card bg-secondary text-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="fas fa-book-open fa-3x mb-3"></i>
            <h5 class="card-title text-center"><b>Information System</b></h5>
            <p class="card-text text-center">Click here to view e-books related to Information System.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="e-books-list.php?category=Information Technology" style="text-decoration:none;">
        <div class="card bg-success text-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="fas fa-book-open fa-3x mb-3"></i>
            <h5 class="card-title text-center"><b>Information Technology</b></h5>
            <p class="card-text text-center">Click here to view e-books related to Information Technology.</p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-4 mb-3">
      <a href="e-books-list.php?category=Electrical Engineering" style="text-decoration:none;">
        <div class="card bg-success text-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="fas fa-book-open fa-3x mb-3"></i>
            <h5 class="card-title text-center"><b>Electrical Engineering</b></h5>
            <p class="card-text text-center">Click here to view e-books related to Electrical Engineering.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="e-books-list.php?category=Mechanical Engineering" style="text-decoration:none;">
        <div class="card bg-secondary text-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="fas fa-book-open fa-3x mb-3"></i>
            <h5 class="card-title text-center"><b>Mechanical Engineering</b></h5>
            <p class="card-text text-center">Click here to view e-books related to Mechanical Engineering.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="e-books-list.php?category=Bio-medical Engineering" style="text-decoration:none;">
        <div class="card bg-primary text-white">
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="fas fa-book-open fa-3x mb-3"></i>
            <h5 class="card-title text-center"><b>Bio-medical Engineering</b></h5>
            <p class="card-text text-center">Click here to view e-books related to Bio-medical Engineering.</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

</body>
</html>
