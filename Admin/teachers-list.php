<?php
// start the session
session_start();
// db configuration
include "../Connection/connection.php";

if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') {
    // if the user type is admin, include the admin header file
    include "../Header/admin_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // if the user type is staff, include the staff header file
    include "../Header/staff_header.php";
}

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .col-3 {
            float: right;
        }

        button[name="submit"] {
            width: 80px;
        }

        table {
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid black;
            padding: 8px;
            border-radius: 5px;
        }

        .password-cell {
            max-width: 15px; /* Adjust the width as per your preference */
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <title>Teachers list page</title>
</head>
<body>

  <?php

// check if the user is logged in and their user type
if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // Retrieve the category query parameter
    $category = $_GET['category'];

    // Query the database to retrieve the teachers table based on the category
    if ($category == 'Computer Science') {

        ?>


<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Computer Science Department teachers </h3>

<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					
				</tr>
			</thead>
			<tbody>
	<?php

                        // Query the books table for computer science department books
                        $sql = "SELECT * FROM teachers WHERE department='Computer Science'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Information System') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Information System Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Information System'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Information Technology') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Information Technology Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Information Technology'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Electrical Engineering') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Electrical Engineering Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Electrical Engineering'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";


            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Mechanical Engineering') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Mechanical Engineering Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Mechanical Engineering'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";


            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Bio-medical Engineering') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Bio-medical Engineering Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Bio-medical Engineering'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    }
}














// if the user type is staff
elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') {

    // Retrieve the category query parameter
    $category = $_GET['category'];

    // Query the database to retrieve the books table based on the category
    if ($category == 'Computer Science') {

        ?>


<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Computer Science Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
					<th>Password</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?php

                        // Query the books table for computer science department books
                        $sql = "SELECT * FROM teachers WHERE department='Computer Science'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td class='password-cell'>" . $row["password"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo '<td class="edit">
                      <a href="edit-teacher.php?username=' . $row['username'] . '" class="btn btn-success">Edit</a>
                      </td>';
            echo '<td class="delete">
			<a href="#" class="btn btn-danger delete-teachers" data-id=' . $row['username'] . '>Delete</a>
			</td>';

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Information System') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Information System Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
					<th>Password</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Information System'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td class='password-cell'>" . $row["password"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo '<td class="edit">
                      <a href="edit-teacher.php?username=' . $row['username'] . '" class="btn btn-success">Edit</a>
                      </td>';
            echo '<td class="delete">
			<a href="#" class="btn btn-danger delete-teachers" data-id=' . $row['username'] . '>Delete</a>
			</td>';

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Information Technology') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Information Technology Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
					<th>Password</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Information Technology'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td class='password-cell'>" . $row["password"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo '<td class="edit">
                      <a href="edit-teacher.php?username=' . $row['username'] . '" class="btn btn-success">Edit</a>
                      </td>';
            echo '<td class="delete">
			<a href="#" class="btn btn-danger delete-teachers" data-id=' . $row['username'] . '>Delete</a>
			</td>';

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Electrical Engineering') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Electrical Engineering Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
					<th>Password</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Electrical Engineering'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td class='password-cell'>" . $row["password"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo '<td class="edit">
                      <a href="edit-teacher.php?username=' . $row['username'] . '" class="btn btn-success">Edit</a>
                      </td>';
            echo '<td class="delete">
			<a href="#" class="btn btn-danger delete-teachers" data-id=' . $row['username'] . '>Delete</a>
			</td>';

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Mechanical Engineering') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Mechanical Engineering Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
					<th>Password</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Mechanical Engineering'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td class='password-cell'>" . $row["password"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo '<td class="edit">
                      <a href="edit-teacher.php?username=' . $row['username'] . '" class="btn btn-success">Edit</a>
                      </td>';
            echo '<td class="delete">
			<a href="#" class="btn btn-danger delete-teachers" data-id=' . $row['username'] . '>Delete</a>
			</td>';

            echo "</tr>";
        }


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Bio-medical Engineering') {
        ?>
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="teachers-search.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username ">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">List of Bio-medical Engineering Department teachers </h3>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
				<tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Username</th>
					<th>Password</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?php

                    // Query the books table for computer science department books
                    $sql = "SELECT * FROM teachers WHERE department='Bio-medical Engineering'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["full-name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td class='password-cell'>" . $row["password"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone-number"] . "</td>";
            echo "<td>" . $row["sex"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo '<td class="edit">
                      <a href="edit-teacher.php?username=' . $row['username'] . '" class="btn btn-success">Edit</a>
                      </td>';
            echo '<td class="delete">
			<a href="#" class="btn btn-danger delete-teachers" data-id=' . $row['username'] . '>Delete</a>
			</td>';

            echo "</tr>";
        }


        ?>
		
			</tbody>
		</table>
	</div>
<?php
    }
    ?>
		<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>	
    <script>
        //delete book script
         $(".delete-teachers").on("click", function(){
         var username = $(this).data("id"); // name of the var must be username just like the column in the teachers table other wise it wont work when delete_book is executed
         console.log(username);
          $.ajax({
           url : "delete_teacher.php",
           type : "POST",
           data : {username: username},
         success: function(data){
          alert("Teacher's record deleted successfully.");
           $(".message").html(data);
           setTimeout(function(){ 
           window.location.reload(); }, 500);
           },
			error: function(xhr, status, error) {
			console.log("Error: " + error);
			}
  });
});
</script>
		<?php

}

?>		  
  </body>
</html>
