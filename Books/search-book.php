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
if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'student') {
    // if the user type is student, include the student header file
    include "../Header/student_header.php";

    if (isset($_POST['submit'])) {
        $category = isset($_GET['category']) ? $_GET['category'] : 'default_category';

        $q=mysqli_query($conn, "SELECT * FROM books WHERE department='$category' AND (author LIKE '%$_POST[search]%' OR `book-title` LIKE '%$_POST[search]%' OR publisher LIKE '%$_POST[search]%' OR ISBN LIKE '%$_POST[search]%')");

        if (mysqli_num_rows($q)==0) {
            echo "<div class='alert alert-warning text-center'><h3>Sorry! No book found. Try searching again.</h3></div>";
        } else {
            ?>    
    

    <div class="container-fluid mt-3">
      <h3 class="text-center">Search Result</h3><br>
        <table class="table table-striped table-bordered">
                <thead>
                    <tr style='background-color: #444; color: #fff;'>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Edition</th>
                        <th>Page Number</th>
                        <th>Quantity</th>
                        <th>ISBN</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
        <?php

                                while ($row=mysqli_fetch_assoc($q)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["book-title"] . "</td>";
                                    echo "<td>" . $row["author"] . "</td>";
                                    echo "<td>" . $row["publisher"] . "</td>";
                                    echo "<td>" . $row["edition"] . "</td>";
                                    echo "<td>" . $row["page-number"] . "</td>";
                                    echo "<td>" . $row["quantity"] . "</td>";
                                    echo "<td>" . $row["ISBN"] . "</td>";
                                    echo "<td>" . $row["department"] . "</td>";

                                    echo "</tr>";
                                }
                            echo "</table>";
        }
    }
    ?>
        </tbody>
      </table>
    </div>
<?php
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'teacher') {
    // if the user type is teacher, include the teacher header file
    include "../Header/teacher_header.php";

    if (isset($_POST['submit'])) {
        $category = isset($_GET['category']) ? $_GET['category'] : 'default_category';

        $q=mysqli_query($conn, "SELECT * FROM books WHERE department='$category' AND (author LIKE '%$_POST[search]%' OR `book-title` LIKE '%$_POST[search]%' OR publisher LIKE '%$_POST[search]%' OR ISBN LIKE '%$_POST[search]%')");

        if (mysqli_num_rows($q)==0) {
            echo "<div class='alert alert-warning text-center'><h3>Sorry! No book found. Try searching again.</h3></div>";
        } else {
            ?>    
     
 
     <div class="container-fluid mt-3">
       <h3 class="text-center">Search Result</h3><br>
         <table class="table table-striped table-bordered">
                 <thead>
                     <tr style='background-color: #444; color: #fff;'>
                         <th>Title</th>
                         <th>Author</th>
                         <th>Publisher</th>
                         <th>Edition</th>
                         <th>Page Number</th>
                         <th>Quantity</th>
                         <th>ISBN</th>
                         <th>Department</th>
                     </tr>
                 </thead>
                 <tbody>
         <?php

                                while ($row=mysqli_fetch_assoc($q)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["book-title"] . "</td>";
                                    echo "<td>" . $row["author"] . "</td>";
                                    echo "<td>" . $row["publisher"] . "</td>";
                                    echo "<td>" . $row["edition"] . "</td>";
                                    echo "<td>" . $row["page-number"] . "</td>";
                                    echo "<td>" . $row["quantity"] . "</td>";
                                    echo "<td>" . $row["ISBN"] . "</td>";
                                    echo "<td>" . $row["department"] . "</td>";

                                    echo "</tr>";
                                }
                            echo "</table>";
        }
    }
    ?>
         </tbody>
       </table>
     </div>
 <?php
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // if the user type is staff, include the staff header file
    include "../Header/staff_header.php";

    if (isset($_POST['submit'])) {
        $category = isset($_GET['category']) ? $_GET['category'] : 'default_category';

        $q=mysqli_query($conn, "SELECT * FROM books WHERE department='$category' AND (author LIKE '%$_POST[search]%' OR `book-title` LIKE '%$_POST[search]%' OR publisher LIKE '%$_POST[search]%' OR ISBN LIKE '%$_POST[search]%')");

        if (mysqli_num_rows($q)==0) {
            echo "<div class='alert alert-warning text-center'><h3>Sorry! No book found. Try searching again.</h3></div>";
        } else {
            ?>
    
    
    <div class="container-fluid mt-3">
    <h3 class="text-center">Search Result</h3><br>
    <table class="table table-striped table-bordered">
                <thead>
                    <tr style='background-color: #444; color: #fff;'>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Edition</th>
                        <th>Page Number</th>
                        <th>Quantity</th>
                        <th>ISBN</th>
                        <th>Department</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
        <?php

                                while ($row=mysqli_fetch_assoc($q)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["book-title"] . "</td>";
                                    echo "<td>" . $row["author"] . "</td>";
                                    echo "<td>" . $row["publisher"] . "</td>";
                                    echo "<td>" . $row["edition"] . "</td>";
                                    echo "<td>" . $row["page-number"] . "</td>";
                                    echo "<td>" . $row["quantity"] . "</td>";
                                    echo "<td>" . $row["ISBN"] . "</td>";
                                    echo "<td>" . $row["department"] . "</td>";
                                    echo '<td class="edit">
                                       <a href="../Circulation Staff/update-book.php?isbn=' . $row['ISBN'] . '" class="btn btn-success">Edit</a>
                                         </td>';
                                    echo '<td class="delete">
                                         <a href="#" class="btn btn-danger delete-book" data-isbn=' . $row['ISBN'] . '>Delete</a>
                                        </td>';
                                    echo "</tr>";
                                }
                            echo "</table>";
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
}

?>
        </tbody>
      </table>
    </div>
   
</body>
</html>
