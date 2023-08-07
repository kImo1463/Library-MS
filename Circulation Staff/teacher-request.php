<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/staff_header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>teacher requested books page</title>
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
if (isset($_SESSION['userType'])) {

    $sql = "SELECT teachers.`full-name`, teachers.username, teachers.`phone-number`, teachers.`department`, books.ISBN, author, quantity, teachers_issue_book.`book-title`
       FROM teachers 
       INNER JOIN `teachers_issue_book` ON teachers.`username` = `teachers_issue_book`.`username` 
       INNER JOIN books ON `teachers_issue_book`.ISBN = books.ISBN 
       WHERE `teachers_issue_book`.`issue-status` = ''";

    $res= mysqli_query($conn, $sql);

    if (mysqli_num_rows($res)==0) {
        echo "<div class='alert alert-warning text-center'><h3>There are no teacher requested books.</h3></div>";
    } else {
        ?>
    <div class="container-fluid">
        <div class="row justify-content-end mt-3">
            <div class="col-md-4">
                <form action="teacher-request.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="input1" name="name" required="required" placeholder="Enter teacher's username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="input2" name="isbn" required="required" placeholder="Enter requested book's ISBN">
                    </div>
                    <button type="submit" name="submit2" class="btn btn-success">Approve</button>
                </form>
            </div>
        </div>
    </div>
  <h3 class="text-center">Teachers's Book Request List </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
				<thead>
					<tr style='background-color: #444; color: #fff;'>
        <th>Requester's Name</th>
        <th>Username</th>
        <th>Phone Number</th>
        <th>Department</th>
        <th>Book ISBN</th>
        <th>Book Title</th>
        <th>Author</th>
        <th>Quantity</th>
      </tr>
    </thead>
    <tbody>
    <?php
              while ($row=mysqli_fetch_assoc($res)) {
                  echo "<tr>";
                  echo "<td>" . $row["full-name"] . "</td>";
                  echo "<td>" . $row["username"] . "</td>";
                  echo "<td>" . $row["phone-number"] . "</td>";
                  echo "<td>" . $row["department"] . "</td>";
                  echo "<td>" . $row["ISBN"] . "</td>";
                  echo "<td>" . $row["book-title"] . "</td>";
                  echo "<td>" . $row["author"] . "</td>";
                  echo "<td>" . $row["quantity"] . "</td>";
                  echo "</tr>";
              }
    }
}
?>
    </tbody>
  </table>
</div>


<?php
    if(isset($_POST['submit2'])) {
        $_SESSION['teacherName']=$_POST['name'];
        $_SESSION['isbn']=$_POST['isbn'];
        ?>
			<script type="text/javascript">
				window.location="approve-teachers-request.php"
			</script>
<?php
    }
?>
</body>
</html>


