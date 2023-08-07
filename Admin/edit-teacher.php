<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/admin_header.php";

if (isset($_POST['update'])) {

    $fullName = $_POST['full-name'];
    $username = $_POST['username'];
    $newPassword = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone-number'];
    $department = $_POST['department'];
    $sex = $_POST['sex'];

    $get_teachers_query = "SELECT * FROM teachers WHERE username='$username'";
    $teachers_result = mysqli_query($conn, $get_teachers_query);

    if (mysqli_num_rows($teachers_result) == 1) {
        $row = mysqli_fetch_assoc($teachers_result);
        $orig_fullName = $row['full-name'];
        $orig_username = $row['username'];
        $orig_password = $row['password'];
        $orig_email = $row['email'];
        $orig_phone = $row['phone-number'];
        $orig_department = $row['department'];
        $orig_sex = $row['sex'];

        // Check if any data has been changed
        if ($fullName != $orig_fullName || $username != $orig_username || $email != $orig_email || $phone != $orig_phone || $department != $orig_department
            || (!empty($newPassword) && $newPassword != $orig_password && !password_verify($newPassword, $orig_password)) || $sex != $orig_sex) {
            // Update password only if it has been changed and it is different from the original one
            if (!empty($newPassword) && $newPassword != $orig_password) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $update_teachers_query = "UPDATE teachers SET `password`='$hashedPassword', `full-name`='$fullName', email='$email', `phone-number`='$phone', sex='$sex', department='$department' WHERE username='$username'";
            } else {
                $update_teachers_query = "UPDATE teachers SET `full-name`='$fullName', email='$email', `phone-number`='$phone', sex='$sex', department='$department' WHERE username='$username'";
            }
            $result = mysqli_query($conn, $update_teachers_query);
            if ($result) {
                ?>
                <script type="text/javascript">
                    alert("Teachers Information Updated Successfully.");
                    window.location = "edit-teacher.php?username=<?php echo urlencode($username); ?>";
                </script>
                <?php
                exit();
            } else {
                echo "Error updating teachers: " . mysqli_error($conn);
            }
        } else {
            ?>
            <script type="text/javascript">
                var username = <?php echo json_encode($username); ?>;
                alert("No Data Has Been Changed.");
                window.location = "edit-teacher.php?username=" + username;
            </script>
            <?php
            exit();
        }
    } else {
        echo "Error fetching teachers data";
        exit();
    }
} else {
    $username = $_GET['username'];

    $get_teachers_query = "SELECT * FROM teachers WHERE username='$username'";
    $teachers_result = mysqli_query($conn, $get_teachers_query);

    if (mysqli_num_rows($teachers_result) == 1) {
        $row = mysqli_fetch_assoc($teachers_result);
    } else {
        echo "Error fetching teachers data";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>Update teachers</title>
 <!-- Custom CSS -->
 <style>
      .form-container {
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 30px;
        margin-top: 25px;
        width: 1100px;
      }
      .form-label {
        font-weight: bold;
      }
</style>

<script>
function validate(form) {
  // Regular expression to check for a valid email address
  const emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  
  // Regular expression to check for a valid phone number
  const phoneRegex = /^(09|\+2519)\d{8}$/;

  // Get the email address and phone number from the form
  const emailInput = form.email;
  const phoneInput = form['phone-number'];

  // Check if the email address is valid
  if (!emailRegex.test(emailInput.value)) {
    document.getElementById("email-error").innerHTML = "<b style=\"color:red\">The Email field is not a valid e-mail address.</b>";
    return false;
  } else {
    document.getElementById("email-error").innerHTML = "";
  }

  // Check if the phone number is valid
  if (!phoneRegex.test(phoneInput.value)) {
    document.getElementById("phone-error").innerHTML = "<b style=\"color:red\">The Phone Number entered is not a valid phone number.</b>";
    return false;
  } else {
    document.getElementById("phone-error").innerHTML = "";
  }

  return true;
}

</script>
</head>
<body>
<div class="container mt-3">
    <h3 class="text-center">Update teachers</h3>
</div>
<div class="container" style="height: 500px;">
        <div class="col-md-6"> 
            <div class="form-container">
            <form method="POST" action="edit-teacher.php">
            <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
            <div class="row">
              <div class="col-md-6">
            <div class="form-group">
                <label for="fullName" class="form-label">Full Name:</label>
                <input type="text" class="form-control" id="fullName" name="full-name" value="<?php echo $row['full-name']; ?>" required>
            </div>
          
            <div class="form-group">
                <label for="password" class="form-label">password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">email:</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            </div>
            <div class="col-md-6">
            
            <div id="email-error"></div>

            <div class="form-group">
                <label for="phone-number" class="form-label">Phone Number:</label>
                <input type="text" class="form-control" id="phone-number" name="phone-number" value="<?php echo $row['phone-number']; ?>" required>
            </div>
            <div id="phone-error"></div>

           <?php
$departments = [
   'Computer Science',
   'Information System',
   'Information Technology',
   'Mechanical Engineering'
   ];

$sexes = [
   'Male',
   'Female'
    ];

?>

<div class="form-group">
  <label for="category" class="form-label">Department:</label>
  <select class="form-control" id="department" name="department" required>
    <?php foreach ($departments as $department) : ?>
      <option value="<?php echo $department; ?>" <?php if ($department == $row['department']) {
          echo 'selected';
      } ?>><?php echo $department; ?></option>
    <?php endforeach; ?>
  </select>
</div>
<div class="form-group">
  <label for="category" class="form-label">Sex:</label>
  <select class="form-control" id="sex" name="sex" required>
    <?php foreach ($sexes as $sex) : ?>
      <option value="<?php echo $sex; ?>" <?php if ($sex == $row['sex']) {
          echo 'selected';
      } ?>><?php echo $sex; ?></option>
    <?php endforeach; ?>
  </select>
</div>
            </div>
            </div>
            
             <button type="submit" name="update" class="btn btn-success" onclick="return validate(this.form);">Update teacher</button>
               <a href="teachers-list-card.php" class="btn btn-danger ml-2">Cancel</a>
</form>
</div>
</div>
</div>

</body>
</html>