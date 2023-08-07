<?php
session_start();
$_SESSION['source_page'] = 'student-expired-books.php';
include "../Connection/connection.php"; // db configuration
include "../Header/staff_header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Expired books page</title>
    <style>
        .col-3 {
            float: right
        }

        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid black;
            padding: 8px;
            border-radius: 5px;
        }
    </style>
    <style>
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['userType'])) {
        // Update the issue-status column to 'Expired' for rows where the `return-date` is not an empty string AND current date is greater than the return-date
        $update_sql = "UPDATE `students_issue_book` SET `issue-status` = 'Expired' WHERE `return-date` != '' AND CURRENT_DATE() > `return-date`";
        mysqli_query($conn, $update_sql);

        // Update the overdue_fee column with the calculated late fee
        $update_fee_sql = "UPDATE `students_issue_book` SET `overdue_fee` = DATEDIFF(CURRENT_DATE(), `return-date`) * 5";
        mysqli_query($conn, $update_fee_sql);

        // Select rows from the students_issue_book table where the approve column is 'Expired'
        $select_sql = "SELECT student.`full-name`, student.idNumber, student.`phone-number`, student.`department`, 
        books.ISBN, author, `issue-status`, `issue-date`, `return-date`, students_issue_book.`book-title`, students_issue_book.`return-date`, students_issue_book.`overdue_fee`  
        FROM student 
        INNER JOIN `students_issue_book` ON student.`idNumber` = `students_issue_book`.`idNumber` 
        INNER JOIN books ON `students_issue_book`.ISBN = books.ISBN 
        WHERE `students_issue_book`.`issue-status` ='Expired' ORDER BY `return-date` DESC";

        $res = mysqli_query($conn, $select_sql);

        if (mysqli_num_rows($res) == 0) {
            echo "<div class='alert alert-warning text-center'><h3>There are no expired lists of books.</h3></div>";
        } else {
            ?>
            <div class="container-fluid">
                <div class="row justify-content-end mt-3">
                    <div class="col-md-4">
                        <form action="student-return-book.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="student-id" name="student-id" required="required" placeholder="Enter student's id number">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="isbn" name="isbn" required="required" placeholder="Enter book's ISBN">
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Return</button>
                        </form>
                    </div>
                </div>
            </div>

            <h3 class="text-center">Student's Expired List of Books</h3>

            <div class="table-responsive px-3">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style='background-color: #444; color: #fff;'>
                            <th>Name</th>
                            <th>ID No</th>
                            <th>Phone No</th>
                            <th>Department</th>
                            <th>Book ISBN</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Issue Date</th>
                            <th>Return Date</th>
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
                                    echo "<td>" . $row["issue-date"] . "</td>";
                                    echo "<td>" . $row["return-date"] . "</td>";

                                    echo "<td style='border-radius: 5px;'>";
                                    echo "<span style='background-color: red; color: white; padding: 2px 5px; border-radius: 5px;'>";
                                    echo $row["issue-status"];
                                    echo "</span>";
                                    echo "</td>";

                                    echo "<td>" . $row["overdue_fee"] . " birr</td>";

                                    echo "</tr>";
                                }
            ?>
                    </tbody>
                </table>
            </div>
    <?php
        }
    }
?>
</body>

</html>
