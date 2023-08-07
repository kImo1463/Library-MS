<?php
session_start();// start session


$_SESSION['source_page'] = 'teachers-request-information.php';


include "../Connection/connection.php"; // db configuration

include "../Header/staff_header.php" // include header-file
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>issue information page</title>
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

    $sql= "SELECT teachers.`full-name`, teachers.username, teachers.`phone-number`, teachers.`department`, 
       books.ISBN, author, `issue-date`, `return-date`, teachers_issue_book.`book-title`  
       FROM teachers 
       INNER JOIN `teachers_issue_book` ON teachers.`username` = `teachers_issue_book`.`username` 
       INNER JOIN books ON `teachers_issue_book`.ISBN = books.ISBN 
       WHERE `teachers_issue_book`.`issue-status` = 'Approved' ORDER BY `return-date` ASC";

    $res= mysqli_query($conn, $sql);

    if (mysqli_num_rows($res)==0) {
        echo "<div class='alert alert-warning text-center'><h3>There's no approved book request for teachers.</h3></div>";
    } else {
        ?>
<div class="container-fluid">
      <div class="row justify-content-end mt-3">
          <div class="col-md-4">
              <form action="teachers-return-books.php" method="post">
                  <div class="form-group">
                      <input type="text" class="form-control" id="teachers_username" name="teachers_username" required="required" placeholder="Enter teachers's username">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" id="isbn" name="isbn" required="required" placeholder="Enter ISBN">
                  </div>
                  <button type="submit" name="submit" class="btn btn-success">Return</button>
              </form>
          </div>
      </div>
  </div> 
    
    <h3 class="text-center mt-3">List of Books Approved to Teachers </h3>

<div class="table-responsive px-3">
     <table class="table table-striped table-bordered ">
    <thead>
      <tr style='background-color: #444; color: #fff;'>
        <th>Teacher's Name</th>
        <th>Username</th>
        <th>Phone Number</th>
        <th>Department</th>
        <th>Book ISBN</th>
        <th>Book Title</th>
        <th>Author</th>
        <th>Issue Date</th>
        <th>Return Date</th>
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
                  echo "<td>" . $row["issue-date"] . "</td>";
                  echo "<td>" . $row["return-date"] . "</td>";
                  echo "</tr>";
              }
    }
}
?>
    </tbody>
  </table>
</div>

</body>
</html>
