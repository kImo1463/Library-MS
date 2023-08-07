<?php
// db configuration
include "../Connection/connection.php";
// start the session
session_start();
// check if the user is logged in and their user type
if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'student') {
    // if the user type is student, include the student header file
    include "../Header/student_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {
    // if the user type is staff include the staff header file
    include "../Header/staff_header.php";
} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'teacher') {
    // if the user type is teacher include the teacher header file
    include "../Header/teacher_header.php";
}
?>

<!DOCTYPE html>
<html>
<head>

    <style>
.col-3 {
  float: right
  
}

button[name="submit"] {
  width: 80px;
}
table {
  border-collapse: collapse;
}
td, th {
  border: 1px solid black;
  padding: 8px;
  border-radius: 5px;
}
    </style>



	<title>Books List Page</title>

</head>
<body>


<?php
$title = '';
// check if the user is logged in and their user type
if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'student') {

    // Retrieve the category query parameter
    $category = $_GET['category'];

    // Query the database to retrieve the books table based on the category
    if ($category == 'Computer Science') {
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>

      <form action="books-list.php" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
		  <input type="hidden" name="book-title" value="<?php echo $title; ?>">
          <div class="input-group-append">
            <button type="submit" name="submit2" class="btn btn-success">Request</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

  <h3 class="text-center">Computer Science Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for computer science department books
                        $sql = "SELECT * FROM books WHERE department='Computer Science' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Information System') {
        ?>

<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit2" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Information System Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

     // Query the books table for computer science department books
     $sql = "SELECT * FROM books WHERE department='Information System' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Information Technology') {
        ?>
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit2" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Information Technology Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Information Technology department books
                        $sql = "SELECT * FROM books WHERE department='Information Technology' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
                </tbody>
            </table>
        </div>
    <?php
    } elseif ($category == 'Electrical Engineering') {
        ?>

<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit2" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Electrical Engineering Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Electrical Engineering department books
                        $sql = "SELECT * FROM books WHERE department='Electrical Engineering' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
                </tbody>
            </table>
        </div>
    <?php
    } elseif ($category == 'Mechanical Engineering') {
        ?>
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit2" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Mechanical Engineering Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Mechanical Engineering department books
                        $sql = "SELECT * FROM books WHERE department='Mechanical Engineering' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
                </tbody>
            </table>
        </div>
    <?php
    } elseif ($category == 'Bio-medical Engineering') {
        ?>

<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit2" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Bio-medical Engineering Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Bio-medical Engineering department books
                        $sql = "SELECT * FROM books WHERE department='Bio-medical Engineering' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
                </tbody>
            </table>
        </div>
    <?php
    }
}

if(isset($_POST['submit2'])) {
    // Get the number of books already issued to the student
    $query = "SELECT COUNT(*) as count FROM students_issue_book WHERE `idNumber` = '{$_SESSION['idNumber']}' AND `issue-status` = ''";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $numBooksIssued = $row['count'];

    // Check if the student has already issued three books
    if($numBooksIssued >= 5) {
        ?>
        <script type="text/javascript">
            alert("You have already requested the maximum number of books.");
            window.location="../Student/student-request.php"
        </script>
        <?php
        exit;
    }

    // Proceed with the book request
    $isbn = mysqli_real_escape_string($conn, $_POST['ISBN']);
    $query = "SELECT `book-title` FROM books WHERE ISBN = '$isbn'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['book-title'];
        mysqli_query($conn, "INSERT INTO `students_issue_book` (`idNumber`, `book-title`, `ISBN`, `issue-status`, `issue-date`, `return-date`) VALUES ('{$_SESSION['idNumber']}','$title', '$isbn', '', '', '');");
        ?>
        <script type="text/javascript">
			alert("Book Requested successfully.");
            window.location="../Student/student-request.php"
        </script>
<?php
    }
}






// check if the user is logged in and their user type is teacher
elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'teacher') {

    // Retrieve the category query parameter
    $category = $_GET['category'];

    // Query the database to retrieve the books table based on the category
    if ($category == 'Computer Science') {
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>

      <form action="books-list.php" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
		  <input type="hidden" name="book-title" value="<?php echo $title; ?>">
          <div class="input-group-append">
            <button type="submit" name="submit3" class="btn btn-success">Request</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

  <h3 class="text-center">Computer Science Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for computer science department books
                        $sql = "SELECT * FROM books WHERE department='Computer Science' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Information System') {
        ?>

<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit3" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Information System Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

     // Query the books table for computer science department books
     $sql = "SELECT * FROM books WHERE department='Information System' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
			</tbody>
		</table>
	</div>
<?php
    } elseif ($category == 'Information Technology') {
        ?>
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit3" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Information Technology Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Information Technology department books
                        $sql = "SELECT * FROM books WHERE department='Information Technology' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
                </tbody>
            </table>
        </div>
    <?php
    } elseif ($category == 'Electrical Engineering') {
        ?>

<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit3" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Electrical Engineering Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Electrical Engineering department books
                        $sql = "SELECT * FROM books WHERE department='Electrical Engineering' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
                </tbody>
            </table>
        </div>
    <?php
    } elseif ($category == 'Mechanical Engineering') {
        ?>
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit3" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Mechanical Engineering Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Mechanical Engineering department books
                        $sql = "SELECT * FROM books WHERE department='Mechanical Engineering' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
                </tbody>
            </table>
        </div>
    <?php
    } elseif ($category == 'Bio-medical Engineering') {
        ?>

<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
		
		
		<form action="books-list.php" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="ISBN" required="required" placeholder="Request by ISBN number">
				<div class="input-group-append">
					<button type="submit" name="submit3" class="btn btn-success">Request</button>
				</div>
			</div>
		  </div>
		</div>
	</div>
		</form><br>
  <h3 class="text-center">Bio-medical Engineering Department Books </h3>

  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Bio-medical Engineering department books
                        $sql = "SELECT * FROM books WHERE department='Bio-medical Engineering' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
                </tbody>
            </table>
        </div>
    <?php
    }
}

