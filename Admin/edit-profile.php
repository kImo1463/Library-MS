<?php
session_start();
include('../Header/admin_header.php');
include "../Connection/connection.php";

// Check if the admin is logged in
if (!isset($_SESSION["username"]) || $_SESSION["userType"] !== "admin") {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Handle form submission
if (isset($_POST['submit'])) {
    // Retrieve the updated information from the form
    $fullName = $_POST["full-name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone-number"];
    $password = $_POST["password"];

    // Prepare and execute the update query
    $query = "UPDATE admin SET `full-name`=?, email=?, `phone-number`=?, password=? WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $fullName, $email, $phoneNumber, $password, $_SESSION["username"]);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        // Update the session variables with the new information
        $_SESSION["full-name"] = $fullName;
        $_SESSION["email"] = $email;
        $_SESSION["phone-number"] = $phoneNumber;
        $_SESSION["password"] = $password;


        // Redirect back to the profile page
        ?>
        <script type="text/javascript">
            alert("Profile edited successfully.");
            window.location = "admins-profile.php"
        </script>
        <?php
        exit();
    } else {
        // Display an error message or handle the error as needed
        $error = "Failed to update the admin's information.";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
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
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="full-name" style="font-weight: bold; font-size: 1.2rem;">Full Name:</label>
                        <input type="text" name="full-name" class="form-control" value="<?php echo $_SESSION['full-name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email" style="font-weight: bold; font-size: 1.2rem;">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>">
                    </div>

                   <div id="email-error"></div>

                    <div class="form-group">
                        <label for="phone-number" style="font-weight: bold; font-size: 1.2rem;">Phone Number:</label>
                        <input type="text" name="phone-number" class="form-control" value="<?php echo $_SESSION['phone-number']; ?>">
                    </div>

                    <div id="phone-error"></div>

                    <div class="form-group">
                        <label for="password" style="font-weight: bold; font-size: 1.2rem;">Password:</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $_SESSION['password']; ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary" onclick="return validate(this.form);">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php include "../Header/footer.php" ?> <!--- footer -->
