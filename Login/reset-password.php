<?php
session_start();
// Database connection code
include "../Connection/connection.php";

// check if the user is logged in and their user type
if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'student') {
    // if the user type is student, include the student header file
    include "../Header/student_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // if the user type is staff, include the staff header file
    include "../Header/staff_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'teacher') {
    include "../Header/teacher_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') {
    // if the user type is admin, include the admin header file
    include "../Header/admin_header.php";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>reset password page</title>
    <style>
      .form-container {
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 30px;
        margin-top: 40px;
      }
      .form-label {
        font-weight: bold;
      }
    </style>

   <script>
  setTimeout(function() {
    document.getElementById('success-message').style.display = 'none';
  }, 3000); // hide after 5 seconds (5000 ms)

  setTimeout(function() {
    document.getElementById('error-message').style.display = 'none';
  }, 3000); // hide after 5 seconds (5000 ms)
  </script>
  </head>
  <body>

      <div class="mt-5 text-center">
        <h3>Reset Password</h3>
      </div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-md-offset-3">
      <div class="form-container">
        <form action="reset-password.php" method="post">
          <div class="form-group">
            <label for="old-password" class="form-label">Old Password:</label>
            <input type="password" class="form-control" id="old-password" placeholder="Enter old password" name="old_password" required>
          </div>
          <div class="form-group">
            <label for="new-password" class="form-label">New Password:</label>
            <input type="password" class="form-control" id="new-password" placeholder="Enter new password" name="new_password" required>
          </div>
          <button type="submit" name="submit" class="btn btn-success">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $user_type = $_SESSION['userType'];

    // Check if the old password is correct

    switch ($user_type) {
        case 'admin':
            $username = $_SESSION['username'];
            $query = "SELECT password FROM admin WHERE username = '$username'";

            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            if (!password_verify($old_password, $db_password)) {
                ?>
                <div class="alert alert-danger text-center" style="width: 541px; margin-left: 26%; background-color: #de1313; color: white;">
                    <strong>Old password is incorrect</strong>
                </div>
                <?php
            } elseif ($old_password === $new_password) {
                ?>
                <div class="alert alert-danger text-center" style="width: 541px; margin-left: 26%; background-color: #de1313; color: white;">
                    <strong>Old password and new password are the same</strong>
                </div>
                <?php
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE admin SET password = '$hashed_password' WHERE username = '$username'";
                mysqli_query($conn, $query);
                ?>
                <div class="alert alert-success text-center" style="width: 541px; margin-left: 28.9%;">
                    <strong>Password has been changed successfully</strong>
                </div>
                <?php
            }
            break;
        case 'student':
            $idNumber = $_SESSION['idNumber'];
            $query = "SELECT password FROM student WHERE idNumber = '$idNumber'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];
            if (!password_verify($old_password, $db_password)) {
                ?>
                <div id="error-message" class="alert alert-danger text-center" style="width: 541px; margin-left: 28.9%; background-color: #de1313; color: white;">
                    <strong>Old password is incorrect</strong>
                </div>
                <?php
            } elseif ($old_password === $new_password) {
                ?>
                <div id="error-message" class="alert alert-danger text-center" style="width: 541px; margin-left: 28.9%; background-color: #de1313; color: white;">
                    <strong>Old password and new password are the same</strong>
                </div>
                <?php
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE student SET password = '$hashed_password' WHERE idNumber = '$idNumber'";
                mysqli_query($conn, $query);
                ?>
                <div id="success-message" class="alert alert-success text-center" style="width: 541px; margin-left: 28.9%;">
                    <strong>Password has been changed successfully</strong>
                </div>
                <?php
            }
            break;
        case 'staff':
            $username = $_SESSION['username'];
            $query = "SELECT password FROM staff WHERE username = '$username'";

            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            if (!password_verify($old_password, $db_password)) {
                ?>
                <div class="alert alert-danger text-center" style="width: 541px; margin-left: 28.9%; background-color: #de1313; color: white;">
                    <strong>Old password is incorrect</strong>
                </div>
                <?php
            } elseif ($old_password === $new_password) {
                ?>
                <div class="alert alert-danger text-center" style="width: 541px; margin-left: 28.9%; background-color: #de1313; color: white;">
                    <strong>Old password and new password are the same</strong>
                </div>
                <?php
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE staff SET password = '$hashed_password' WHERE username = '$username'";
                mysqli_query($conn, $query);
                ?>
                <div class="alert alert-success text-center" style="width: 541px; margin-left: 28.9%;">
                    <strong>Password has been changed successfully</strong>
                </div>
                <?php
            }
            break;
        case 'teacher':
            $username = $_SESSION['username'];
            $query = "SELECT password FROM teachers WHERE username = '$username'";

            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            if (!password_verify($old_password, $db_password)) {
                ?>
                <div class="alert alert-danger text-center" style="width: 541px; margin-left: 28.9%; background-color: #de1313; color: white;">
                    <strong>Old password is incorrect</strong>
                </div>
                <?php
            } elseif ($old_password === $new_password) {
                ?>
                <div class="alert alert-danger text-center" style="width: 541px; margin-left: 28.9%; background-color: #de1313; color: white;">
                    <strong>Old password and new password are the same</strong>
                </div>
                <?php
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE teachers SET password = '$hashed_password' WHERE username = '$username'";
                mysqli_query($conn, $query);
                ?>
                <div class="alert alert-success text-center" style="width: 541px; margin-left: 28.9%;">
                    <strong>Password has been changed successfully</strong>
                </div>
                <?php
            }
            break;
    }
}
?>

    
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
