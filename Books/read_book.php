
<?php

// Get the file path from the URL
if(isset($_GET['file_path'])) {
    $filePath = $_GET['file_path'];
    // Check if the file exists
    if(file_exists($filePath)) {
        // Display the e-book
        header('Content-type: application/pdf');
        readfile($filePath);
    } else {
        // If the file does not exist, redirect to homepage
        header('Location: index.php');
        exit();
    }
} else {
    // If the file path is not set, redirect to homepage
    header('Location: index.php');
    exit();
}
