<?php
// start the session
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/admin_header.php"
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

    <title>Staff list page</title>
</head>
<body>
  <div class="container-fluid">
  <div class="row mt-3">
    <div class="col-md-4 ml-auto">
      <form action="staff-search.php" method="post">					
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="Search by full-name or username" style="width: 300px;">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<br>
		
  <h3 class="text-center">List of registered circulation staff</h3>


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
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?php

                // Query the books table for computer science department books
                $sql = "SELECT * FROM staff";

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
    echo '<td class="edit">
                      <a href="edit-staff.php?username=' . $row['username'] . '" class="btn btn-success">Edit</a>
                      </td>';
    echo '<td class="delete">
			          <a href="#" class="btn btn-danger delete-staff" data-name=' . $row['username'] . '>Delete</a>
			         </td>';

    echo "</tr>";
}


?>
			</tbody>
		</table>
	</div>
	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>	
    <script>
        //delete book script
         $(".delete-staff").on("click", function(){
         var username = $(this).data("name"); // name of the var must be username just like the column in the staff table other wise it wont work when delete_book is executed
         console.log(username);
          $.ajax({
           url : "delete-staff.php",
           type : "POST",
           data : {username: username},
         success: function(data){
          alert("Staff member deleted successfully.");
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

  </body>
</html>
