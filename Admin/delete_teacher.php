<?php

// Connect to the database
include "../Connection/connection.php";

// Check if username is set and not empty
if(isset($_POST['username']) && !empty($_POST['username'])) {


    // Escape and sanitize the username input
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    // Delete the teachers from the database
    $sql = "DELETE FROM teachers WHERE username = '$username'";
    if(mysqli_query($conn, $sql)) {
        echo "teacher deleted successfully.";
    } else {
        echo "Error deleting teachers: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
