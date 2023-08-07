<!-- Include the header file -->
<?php
session_start();
include "../Connection/connection.php";
include '../Header/student_header.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title> Student's Profile Page</title>
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
<div class="container mt-4" style="height: 800px;">
  <div class="card">
    <div class="card-header bg-secondary text-white">
      <h4>Student's Profile</h4>
    </div>
    <div class="card-body">
      <div class="form-group row">
      <label for="full-name" class="col-sm-3 col-form-label" style="font-weight: bold; font-size: 1.2rem;">Full Name:</label>
        <div class="form-control" readonly>
          <?php echo "<strong>" . $_SESSION["full-name"] . "</strong>"; ?>
        </div>
      </div>

      <div class="form-group row">
      <label for="id-number" class="col-sm-3 col-form-label" style="font-weight: bold; font-size: 1.2rem;">Id number:</label>
        <div class="form-control" readonly>
          <?php echo "<strong>" . $_SESSION["idNumber"] . "</strong>"; ?>
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
        
      <div class="form-group row">
      <label for="department" class="col-sm-3 col-form-label" style="font-weight: bold; font-size: 1.2rem;">Department:</label>
        <div class="form-control" readonly>
          <?php echo "<strong>" . $_SESSION["department"] . "</strong>"; ?>
        </div>

      <div class="form-group row edit-button-container">
          <div class="col-sm-12">
           <a href="edit-profile.php" class="btn btn-success edit-button">Edit</a>
      </div>
      </div>
      </div>
     </div>
  </div>
</div>



</body>
</html>
<?php include "../Header/footer.php" ?> <!--- footer -->

