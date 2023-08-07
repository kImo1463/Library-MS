<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/student_header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Issue Info</title>
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

// Select rows from the students_issue_book table where the approve column is 'Returned' for the current student
$select_sql = "SELECT student.`full-name`, student.idNumber, student.`phone-number`, student.`department`, books.ISBN, author, `issue-status`, `issue-date`, `return-date`,`overdue_fee`, students_issue_book.`book-title`  
FROM student 
INNER JOIN `students_issue_book` ON student.idNumber = `students_issue_book`.`idNumber` 
INNER JOIN books ON `students_issue_book`.ISBN = books.ISBN 
WHERE `students_issue_book`.`issue-status` ='Returned' AND student.idNumber = '{$_SESSION['idNumber']}'";

$res = mysqli_query($conn, $select_sql);

if (mysqli_num_rows($res) == 0) {
    echo "<div class='alert alert-warning text-center'><h3>There are no returned books in your list.</h3></div>";
} else {
    ?>
    <h3 class="text-center mt-3">Your Returned List of Books</h3><br>

    <div class="table-responsive px-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr style='background-color: #444; color: #fff;'>
                    <th>Student Name</th>
                    <th>Id Number</th>
                    <th>Phone Number</th>
                    <th>Department</th>
                    <th>Returned Book ISBN</th>
                    <th>Returned Book Title</th>
                    <th>Returned Book Author</th>
                    <th>Returned Book Status</th>
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

                    echo "</td>";



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
