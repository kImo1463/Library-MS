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
	
	<title>Books list Page</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Bootstrap icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  

<div class="container mt-3">
  <h2>Books</h2>
  <div class="row mt-3">
    <div class="col-md-4 mb-3">
      <a href="books-list.php?category=Computer Science" style="text-decoration:none;">
        <div class="card bg-primary text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Computer Science</h5>
            <p class="card-text">Click here to view books related to Computer Science.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="books-list.php?category=Information System" style="text-decoration:none;">
        <div class="card bg-secondary text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Information System</h5>
            <p class="card-text">Click here to view books related to Information System.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="books-list.php?category=Information Technology" style="text-decoration:none;">
        <div class="card bg-success text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Information Technology</h5>
            <p class="card-text">Click here to view books related to Information Technology.</p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-4 mb-3">
      <a href="books-list.php?category=Electrical Engineering" style="text-decoration:none;">
        <div class="card bg-success text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Electrical Engineering</h5>
            <p class="card-text">Click here to view books related to Electrical Engineering.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="books-list.php?category=Mechanical Engineering" style="text-decoration:none;">
        <div class="card bg-secondary text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Mechanical Engineering</h5>
            <p class="card-text">Click here to view books related to Mechanical Engineering.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="books-list.php?category=Bio-medical Engineering" style="text-decoration:none;">
        <div class="card bg-primary text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Bio-medical Engineering</h5>
            <p class="card-text">Click here to view books related to Bio-medical Engineering.</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

    
</body>
</html>
