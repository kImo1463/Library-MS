<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/student_header.php"
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


$q = mysqli_query($conn, "SELECT * FROM `students_issue_book` WHERE `idNumber` = '{$_SESSION['idNumber']}' AND `issue-status` = 'Approved'");

if (mysqli_num_rows($q)==0) {
    echo "<div class='alert alert-warning text-center'><h3>There aren't any approved books.</h3></div>";
} else {
    ?>


<div class="container-fluid mt-3">
  <h3 class="text-center">Approved List of Books</h3></br>
</div> 

    <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
                    <th>Requested Book Title</th>
					          <th>Requested Book ISBN</th>
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

                    echo "<td style='border-radius: 5px;'>";
                    echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 5px;'>";
                    echo $row["issue-status"];
                    echo "</span>";
                    echo "</td>";

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
