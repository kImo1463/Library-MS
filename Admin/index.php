<?php
session_start();
include "../Header/admin_header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Bootstrap icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

	<div class="container mt-3">
<?php
      echo "<h2>Welcome, " . $_SESSION["username"] . "</h2>";
?>
	</div>

	<div class="container mt-5">
		<div class="row">
			<div class="col-sm-4">
				<div class="card bg-primary text-white" style="width: 22rem;">
					<div class="card-body text-center">
						<i class="fas fa-users fa-4x"></i>
						<?php
                // Database connection
                include "../Connection/connection.php";

// Query to get total number of students
$query = "SELECT COUNT(*) AS total_students FROM student";
$result = mysqli_query($conn, $query);

// Display total number of students
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h1 class="card-text">'.$row["total_students"].'</h1>';
}
?>
						<h5 class="card-text">Total No. of Students</h5>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="card bg-secondary text-white" style="width: 22rem;">
					<div class="card-body text-center">
						<i class="fas fa-users fa-4x"></i>
						<?php
    // Query to get total number of staff
    $query = "SELECT COUNT(*) AS totalStaff FROM staff";
$result = mysqli_query($conn, $query);

// Display total number of staff
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h1 class="card-text">'.$row["totalStaff"].'</h1>';
}
?>
						<h5 class="card-text">Total No. of Staff</h5>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="card bg-success text-white" style="width: 22rem;">
					<div class="card-body text-center">
						<i class="fas fa-users fa-4x"></i>
						<?php
    // Query to get total number of teachers
    $query = "SELECT COUNT(*) AS totalTeachers FROM teachers";
$result = mysqli_query($conn, $query);

// Display total number of teachers
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h1 class="card-text">'.$row["totalTeachers"].'</h1>';
}
?>
						<h5 class="card-text">Total No. of Teachers</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
