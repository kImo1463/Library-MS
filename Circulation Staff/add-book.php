<?php
include "../Header/staff_header.php";
?> 

<!DOCTYPE html>
<html>
  <head>
    <title>Add book page</title>
    
    <!-- Custom CSS -->
    <style>
      .form-container {
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 30px;
        margin-top: 25px;
      }
      .form-label {
        font-weight: bold;
      }
    </style>
    <script type="text/javascript">
  function validateNumber(form) {
    var pageNumber = form.elements["page-number"].value;
    var quantity = form.elements["quantity"].value;

    if (pageNumber < 0) {
      document.getElementById("number-error").innerHTML = "<b style=\"color:red\">You can't input a negative Page number.</b>";
      return false;
    
    if (quantity < 0) {
      document.getElementById("number-error2").innerHTML = "You can't input a negative Quantity.";
      return false;
    }
  }
    return true;
  }
</script>

  </head>
  <body>
    
    <?php // if form submit
if (isset($_POST['submit'])) {
    // Database connection code
    include "../Connection/connection.php";


    $isbn = $_POST['ISBN'];

    // prepare the SQL query to check if the book exists
    $sql = "SELECT COUNT(*) AS count FROM books WHERE ISBN = '$isbn'";

    // execute the query
    $result = mysqli_query($conn, $sql);

    // check if the query was successful
    if (!$result) {
        die('Error executing query: ' . mysqli_error($conn));
    }

    // extract the count from the query result
    $count = mysqli_fetch_assoc($result)['count'];

    // check if the count is greater than 0 (meaning the book already exists)
    if ($count > 0) {
        echo "<div class='alert alert-warning'>Book already exists in database.</div>";
    } else {
        //insert query
        $sql1 ="INSERT INTO books(`book-title`,author,publisher,edition,`page-number`,quantity,ISBN,department) VALUES ('{$_POST['book-title']}','{$_POST['author']}','{$_POST['publisher']}','{$_POST['edition']}','{$_POST['page-number']}','{$_POST['quantity']}', '{$_POST['ISBN']}', '{$_POST['department']}')";

        if (mysqli_query($conn, $sql1)) {
            ?>
          <script type="text/javascript">
              alert("Book successfully Added.");
              window.location = "add-book.php"
          </script>
          <?php
        }


        //Close database connection
        mysqli_close($conn);
    }
}

?>

<div class="container mt-3">
    <h3 class="text-center">Add Book Form</h3>
</div>
<div class="container" style="height: 600px; ">
  <div class="form-container">
    <form method="post" action="add-book.php" class="row" onsubmit="return validateNumber(this);">
      <div class="form-group col-md-6">
        <label for="bookTitle" class="form-label">Book Title</label>
        <input type="text" name="book-title" class="form-control" id="bookTitle" required="required" placeholder="Enter book title">
      </div>
      <div class="form-group col-md-6">
        <label for="author" class="form-label">Author</label>
        <input type="text" name="author" class="form-control" id="author" required="required" placeholder="Enter author name">
      </div>
      <div class="form-group col-md-6">
        <label for="publisher" class="form-label">Publisher</label>
        <input type="text" name="publisher" class="form-control" id="author" required="required" placeholder="Enter publisher">
      </div>
      <div class="form-group col-md-6">
        <label for="edition" class="form-label">Edition</label>
        <input type="text" name="edition" class="form-control" id="edition" required="required" placeholder="Enter edition">
      </div>
      <div class="form-group col-md-6">
        <label for="page number" class="form-label">Page number</label>
        <input type="number" name="page-number" class="form-control" id="pageNumber" required="required" placeholder="Enter page number" min="0">
      <div id="number-error"></div>
      </div>

      <div class="form-group col-md-6">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" id="quantity" required="required" placeholder="Enter quantity of book" min="0">
      <div id="number-error2"></div>
      </div>

      <div class="form-group col-md-6">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" name="ISBN" class="form-control" id="isbn" required="required" placeholder="Enter ISBN">
      </div>
      <div class="form-group col-md-6">
        <label for="department" class="form-label">Department:</label>				
        <select class="form-control" name="department" id="department" required>
          <option value="Computer Science">Computer Science</option>
          <option value="Information System">Information System</option>
					<option value="Information Technology">Information Technology</option>
          <option value="Electrical Engineering">Electrical Engineering</option>
          <option value="Mechanical Engineering">Mechanical Engineering</option>
          <option value="Bio-medical Engineering">Bio-medical Engineering</option>
        </select>
      </div>
      <div class="form-group col-md-12">
        <button type="submit" name="submit" class="btn btn-success">Add</button>
        <a href="../Circulation Staff/index.php" class="btn btn-danger ml-2">Cancel</a>
      </div>
    </form>
  </div>
</div> 
    
  </body>
</html>
<?php include "../Header/footer.php" ?> <!--- footer -->
