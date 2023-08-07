<?php
// start the session
session_start();
include "../Connection/connection.php"; // db configuration
?>
<!DOCTYPE html>
<html>
<head>
    <style>
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
    <title>Staff search page</title>
</head>
<body>

<?php
if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') {
    // if the user type is teachers, include the teachers header file
    include "../Header/admin_header.php";
    if (isset($_POST['submit'])) {

        $category = isset($_GET['category']) ? $_GET['category'] : 'default_category';
        $q=mysqli_query($conn, "SELECT * FROM teachers WHERE department='$category' AND (`full-name` LIKE '%$_POST[search]%' OR username LIKE '%$_POST[search]%')");

        if (mysqli_num_rows($q)==0) {
            echo "<div class='alert alert-warning text-center'><h3>Sorry! No teachers found. Try searching again.</h3></div>";
        } else {
            ?>


<div class="container-fluid mt-3">
    <h3 class="text-center">Search Result</h3><br>
    <table class="table table-striped table-bordered">
                <thead>
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


            // Loop through the results and display them in the table
            while ($row = mysqli_fetch_assoc($q)) {
                echo "<tr>";
                echo "<td>" . $row["full-name"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td class='password-cell'>" . $row["password"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone-number"] . "</td>";
                echo "<td>" . $row["sex"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo '<td class="edit">
                      <a href="edit-teachers.php?username=' . $row['username'] . '" class="btn btn-success">Edit</a>
                      </td>';
                echo '<td class="delete">
                      <a href="#" class="btn btn-danger delete-teachers" data-id=' . $row['username'] . '>Delete</a>
                      </td>';

                echo "</tr>";
            }
                        echo "</table>";
        }
    }

    ?>
    
			</tbody>
		</table>
	
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
          alert("Teacher deleted successfully.");
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
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // if the user type is not admin, include the regular header file
    include "../Header/staff_header.php";
    if (isset($_POST['submit'])) {

        $category = isset($_GET['category']) ? $_GET['category'] : 'default_category';
        $q=mysqli_query($conn, "SELECT * FROM teachers WHERE department='$category' AND (`full-name` LIKE '%$_POST[search]%' OR username LIKE '%$_POST[search]%')");

        if (mysqli_num_rows($q)==0) {
            echo "<div class='alert alert-warning text-center'><h3>Sorry! No teachers found. Try searching again.</h3></div>";
        } else {
            ?>


<div class="container-fluid mt-3">
    <h3 class="text-center">Search Result</h3><br>
    <table class="table table-striped table-bordered">
                <thead>
                    <tr style='background-color: #444; color: #fff;'>
					<th>Full name</th>
					<th>Id number</th>
					<th>Password</th>
                    <th>Email</th>
                    <th>Phone number</th>
					<th>Sex</th>
					<th>Department</th>
				</tr>
			</thead>
			<tbody>
	<?php


            // Loop through the results and display them in the table
            while ($row = mysqli_fetch_assoc($q)) {
                echo "<tr>";
                echo "<td>" . $row["full-name"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone-number"] . "</td>";
                echo "<td>" . $row["sex"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";

                echo "</tr>";
            }
                        echo "</table>";
        }
    }
}

?>
    
			</tbody>
		</table>
	</div>













