<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
	<style>
	body {
		background-color: #EFEFEF;
         }

    #identificationNumberDiv {
         display: none;
      }
	</style>

         <!-- Function to handle the change event of the user_type select element.
         It toggles the display of the userNameDiv and identificationNumberDiv based on the selected user type.-->

    <script>
		function changeForm() {
			var user__type = document.getElementById("user_type").value;
			if (user__type == "student") {
				document.getElementById("userNameDiv").style.display = "none";
				document.getElementById("identificationNumberDiv").style.display = "block";
			} else {
				document.getElementById("userNameDiv").style.display = "block";
				document.getElementById("identificationNumberDiv").style.display = "none";
			}
		}
	</script>
	
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
<div class="container" style="max-width: 1500px;">
		<div class="col-sm-12 text-center my-5">
			<h1><i class="fas fa-book" style="color: green; font-size: 4rem;"></i> Library Management System</h1>
		</div>
		
		<div class="row">
			<div class="col-sm-4 offset-sm-4">
				<div class="card" style="border: 2px solid lightgray; border-radius: 10px;">
					<div class="card-header">
						<h4 class="mb-0"" style='text-align: center;'>Enter Login Details</h4>
					</div>
					<div class="card-body">
						<form action="login.php" method="post">
							<div class="form-group">
								<label for="user_type"><i class="fas fa-user-friends" style='color: lightblue;'></i> <b>User-type:</b></label>
								<select class="form-control" id="user_type" name="userType" onchange="changeForm()">
									<option value="admin" >Admin</option>
									<option value="teacher">Teacher</option>
									<option value="student">Student</option>
									<option value="staff">Circulation Staff</option>
								</select>
							</div>
							<div class="form-group" id="userNameDiv">
								<label for="userName"><i class="fas fa-user" style='color: lightblue;'></i> <b>User-name:</b></label>
								<input type="text" class="form-control" id="userName" name="username" placeholder="Enter user-name" autocomplete="off">
							</div>
							<div class="form-group" id="identificationNumberDiv">
								<label for="identificationNumber"><i class="fas fa-user" style='color: lightblue;'></i> <b>Identification-number:</b></label>
								<input type="text" class="form-control" id="identificationNumber" name="idNumber" placeholder="Enter identification number" >
							</div>
							<div class="form-group">
								<label for="passWord"><i class="fas fa-key" style='color: lightblue;'></i> <b>Password:</b></label>
								<input type="passWord" class="form-control" id="passWord" name="password" required="required" placeholder="Enter password">
							</div>
							<button type="submit" name="login" class="btn btn-success btn-block">Login</button>
						</form>
					</div>
			  </div>
		 </div>
	</div>

	

<?php
/// session start
session_start();

if (isset($_POST['login'])) {
    include "../Connection/connection.php"; // db connection

    $userType = mysqli_real_escape_string($conn, $_POST['userType']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $id = mysqli_real_escape_string($conn, $_POST['idNumber']);

    $sql = "";
    $result = null;

    if ($userType == 'admin') {
        $sql = "SELECT * FROM `admin` WHERE username = '{$username}'";
    } elseif ($userType == 'student') {
        $sql = "SELECT * FROM `student` WHERE idNumber = '{$id}'";
    } elseif ($userType == 'teacher') {
        $sql = "SELECT * FROM `teachers` WHERE username = '{$username}'";
    } elseif ($userType == 'staff') {
        $sql = "SELECT * FROM `staff` WHERE username = '{$username}'";
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $hashedPassword = $row['password'];

            // Verify the entered password against the hashed password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, perform login actions
                if ($userType == 'admin') {

                    $_SESSION["full-name"] = $row['full-name'];
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["phone-number"] = $row['phone-number'];
                    $_SESSION["userType"] = $userType;
                    $_SESSION["password"] = $password;


                    header("Location: ../Admin/index.php");
                } elseif ($userType == 'student') {

                    $_SESSION["full-name"] = $row['full-name'];
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["idNumber"] = $row['idNumber'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["phone-number"] = $row['phone-number'];
                    $_SESSION["sex"] = $row['sex'];
                    $_SESSION["department"] = $row['department'];
                    $_SESSION["userType"] = $userType;

                    header("Location: ../Student/index.php");
                } elseif ($userType == 'teacher') {

                    $_SESSION["full-name"] = $row['full-name'];
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["phone-number"] = $row['phone-number'];
                    $_SESSION["sex"] = $row['sex'];
                    $_SESSION["userType"] = $userType;

                    header("Location: ../Teacher/index.php");
                } elseif ($userType == 'staff') {

                    $_SESSION["full-name"] = $row['full-name'];
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["phone-number"] = $row['phone-number'];
                    $_SESSION["sex"] = $row['sex'];
                    $_SESSION["userType"] = $userType;

                    header("Location: ../Circulation Staff/index.php");
                }
                exit(); // Stop further execution
            }
        }
    }

    // Password is incorrect
    ?>
    <div class="alert alert-danger text-center" style="width: 395px; margin: 0 auto; background-color: #de1313; color: white; border: none">
        <strong>Username and Password don't match</strong>
    </div>
    <?php
}


?>


<!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>






