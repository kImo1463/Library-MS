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
<title>List of E-books</title>
<style>
    .card {
        height: 100%;
        margin-top: 30px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    .row-cols-md-4 > * {
        flex: 0 0 25%;
        max-width: 25%;
    }
</style>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php

// check if the user is logged in and their user type
if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'teacher') {

    // Retrieve the category query parameter
    $category = $_GET['category'];

    // Query the database to retrieve the books table based on the category
    if ($category == 'Computer Science') {

        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Computer Science'";
        $result = mysqli_query($conn, $sql);
        ?>
    
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author and edition">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                <div class="card-body">
                                    <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                    <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                    <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                    <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
    
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Information System') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Information System'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
        
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                <div class="card-body">
                                    <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                    <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                    <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                    <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Information Technology') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Information Technology'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
        
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                <div class="card-body">
                                    <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                    <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                    <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                    <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Electrical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Electrical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
        
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                <div class="card-body">
                                    <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                    <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                    <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                    <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Mechanical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Mechanical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
        
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                <div class="card-body">
                                    <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                    <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                    <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                    <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Bio-medical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Bio-medical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
        
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                                <div class="card-body">
                                    <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                    <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                    <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                    <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<div class='alert alert-warning'>No e-books found.</div>";

                }
    }










} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'student') {


    // Retrieve the category query parameter
    $category = $_GET['category'];

    // Query the database to retrieve the books table based on the category
    if ($category == 'Computer Science') {

        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Computer Science'";
        $result = mysqli_query($conn, $sql);
        ?>

<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author and edition">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>

                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Information System') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Information System'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Information Technology') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Information Technology'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Electrical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Electrical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Mechanical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Mechanical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Bio-medical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Bio-medical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By author,ISBN,book-title or publisher">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    echo "<div class='alert alert-warning'>No e-books found.</div>";

                }
    }

} elseif(isset($_SESSION['userType']) && $_SESSION['userType'] == 'staff') {

    // Retrieve the category query parameter
    $category = $_GET['category'];

    // Query the database to retrieve the books table based on the category
    if ($category == 'Computer Science') {

        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Computer Science'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author and edition">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                <a href="../Circulation Staff/edit-e-book.php?isbn=' . $row['ISBN'] . '" class="btn btn-success">Edit</a>
                                <a href="#" class="btn btn-danger delete-book" data-isbn=' . $row['ISBN'] . '>Delete</a>
                        </div>
                   </div>
             </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php
                }
    } elseif ($category == 'Information System') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Information System'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author and edition">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                <a href="../Circulation Staff/edit-e-book.php?isbn=' . $row['ISBN'] . '" class="btn btn-success">Edit</a>
                                <a href="#" class="btn btn-danger delete-book" data-isbn=' . $row['ISBN'] . '>Delete</a>                            
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Information Technology') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Information Technology'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author and edition">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                <a href="../Circulation Staff/edit-e-book.php?isbn=' . $row['ISBN'] . '" class="btn btn-success">Edit</a>
                                <a href="#" class="btn btn-danger delete-book" data-isbn=' . $row['ISBN'] . '>Delete</a>                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Electrical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Electrical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author and edition">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                <a href="../Circulation Staff/edit-e-book.php?isbn=' . $row['ISBN'] . '" class="btn btn-success">Edit</a>
                                <a href="#" class="btn btn-danger delete-book" data-isbn=' . $row['ISBN'] . '>Delete</a>                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Mechanical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Mechanical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author and edition">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                <a href="../Circulation Staff/edit-e-book.php?isbn=' . $row['ISBN'] . '" class="btn btn-success">Edit</a>
                                <a href="#" class="btn btn-danger delete-book" data-isbn=' . $row['ISBN'] . '>Delete</a>                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

                }
    } elseif ($category == 'Bio-medical Engineering') {
        // query e-books table
        $sql = "SELECT * FROM `e-books` WHERE department='Bio-medical Engineering'";
        $result = mysqli_query($conn, $sql);
        ?>
<div class="container-fluid">
  <div class="row justify-content-end mt-3">
    <div class="col-md-4">
      <form action="search-e-book.php?category=<?php echo $category; ?>" method="post">
        <div class="input-group mt-4">
          <input type="text" class="form-control" name="search" required="required" placeholder="By book-title, author and edition">
          <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="'.$row['cover_image'].'" alt=" ">
                            <div class="card-body">
                                <p class="card-title"><strong>Book Title:</strong> '.$row['book_title'].'</p>
                                <p class="card-text"><strong>Author:</strong> '.$row['author'].'</p>
                                <p class="card-text"><strong>Edition:</strong> '.$row['edition'].'</p>
                                <a href="read_book.php?file_path='.$row['file_path'].'" class="btn btn-primary">Read</a>
                                <a href="../Circulation Staff/edit-e-book.php?isbn=' . $row['ISBN'] . '" class="btn btn-success">Edit</a>
                                <a href="#" class="btn btn-danger delete-book" data-isbn=' . $row['ISBN'] . '>Delete</a>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    ?>
                 <div class="alert alert-warning text-center" style="margin: 0 auto; width: fit-content;">
                   <h3>No e-books found.</h3>
                 </div>
                  <?php

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
			url: "../Circulation Staff/delete-e-book.php",
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
    </div>
</div>

</body>
</html>
