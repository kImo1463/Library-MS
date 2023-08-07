<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/teacher_header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>issue</title>
 <style>
table {
  border-collapse: collapse;
}
td, th {
  border: 1px solid black;
  padding: 8px;
  border-radius: 5px;
}

    </style>
</head>
<body>

<?php

       $q = mysqli_query($conn, "SELECT * FROM `teachers_issue_book` WHERE `username` = '{$_SESSION['username']}' AND `issue-status` = ''");

if (mysqli_num_rows($q)==0) {
    echo "<div class='alert alert-warning text-center'><h3>You haven't requested for any books.</h3></div>";
} else {
    ?>


<div class="container-fluid mt-3">
  <h3 class="text-center">Request List</h3></br>
</div> 

    <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
				<tr style='background-color: #444; color: #fff;'>
                <th>Book Title</th>
				<th>Book ISBN</th>
				<th>Approve Status</th>
                <th>Issue Date</th>
                <th>Return Date</th>
				</tr>
			</thead>
			<tbody> 
	<?php

                while ($row=mysqli_fetch_assoc($q)) {
                    echo "<tr>";
                    echo "<td>" . $row["book-title"] . "</td>";
                    echo "<td>" . $row["ISBN"] . "</td>";
                    echo "<td>" . $row["issue-status"] . "</td>";
                    echo "<td>" . $row["issue-date"] . "</td>";
                    echo "<td>" . $row["return-date"] . "</td>";

                    echo "</tr>";
                }
}
?>
	</tbody>
  </table>
</div>


</body>
</html>
