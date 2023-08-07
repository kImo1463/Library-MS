<?php
session_start();
include "../Connection/connection.php"; // conn configuration
include "../Header/staff_header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Approve Teacher's Book Request</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <h3 class="text-center mb-4">Approve Teacher's Book Request</h3>
        <form action="approve-teachers-request.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="approve" placeholder="Approved or Rejected" required="required">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="issue" placeholder="Issue Date yyyy-mm-dd" required="required">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="return" placeholder="Return Date yyyy-mm-dd" required="required">
          </div>
          <button type="submit" name="submit" class="btn btn-success btn-block">Approve</button>
        </form>
      </div>
    </div>
  </div>

<?php
  if(isset($_POST['submit'])) {
      mysqli_query($conn, "UPDATE `teachers_issue_book` SET `issue-status` = '$_POST[approve]',`issue-date` = '$_POST[issue]',`return-date` = '$_POST[return]' WHERE 
    `username`='$_SESSION[teacherName]' and ISBN='$_SESSION[isbn]';");

      mysqli_query($conn, "UPDATE books SET quantity = quantity-1 where ISBN='$_SESSION[isbn]' ;");


      ?>
      <script type="text/javascript">
        alert("Approved successfully.");
        window.location="teacher-request.php"
      </script>
    <?php
  }
?>
  
</body>
</html>
