<?php
// start the session
session_start();
include "../Connection/connection.php"; // db configuration
if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') {
    // if the user type is admin, include the admin header file
    include "../Header/admin_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // if the user type is staff, include the staff header file
    include "../Header/staff_header.php";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>students list card page</title>
	
</head>
<body>

<div class="container mt-3">
  <h2>Students List</h2>
  <div class="row mt-3">
    <div class="col-md-4 mb-3">
      <a href="students-list.php?category=Computer Science" style="text-decoration:none;">
        <div class="card bg-primary text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Computer Science</h5>
            <p class="card-text">Click here to view students which are enrolled in Computer Science.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="students-list.php?category=Information System" style="text-decoration:none;">
        <div class="card bg-secondary text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Information System</h5>
            <p class="card-text">Click here to  view students which are enrolled in Information System.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="students-list.php?category=Information Technology" style="text-decoration:none;">
        <div class="card bg-success text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Information Technology</h5>
            <p class="card-text">Click here to  view students which are enrolled in Information Technology.</p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-4 mb-3">
      <a href="students-list.php?category=Electrical Engineering" style="text-decoration:none;">
        <div class="card bg-success text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Electrical Engineering</h5>
            <p class="card-text">Click here to  view students which are enrolled in Electrical Engineering.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="students-list.php?category=Mechanical Engineering" style="text-decoration:none;">
        <div class="card bg-secondary text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Mechanical Engineering</h5>
            <p class="card-text">Click here to  view students which are enrolled in Mechanical Engineering.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="students-list.php?category=Bio-medical Engineering" style="text-decoration:none;">
        <div class="card bg-primary text-white">
          <div class="card-body text-center">
            <i class="bi bi-book-fill fa-3x mb-3"></i>
            <h5 class="card-title">Bio-medical Engineering</h5>
            <p class="card-text">Click here to  view students which are enrolled in Bio-medical Engineering.</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
    
      
</body>
</html>
