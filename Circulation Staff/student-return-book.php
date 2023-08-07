<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/staff_header.php";

// Check the source page and set a session variable
if (isset($_SESSION['source_page']) && $_SESSION['source_page'] === 'student-expired-books.php') {
    $_SESSION['from_expired_books'] = true;
} else {
    $_SESSION['from_expired_books'] = false;
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
    $Id = mysqli_real_escape_string($conn, $_POST['student-id']);
    $ISBN = mysqli_real_escape_string($conn, $_POST['isbn']);

    // Update the approve column to 'Returned' for the specified student and book, and set issue date and return date to NULL
    if ($_SESSION['from_expired_books']) {
        $update_sql = "UPDATE `students_issue_book` SET `issue-status` = 'Returned', `issue-date` = NULL, `return-date` = NULL, `overdue_fee` = 'Paid' WHERE `idNumber` = '$Id' AND `ISBN` = '$ISBN'";
    } else {
        $update_sql = "UPDATE `students_issue_book` SET `issue-status` = 'Returned', `issue-date` = NULL, `return-date` = NULL, `overdue_fee` = NULL WHERE `idNumber` = '$Id' AND `ISBN` = '$ISBN'";
    }

    mysqli_query($conn, "UPDATE books SET quantity = quantity+1 WHERE ISBN = '$ISBN';");

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        ?>
        <script type="text/javascript">
            alert("Book returned successfully.");
            window.location = "student-return-book.php";
        </script>
        <?php
    } else {
        echo "<div class='alert alert-danger text-center'><h3>There was an error returning the book.</h3></div>";
    }
}


// Select rows from the students_issue_book table where the approve column is 'Returned'
$select_sql = "SELECT student.`full-name`, student.idNumber, student.`phone-number`, student.`department`, books.ISBN, author, `issue-status`, `issue-date`, `return-date`,`overdue_fee`, students_issue_book.`book-title`  
FROM student 
INNER JOIN `students_issue_book` ON student.`idNumber` = `students_issue_book`.`idNumber` 
INNER JOIN books ON `students_issue_book`.ISBN = books.ISBN 
WHERE `students_issue_book`.`issue-status` ='Returned'";

$res = mysqli_query($conn, $select_sql);

if (mysqli_num_rows($res) == 0) {
    echo "<div class='alert alert-warning text-center'><h3>There are no returned books list for students.</h3></div>";
} else {
    ?>
    <h3 class="text-center mt-3">Student's Returned List of Books</h3><br>

    <div class="table-responsive px-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr style='background-color: #444; color: #fff;'>
                    <th>Student Name</th>
                    <th>Id Number</th>
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
                    echo "<td>" . $row["idNumber"] . "</td>";
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
