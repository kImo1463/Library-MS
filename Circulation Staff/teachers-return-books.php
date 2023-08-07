<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/staff_header.php";


// Check the source page and set a session variable
if (isset($_SESSION['source_page']) && $_SESSION['source_page'] === 'teachers-expired-books.php') {
    $_SESSION['from_expired_books'] = true;
    unset($_SESSION['from_approved_books']); // unset the other session variable if set
} elseif (isset($_SESSION['source_page']) && $_SESSION['source_page'] === 'teachers-request-information.php') {
    $_SESSION['from_approved_books'] = true;
    unset($_SESSION['from_expired_books']); // unset the other session variable if set
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Returned books page</title>
    <style>
        .col-3 {
            float: right;
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

</head>
<body>
<?php
if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['teachers_username']);
    $ISBN = mysqli_real_escape_string($conn, $_POST['isbn']);


    // Update the approve column to 'Returned' for the specified teachers and book, and set issue date and return date to NULL
    if ($_SESSION['from_expired_books']) {
        $update_sql = "UPDATE `teachers_issue_book` SET `issue-status` = 'Returned', `issue-date` = NULL, `return-date` = NULL, `overdue_fee` = 'Paid' WHERE `username` = '$name' AND `ISBN` = '$ISBN'";
    } elseif ($_SESSION['from_approved_books']) {
        $update_sql = "UPDATE `teachers_issue_book` SET `issue-status` = 'Returned', `issue-date` = NULL, `return-date` = NULL, `overdue_fee` = Null WHERE `username` = '$name' AND `ISBN` = '$ISBN'";
    }

    mysqli_query($conn, "UPDATE books SET quantity = quantity+1 WHERE ISBN = '$ISBN';");

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        ?>
        <script type="text/javascript">
            alert("Book returned successfully.");
            window.location = "teachers-return-books.php";
        </script>
        <?php
    } else {
        echo "<div class='alert alert-danger text-center'><h3>There was an error returning the book.</h3></div>";
    }
}


// Select rows from the teachers_issue_book table where the approve column is 'Returned'
$select_sql = "SELECT teachers.`full-name`, teachers.username, teachers.`phone-number`, teachers.`department`, books.ISBN, author, `issue-status`, `issue-date`, `return-date`,`overdue_fee`, teachers_issue_book.`book-title`  
FROM teachers 
INNER JOIN `teachers_issue_book` ON teachers.`username` = `teachers_issue_book`.`username` 
INNER JOIN books ON `teachers_issue_book`.ISBN = books.ISBN 
WHERE `teachers_issue_book`.`issue-status` ='Returned'";

$res = mysqli_query($conn, $select_sql);

if (mysqli_num_rows($res) == 0) {
    echo "<div class='alert alert-warning text-center'><h3>There are no returned books list for teachers.</h3></div>";
} else {
    ?>
    <h3 class="text-center mt-3">teachers's Returned List of Books</h3><br>

    <div class="table-responsive px-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr style='background-color: #444; color: #fff;'>
                     <th>Teacher's Name</th>
                     <th>Username</th>
                     <th>Phone Number</th>
                     <th>Department</th>
                     <th>Book ISBN</th>
                     <th>Book Title</th>
                     <th>Author</th>
                     <th>Status</th>
                     <th>Overdue Fee</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>" . $row["full-name"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["phone-number"] . "</td>";
                    echo "<td>" . $row["department"] . "</td>";
                    echo "<td>" . $row["ISBN"] . "</td>";
                    echo "<td>" . $row["book-title"] . "</td>";
                    echo "<td>" . $row["author"] . "</td>";

                    echo "<td style='border-radius: 5px;'>";
                    echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 5px;'>";
                    echo $row["issue-status"];
                    echo "</span>";
                    echo "</td>";



                    echo "<td style='border-radius: 5px;'>";

                    if ($row["overdue_fee"] === null) {
                        echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 5px;'>";
                        echo "Null";
                        echo "</span>";
                    } else {

                        echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 5px;'>";
                        echo $row["overdue_fee"];
                        echo "</span>";
                        echo "</td>";

                    }



                    echo "</tr>";
                }
    ?>
            </tbody>
        </table>
    </div>
<?php
}
?>

</body>
</html>
