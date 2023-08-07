<!-- Include the header file -->
<?php
session_start();
include '../Header/staff_header.php';
include "../Connection/connection.php";


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Profile page</title>
    <style>
        .edit-button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .edit-button {
            width: 120px;
        }
    </style>
  
  </head>
  <body>
<div class="container mt-4" style="height: 700px;">
  <div class="card">
    <div class="card-header bg-secondary text-white">
      <h4>Staff Profile</h4>
    </div>
    <div class="card-body">
      <div class="form-group row">
      <label for="full-name" class="col-sm-3 col-form-label" style="font-weight: bold; font-size: 1.2rem;">Full Name:</label>
        <div class="form-control" readonly>
          <?php echo "<strong>" . $_SESSION["full-name"] . "</strong>"; ?>
        </div>
      </div>
      
      <div class="form-group row">
      <label for="username" class="col-sm-3 col-form-label" style="font-weight: bold; font-size: 1.2rem;">Username:</label>
        <div class="form-control" readonly>
          <?php echo "<strong>" . $_SESSION["username"] . "</strong>"; ?>
        </div>
      </div>
    
      <div class="form-group row">
      <label for="email" class="col-sm-3 col-form-label" style="font-weight: bold; font-size: 1.2rem;">Email:</label>
        <div class="form-control" readonly>
          <?php echo "<strong>" . $_SESSION["email"] . "</strong>"; ?>
        </div>
      </div>

      <div class="form-group row">
      <label for="phone" class="col-sm-3 col-form-label" style="font-weight: bold; font-size: 1.2rem;">Phone Number:</label>
        <div class="form-control" readonly>
          <?php echo "<strong>" . $_SESSION["phone-number"] . "</strong>"; ?>
        </div>
      </div>

      <div class="form-group row">
      <label for="sex" class="col-sm-3 col-form-label" style="font-weight: bold; font-size: 1.2rem;">Sex:</label>
        <div class="form-control" readonly>
          <?php echo "<strong>" . $_SESSION["sex"] . "</strong>"; ?>
        </div>
      </div>

      <div class="form-group row edit-button-container">
          <div class="col-sm-12">
           <a href="edit-profile.php" class="btn btn-success edit-button">Edit</a>
      </div>
        
     </div>
  </div>
</div>



</body>
</html>
