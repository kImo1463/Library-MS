<!DOCTYPE html>
<html>
<head>

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

	<title>Search page</title>

</head>
<body>

<?php
 include "../Connection/connection.php"; // db configuration
// start the session
session_start();
// check if the user is logged in and their user type
if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'student') {
    // if the user type is student, include the student header file
    include "../Header/student_header.php";

    if (isset($_POST['submit'])) {
        $category = isset($_GET['category']) ? $_GET['category'] : 'default_category';

        $q = mysqli_query($conn, "SELECT * FROM `e-books` WHERE department='$category' AND (author LIKE '%$_POST[search]%' OR `book_title` LIKE '%$_POST[search]%' OR `edition` LIKE '%$_POST[search]%')");

        if (mysqli_num_rows($q) == 0) {
            echo "<div class='alert alert-warning text-center'><h3>Sorry! No book found. Try searching again.</h3></div>";
        } else {
            ?>

            <div class="container"><br>
                <h3 class="text-center">Search Result</h3><br>
                <div class="row row-cols-1 row-cols-md-4">
                    <?php
                    while ($row = mysqli_fetch_assoc($q)) {
                        echo '<div class="col mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</h5>
                                        <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                        <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                        <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                    </div>
                                </div>
                            </div>';
                    }
            ?>
                </div>
            </div>
            
            <?php
        }
    }
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'teacher') {
    // if the user type is teacher, include the teacher header file
    include "../Header/teacher_header.php";

    if (isset($_POST['submit'])) {
        $category = isset($_GET['category']) ? $_GET['category'] : 'default_category';

        $q = mysqli_query($conn, "SELECT * FROM `e-books` WHERE department='$category' AND (author LIKE '%$_POST[search]%' OR `book_title` LIKE '%$_POST[search]%' OR `edition` LIKE '%$_POST[search]%')");

        if (mysqli_num_rows($q) == 0) {
            echo "<div class='alert alert-warning text-center'><h3>Sorry! No book found. Try searching again.</h3></div>";
        } else {
            ?>

            <div class="container"><br>
                <h3 class="text-center">Search Result</h3><br>
                <div class="row row-cols-1 row-cols-md-4">
                    <?php
                    while ($row = mysqli_fetch_assoc($q)) {
                        echo '<div class="col mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</h5>
                                        <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                        <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                        <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                    </div>
                                </div>
                            </div>';
                    }
            ?>
                </div>
            </div>
            
            <?php
        }
    }
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // if the user type is staff, include the staff header file
    include "../Header/staff_header.php";

    if (isset($_POST['submit'])) {
        $category = isset($_GET['category']) ? $_GET['category'] : 'default_category';

        $q = mysqli_query($conn, "SELECT * FROM `e-books` WHERE department='$category' AND (author LIKE '%$_POST[search]%' OR `book_title` LIKE '%$_POST[search]%' OR `edition` LIKE '%$_POST[search]%')");

        if (mysqli_num_rows($q) == 0) {
            echo "<div class='alert alert-warning text-center'><h3>Sorry! No book found. Try searching again.</h3></div>";
        } else {
            ?>

            <div class="container"><br>
                <h3 class="text-center">Search Result</h3><br>
                <div class="row row-cols-1 row-cols-md-4">
                    <?php
                    while ($row = mysqli_fetch_assoc($q)) {
                        echo '<div class="col mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</h5>
                                        <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                        <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                        <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                        <a href="../Circulation Staff/edit-e-book.php?isbn=' . $row['ISBN'] . '" class="btn btn-success">Edit</a>
                                        <a href="#" class="btn btn-danger delete-book" data-isbn=' . $row['ISBN'] . '>Delete</a>
                                    </div>
                                </div>
                            </div>';
                    }
            ?>
                </div>
            </div>
            
            <?php
        }
    }
}
?>
        <!-- jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>	
		<script>
		  $(".delete-book").on("click", function(e) {
		  e.preventDefault();
		  var ISBN = $(this).data("isbn");
		  console.log(ISBN); // Output the ISBN of the book
		  $.ajax({
			url: "../Circulation Staff/delete-book.php",
			type: "POST",
			data: { ISBN: ISBN },
			success: function(data) {
				alert("Book deleted successfully.");
				$(".message").html(data);
			  setTimeout(function() {
				$(".message").html("Book deleted successfully!");
				window.location.reload();
			  }, 500);
			},
			error: function(xhr, status, error) {
			console.log("Error: " + error);
			}
		  });
		});
		
		</script>
    <?php
?>
        </tbody>
      </table>
    </div>
   
</body>
</html>
