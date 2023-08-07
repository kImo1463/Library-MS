<?php

// Connect to the database
include "../Connection/connection.php";

// Check if idNumber is set and not empty
if(isset($_POST['idNumber']) && !empty($_POST['idNumber'])) {


    // Escape and sanitize the ISBN input
    $idNumber = mysqli_real_escape_string($conn, $_POST['idNumber']);

    // Delete the student from the database
    $sql = "DELETE FROM student WHERE idNumber = '$idNumber'";
    if(mysqli_query($conn, $sql)) {
        echo "Student deleted successfully.";
    } else {
        echo "Error deleting student: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
