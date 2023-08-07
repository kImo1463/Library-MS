<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/staff_header.php";

if(isset($_POST['update'])) {
    $isbn = $_POST['isbn'];
    $book_title = $_POST['book-title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $edition = $_POST['edition'];
    $page = $_POST['page-number'];
    $quantity = $_POST['quantity'];
    $department = $_POST['department'];

    $update_book_query = "UPDATE books SET `book-title`='$book_title', author='$author', publisher='$publisher',edition='$edition', `page-number`='$page', quantity='$quantity', department='$department' WHERE ISBN='$isbn'";

    $result = mysqli_query($conn, $update_book_query);

    if($result) {
        ?>
      <script type="text/javascript">
        alert("Book Information Updated successfully.");
        window.location="../Books/books.php"
      </script>
      <?php
        exit();
    } else {
        echo "Error updating book: " . mysqli_error($conn);
    }
} else {
    $isbn = $_GET['isbn'];

    $get_book_query = "SELECT * FROM books WHERE ISBN='$isbn'";
    $book_result = mysqli_query($conn, $get_book_query);

    if(mysqli_num_rows($book_result) == 1) {
        $row = mysqli_fetch_assoc($book_result);
    } else {
        echo "Error fetching book data";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>Update Book</title>
 <!-- Custom CSS -->
 <style>
      .form-container {
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 30px;
        margin-top: 25px;
        width: 1100px;
      }
      .form-label {
        font-weight: bold;
      }
      

</style>
</head>
<body>
<div class="container mt-3">
    <h3 class="text-center">Update Book</h3>
</div>
<div class="container" style="height: 550px;">
        <div class="col-md-6"> 
            <div class="form-container">
                <form method="POST" action="update-book.php">
                    <input type="hidden" name="isbn" value="<?php echo $row['ISBN']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="book_title" class="form-label">Book Title:</label>
                                <input type="text" class="form-control" id="book_title" name="book-title" value="<?php echo $row['book-title']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="author" class="form-label">Author:</label>
                                <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['author']; ?>" required>
                            </div>
                            <div class="form-group">
                            <label for="author" class="form-label">Publisher:</label>
                                <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $row['publisher']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="edition" class="form-label">Edition:</label>
                                <input type="text" class="form-control" id="edition" name="edition" value="<?php echo $row['edition']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="isbn" class="form-label">Page-number:</label>
                                <input type="text" class="form-control" id="page-number" name="page-number" value="<?php echo $row['page-number']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="category" class="form-label">Quantity:</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>
                            </div>
                            <div class="form-group">
                             <label for="quantity" class="form-label">Department:</label>
                               <select class="form-control" id="department" name="department" required>
                                <option value="Computer Science" <?php if ($row['department'] == 'Computer Science') {
                                    echo 'selected';
                                } ?>>Computer Science</option>
                                <option value="Information System" <?php if ($row['department'] == 'Information System') {
                                    echo 'selected';
                                } ?>>Information System</option>
                                <option value="Information Technology" <?php if ($row['department'] == 'Information Technology') {
                                    echo 'selected';
                                } ?>>Information Technology</option>
                                <option value="Electrical Engineering" <?php if ($row['department'] == 'Electrical Engineering') {
                                    echo 'selected';
                                } ?>>Electrical Engineering</option>
                                <option value="Mechanical Engineering" <?php if ($row['department'] == 'Mechanical Engineering') {
                                    echo 'selected';
                                } ?>>Mechanical Engineering</option>
                                <option value="Bio-medical Engineering" <?php if ($row['department'] == 'Bio-medical Engineering') {
                                    echo 'selected';
                                } ?>>Bio-medical Engineering</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update Book</button>
                    <a href="index.php" class="btn btn-danger ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>


</body>
</html>
<?php include "../Header/footer.php" ?> <!--- footer -->