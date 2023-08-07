<?php

// Connect to the database
include "../Connection/connection.php";

// Check if ISBN is set and not empty
if (isset($_POST['ISBN']) && !empty($_POST['ISBN'])) {
    // Escape and sanitize the ISBN input
    $ISBN = mysqli_real_escape_string($conn, $_POST['ISBN']);

    // Retrieve the file paths from the database
    $sql = "SELECT `cover_image`, `file_path` FROM `e-books` WHERE ISBN = '$ISBN'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $coverImage = $row['cover_image'];
    $filePath = $row['file_path'];

    // Delete the book from the database
    $sql = "DELETE FROM `e-books` WHERE ISBN = '$ISBN'";
    if (mysqli_query($conn, $sql)) {
        // Delete the actual files. The unlink() function in PHP is used to delete a file from the server's file system.
        // It takes a single parameter, which is the path to the file that we want to delete.
        unlink($coverImage);
        unlink($filePath);

        echo "E-book deleted successfully.";
    } else {
        echo "Error deleting e-book: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
