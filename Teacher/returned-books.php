<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/teacher_header.php";
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

// Select rows from the teachers_issue_book table where the approve column is 'Returned' for the current teachers
$select_sql = "SELECT teachers.`full-name`, teachers.username, teachers.`phone-number`, teachers.`department`, books.ISBN, author, `issue-status`, `issue-date`, `return-date`,`overdue_fee`, teachers_issue_book.`book-title`  
FROM teachers 
INNER JOIN `teachers_issue_book` ON teachers.username = `teachers_issue_book`.`username` 
INNER JOIN books ON `teachers_issue_book`.ISBN = books.ISBN 
WHERE `teachers_issue_book`.`issue-status` ='Returned' AND teachers.username = '{$_SESSION['username']}'";

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
                    <th>Name</th>
          <th>Username</th>
          <th>Phone Number</th>
          <th>Department</th>
          <th>Book's ISBN</th>
          <th>Book's Title</th>
          <th>Book's Author</th>
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
