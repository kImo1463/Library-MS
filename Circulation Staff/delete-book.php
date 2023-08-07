<?php
// Connect to the database
include "../Connection/connection.php"; 

// Check if ISBN is set and not empty
if(isset($_POST['ISBN']) && !empty($_POST['ISBN'])) {
    
    
    // Escape and sanitize the ISBN input
    $ISBN = mysqli_real_escape_string($conn, $_POST['ISBN']);
    
    // Delete the book from the database
    $sql = "DELETE FROM books WHERE ISBN = '$ISBN'";
    if(mysqli_query($conn, $sql)) {
        echo "Book deleted successfully.";
    } else {
        echo "Error deleting book: " . mysqli_error($conn);
    }
    
    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
