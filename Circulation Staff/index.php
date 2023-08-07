<?php
session_start();
// db configuration
include "../Connection/connection.php";
include "../Header/staff_header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Staff's home page</title>
	<!-- Bootstrap icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="container" style="height: 800px; ">
<div class="container mt-3">
    <?php
      echo "<h2>Welcome," . $_SESSION["full-name"] . "</h2>";
?>
</div>

<div class="container mt-4 ">
  <div class="row">
    <div class="col-sm-4">
      <div class="card bg-primary text-white" style="width: 22rem;">
        <div class="card-body text-center">
        <i class="bi bi-book fa-4x"></i>
          <?php
       // query to get total number of books
       $query = "SELECT COUNT(*) AS total_books FROM books";
$result = mysqli_query($conn, $query);

// display total number of books
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">'.$row["total_books"].'</h2>';
}
?>
        <h5 class="card-text">Total No. of Books</h5>               
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card bg-secondary text-white" style="width: 22rem;">
        <div class="card-body text-center">
           <i class="bi bi-journal-bookmark-fill fa-4x"></i>          
           <?php
  // query to get total number of teachers
  $query = "SELECT COUNT(*) AS ebooks FROM `e-books`";
$result = mysqli_query($conn, $query);

// display total number of teachers
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">'.$row["ebooks"].'</h2>';
}
?>  
            <h5 class="card-text">Total No. of E-Books</h5>                       
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card bg-success text-white" style="width: 22rem;">

        <div class="card-body text-center">
        <i class="bi bi-file-earmark-arrow-up fa-4x"></i>    
          <?php
  // query to get total number of borrowed books
  $query = "SELECT COUNT(*) AS requestedBooks FROM students_issue_book WHERE `issue-status` = ''";
$result = mysqli_query($conn, $query);

// display total number of borrowed books
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">'.$row["requestedBooks"].'</h2>';
}
?>
          <h5 class="card-text">Total student Requested Books</h5>                                 
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-sm-4">
        <div class="card bg-success text-white" style="width: 22rem;">

        <div class="card-body text-center">
          <i class="bi bi-file-earmark-arrow-up fa-4x"></i>         
          <?php
  // query to get total number of borrowed books
  $query = "SELECT COUNT(*) AS app FROM teachers_issue_book WHERE `issue-status` = ''";
$result = mysqli_query($conn, $query);

// display total number of borrowed books
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">'.$row["app"].'</h2>';
}
?> 
          <h5 class="card-text">Total teacher Requested Books </h5>                               
        </div>
      </div>
    </div>

    
    <div class="col-sm-4">
      <div class="card bg-secondary text-white" style="width: 22rem;">
        <div class="card-body text-center">
          <i class="bi bi-check-circle-fill fa-4x"></i>         
          <?php
  // query to get total number of borrowed books

$query = "SELECT COUNT(*) AS app FROM students_issue_book WHERE `issue-status` = 'Approved'";
$result = mysqli_query($conn, $query);

// display total number of borrowed books
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">'.$row["app"].'</h2>';
}

?> 
                    <h5 class="card-text">Total books Approved to students </h5>                                        
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card bg-primary text-white" style="width: 22rem;">        
      <div class="card-body text-center">
          <i class="bi bi-check-circle-fill fa-4x"></i>         
          <?php
  // query to get total number of borrowed books
  $query = "SELECT COUNT(*) AS app FROM teachers_issue_book WHERE `issue-status` = 'Approved'";
$result = mysqli_query($conn, $query);

// display total number of borrowed books
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">'.$row["app"].'</h2>';
}
?> 
          <h5 class="card-text">Total books Approved to teachers </h5>                               
        </div>
      </div>
    </div>

  </div>

  <div class="row mt-5">

      <div class="col-sm-4">
      <div class="card bg-danger text-white" style="width: 22rem;">
        <div class="card-body text-center">
          <i class="bi bi-file-earmark-excel-fill fa-4x"></i>         
          <?php
  // query to get total number of borrowed books
  $query = "SELECT COUNT(*) AS exp FROM students_issue_book WHERE `issue-status` = 'Expired'";
$result = mysqli_query($conn, $query);

// display total number of borrowed books
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">'.$row["exp"].'</h2>';
}
?> 
          <h5 class="card-text">Total student Expired Books </h5>                               
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card bg-danger text-white" style="width: 22rem;">
        <div class="card-body text-center">
          <i class="bi bi-file-earmark-excel-fill fa-4x"></i>         
          <?php
  // query to get total number of borrowed books
  $query = "SELECT COUNT(*) AS exp FROM teachers_issue_book WHERE `issue-status` = 'Expired'";
$result = mysqli_query($conn, $query);

// display total number of borrowed books
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">'.$row["exp"].'</h2>';
}

?> 
                    <h5 class="card-text">Total teacher's Expired Books </h5>                                        
        </div>
      </div>
    </div>
  </div>
 </div>
</div>

</body>
</html>
<?php include "../Header/footer.php" ?> <!--- footer -->
