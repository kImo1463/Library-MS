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
    $sex = $_POST['sex'];


    $get_staff_query = "SELECT * FROM staff WHERE username='$username'";
    $staff_result = mysqli_query($conn, $get_staff_query);

    if (mysqli_num_rows($staff_result) == 1) {
        $row = mysqli_fetch_assoc($staff_result);
        $orig_fullName = $row['full-name'];
        $orig_username = $row['username'];
        $orig_password = $row['password'];
        $orig_email = $row['email'];
        $orig_phone = $row['phone-number'];
        $orig_sex = $row['sex'];


        // Check if any data has been changed
        if ($fullName != $orig_fullName || $username != $orig_username || $email != $orig_email || $phone != $orig_phone || (!empty($newPassword) && $newPassword != $orig_password && !password_verify($newPassword, $orig_password)) || $sex != $orig_sex) {
            // Update password only if it has been changed and it is different from the original one
            if (!empty($newPassword) && $newPassword != $orig_password) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $update_staff_query = "UPDATE staff SET `password`='$hashedPassword', `full-name`='$fullName', email='$email', `phone-number`='$phone', sex='$sex' WHERE username='$username'";
            } else {
                $update_staff_query = "UPDATE staff SET `full-name`='$fullName', email='$email', `phone-number`='$phone', sex='$sex' WHERE username='$username'";
            }
            $result = mysqli_query($conn, $update_staff_query);
            if ($result) {
                ?>
                <script type="text/javascript">
                    alert("Staff Information Updated Successfully.");
                    window.location = "edit-staff.php?username=<?php echo urlencode($username); ?>";
                </script>
                <?php
                exit();
            } else {
                echo "Error updating staff: " . mysqli_error($conn);
            }
        } else {
            ?>
            <script type="text/javascript">
                var username = <?php echo json_encode($username); ?>;
                alert("No Data Has Been Changed.");
                window.location = "edit-staff.php?username=" + username;
            </script>
            <?php
            exit();
        }
    } else {
        echo "Error fetching staff data";
        exit();
    }
} else {
    $username = $_GET['username'];

    $get_staff_query = "SELECT * FROM staff WHERE username='$username'";
    $staff_result = mysqli_query($conn, $get_staff_query);

    if (mysqli_num_rows($staff_result) == 1) {
        $row = mysqli_fetch_assoc($staff_result);
    } else {
        echo "Error fetching staff data";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update staff</title>
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
        <h3 class="text-center">Update Staff</h3>
    </div>

    <div class="container" style="height: 500px;">
        <div class="col-md-6">
            <div class="form-container">
                <form method="POST" action="edit-staff.php">
                    <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullName" class="form-label">Full Name:</label>
                                <input type="text" class="form-control" id="fullName" name="full-name" value="<?php echo $row['full-name']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" required>
                            </div>

                              <div class="form-group">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                            </div>
                            <div id="email-error"></div>
                        </div>
                        <div class="col-md-6">
                          

                            <div class="form-group">
                                <label for="phone-number" class="form-label">Phone Number:</label>
                                <input type="text" class="form-control" id="phone-number" name="phone-number" value="<?php echo $row['phone-number']; ?>" required>
                            </div>

                            <div id="phone-error"></div>
                        <div class="form-group">
                <label for="category" class="form-label">Sex:</label>
                <select class="form-control" id="sex" name="sex" required>
                   <option value="Male" <?php if ($row['sex'] == 'Male') ; ?>><?php echo $row['sex']; ?></option>
                   <option value="Female" <?php if ($row['sex'] == 'Female') ; ?>><?php echo $row['sex']; ?></option>
                   
                </select>
            </div>
                            
                        </div>
                    </div>
                    <button type="submit" name="update" class="btn btn-success" onclick="return validate(this.form);">Update Staff</button>
                    <a href="staff-list.php" class="btn btn-danger ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