if(isset($_POST['submit3'])) {
    // Get the number of books already issued to the teacher`
    $query = "SELECT COUNT(*) as count FROM teachers_issue_book WHERE `username` = '{$_SESSION['username']}' AND `issue-status` = ''";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $numBooksIssued = $row['count'];

    // Check if the teacher has already issued six books
    if($numBooksIssued >= 7) {
        ?>
        <script type="text/javascript">
            alert("You have already requested the maximum number of books.");
            window.location="../Teacher/teacher-request.php"
        </script>
        <?php
        exit;
    }

    // Proceed with the book request
    $isbn = mysqli_real_escape_string($conn, $_POST['ISBN']);
    $query = "SELECT `book-title` FROM books WHERE ISBN = '$isbn'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['book-title'];
        mysqli_query($conn, "INSERT INTO `teachers_issue_book` (`username`, `book-title`, `ISBN`, `issue-status`, `issue-date`, `return-date`) VALUES ('{$_SESSION['username']}', '$title', '$isbn', '', '', '');");
        ?>
        <script type="text/javascript">
			alert("Book Requested successfully.");
            window.location="../Teacher/teacher-request.php"
        </script>
<?php
    }
}







// if the user type is staff
elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {

    // Retrieve the category query parameter
    $category = $_GET['category'];

    // Query the database to retrieve the books table based on the category
    if ($category == 'Computer Science') {
        ?>
	
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">Computer Science Department Books </h3><br>

	
<div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

        // Query the books table for computer science department books
        $sql = "SELECT * FROM books WHERE department='Computer Science' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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
					  <a href="#" class="btn btn-danger delete-book" data-ISBN="' . $row['ISBN'] . '">Delete</a>
				  </td>';




            echo "</tr>";
        }



        ?>
	
				</tbody>
			</table>
		</div>
	<?php
    } elseif ($category == 'Information System') {
        ?>
	
	<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">Information System Department Books </h3><br>

	
  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for computer science department books
                        $sql = "SELECT * FROM books WHERE department='Information System' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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
					  <a href="#" class="btn btn-danger delete-book" data-ISBN="' . $row['ISBN'] . '" data-toggle="modal" data-target="#confirm-delete">Delete</a>
				  </td>';
            echo "</tr>";
        }


        ?>
				</tbody>
			</table>
		</div>
	<?php
    } elseif ($category == 'Information Technology') {
        ?>
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">Information Technology Department Books </h3><br>

				
  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Information Technology department books
                        $sql = "SELECT * FROM books WHERE department='Information Technology' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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
					  <a href="#" class="btn btn-danger delete-book" data-ISBN="' . $row['ISBN'] . '" data-toggle="modal" data-target="#confirm-delete">Delete</a>
				  </td>';
            echo "</tr>";
        }


        ?>
					</tbody>
				</table>
			</div>
		<?php
    } elseif ($category == 'Electrical Engineering') {
        ?>
	
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">Electrical Engineering Department Books </h3><br>

	
  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

                        // Query the books table for Electrical Engineering department books
                        $sql = "SELECT * FROM books WHERE department='Electrical Engineering' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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
					  <a href="#" class="btn btn-danger delete-book" data-ISBN="' . $row['ISBN'] . '" data-toggle="modal" data-target="#confirm-delete">Delete</a>
				  </td>';
            echo "</tr>";
        }


        ?>
					</tbody>
				</table>
			</div>
		<?php
    } elseif ($category == 'Mechanical Engineering') {
        ?>
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">Mechanical Engineering Department Books </h3><br>

	
		
  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

     // Query the books table for Mechanical Engineering department books
    $sql = "SELECT * FROM books WHERE department='Mechanical Engineering' ORDER BY `book-title` ASC";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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


        ?>
					</tbody>
				</table>
			</div>
		<?php
    } elseif ($category == 'Bio-medical Engineering') {
        ?>
	
<div class="container-fluid">
    <div class="row justify-content-end mt-3">
        <div class="col-md-4">
			<form action="search-book.php?category=<?php echo $category; ?>" method="post">
			<div class="input-group mt-4">
				<input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author, publisher and ISBN">
				<div class="input-group-append">
					<button type="submit" name="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	 </div>
  </div>
</div><br>
		
  <h3 class="text-center">Bio-medical Engineering Department Books </h3><br>
  	
  <div class="table-responsive px-3">
       <table class="table table-striped table-bordered ">
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

    // Query the books table for Bio-medical Engineering department books
    $sql = "SELECT * FROM books WHERE department='Bio-medical Engineering'";

        $result = mysqli_query($conn, $sql);

        // Loop through the results and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
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

        ?>
					</tbody>
				</table>
			</div>
		<?php
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

</body>
</html>
