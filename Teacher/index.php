<?php
// Start session
session_start();

// Database configuration
include "../Connection/connection.php";

// Header file
include "../Header/teacher_header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
	
  <!-- Bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- Font-awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
  <div class="container" style="height: 600px;">
    <div class="container mt-3">
      <?php
      echo "<h2>Welcome, " . $_SESSION["full-name"] . "</h2>";
?>
    </div>

    <div class="container mt-4">
      <div class="row">
        <div class="col-sm-4">
          <div class="card bg-primary text-white" style="width: 22rem;">
            <div class="card-body text-center">
              <i class="bi bi-book fa-4x"></i>
              <?php
        // Query to get total number of books
        $query = "SELECT COUNT(*) AS total_books FROM books";
$result = mysqli_query($conn, $query);

// Display total number of books
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">' . $row["total_books"] . '</h2>';
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
// Query to get total number of e-books
$query = "SELECT COUNT(*) AS ebooks FROM `e-books`";
$result = mysqli_query($conn, $query);

// Display total number of e-books
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">' . $row["ebooks"] . '</h2>';
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
// Query to get total number of requested books
$query = "SELECT COUNT(*) AS requestedBooks FROM teachers_issue_book WHERE `username` = '{$_SESSION['username']}' AND `issue-status` = ''";
$result = mysqli_query($conn, $query);

// Display total number of requested books
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">' . $row["requestedBooks"] . '</h2>';
}
?>
              <h5 class="card-text">Total No. of Requested Books</h5>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-sm-4">
          <div class="card bg-success text-white" style="width: 22rem;">
            <div class="card-body text-center">
              <i class="bi bi-check-circle-fill fa-4x"></i>
              <?php
// Query to get total number of approved books
$query = "SELECT COUNT(*) AS approvedBooks FROM teachers_issue_book WHERE `username` = '{$_SESSION['username']}' AND `issue-status` = 'Approved'";
$result = mysqli_query($conn, $query);

// Display total number of approved books
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">' . $row["approvedBooks"] . '</h2>';
}
?>
              <h5 class="card-text">Total No. of Approved Books</h5>
            </div>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="card bg-secondary text-white" style="width: 22rem;">
            <div class="card-body text-center">
              <i class="bi bi-file-earmark-excel-fill fa-4x"></i>
              <?php
// Update the `issue-status` column to 'Expired' for rows where the `return-date` is not an empty string AND current date is greater than the return-date
$update_sql = "UPDATE `teachers_issue_book` SET `issue-status` = 'Expired' WHERE `return-date` != '' AND CURRENT_DATE() > `return-date`";
mysqli_query($conn, $update_sql);

// Query to get total number of expired books
$query = "SELECT COUNT(*) AS expired FROM teachers_issue_book WHERE `username` = '{$_SESSION['username']}' AND `issue-status` = 'Expired'";
$result = mysqli_query($conn, $query);

// Display total number of expired books
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">' . $row["expired"] . '</h2>';
}
?>
              <h5 class="card-text">Total No. of Expired Books</h5>
            </div>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="card bg-primary text-white" style="width: 22rem;">
            <div class="card-body text-center">
              <i class="bi bi-file-earmark-excel-fill fa-4x"></i>
              <?php
// Query to get total number of returned books
$query = "SELECT COUNT(*) AS returned FROM teachers_issue_book WHERE `username` = '{$_SESSION['username']}' AND `issue-status` = 'Returned'";
$result = mysqli_query($conn, $query);

// Display total number of returned books
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<h2 class="card-text">' . $row["returned"] . '</h2>';
}
?>
              <h5 class="card-text">Total No. of Returned Books</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

<?php include "../Header/footer.php" ?> <!-- Footer -->
