<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/staff_header.php"
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

    $sql= "SELECT student.`full-name`, student.idNumber, student.`phone-number`, student.`department`, 
       books.ISBN, author, `issue-date`, `return-date`, students_issue_book.`book-title`  
       FROM student 
       INNER JOIN `students_issue_book` ON student.`idNumber` = `students_issue_book`.`idNumber` 
       INNER JOIN books ON `students_issue_book`.ISBN = books.ISBN 
       WHERE `students_issue_book`.`issue-status` = 'Approved' ORDER BY `return-date` ASC";

    $res= mysqli_query($conn, $sql);

    if (mysqli_num_rows($res)==0) {
        echo "<div class='alert alert-warning text-center'><h3>There's no approved book request to students.</h3></div>";
    } else {
        ?>
<div class="container-fluid">
      <div class="row justify-content-end mt-3">
          <div class="col-md-4">
              <form action="student-return-book.php" method="post">
                  <div class="form-group">
                      <input type="text" class="form-control" id="student-id" name="student-id" required="required" placeholder="Enter student's id number">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" id="isbn" name="isbn" required="required" placeholder="Enter book's ISBN">
                  </div>
                  <button type="submit" name="submit" class="btn btn-success">Return</button>
              </form>
          </div>
      </div>
  </div> 
    
    <h3 class="text-center mt-3">List of Books Approved to students </h3><br>

<div class="table-responsive px-3">
     <table class="table table-striped table-bordered ">
    <thead>
      <tr style='background-color: #444; color: #fff;'>
        <th>Student Name</th>
        <th>Id Number</th>
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
                  echo "<td>" . $row["idNumber"] . "</td>";
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
