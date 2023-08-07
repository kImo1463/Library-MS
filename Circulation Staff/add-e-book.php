<?php
include "../Connection/connection.php";
include "../Header/staff_header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add e-book page</title>

    <style>
  .form-container {
   background-color: #f8f9fa;
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
   padding: 30px;
   margin-top: 25px;
  }

 .form-label {
   font-weight: bold;
  }

 </style>
 
 <script type="text/javascript">

   function validate(form) {

   let coverImageInput=form.querySelector('#cover_image');
   let coverImageErrors=form.querySelector('#cover-image-errors');
   let allowedCoverImageExtensions=['jpg','jpeg','png','gif'];
   let coverImageType=coverImageInput.files[0].type;
   let coverImageSize=coverImageInput.files[0].size;
   let maxCoverImageSize=1 * 1024 * 1024; // 1MB in bytes
   let coverImageExtension=coverImageType.split('/').pop().toLowerCase();

   let file=form.querySelector('#file').value;
   let fileErrors=form.querySelector('#file-errors');
   let allowedFileTypes=['pdf','doc','docx'];
   let fileType=file.split('.').pop().toLowerCase();

   let fileSize=form.querySelector('#file').files[0].size;
   let maxFileSize=50000000; // Set the maximum file size here (in bytes)

   let coverImageErrorMessages=""; // Variable to store cover image error messages
   let fileErrorMessages=""; // Variable to store e-book file error messages

   if ( !coverImageInput.value) {
     coverImageErrorMessages+='<b style="color: red">Please select a cover image.</b><br>';
   }

   else {
     if ( !allowedCoverImageExtensions.includes(coverImageExtension)) {
       coverImageErrorMessages+='<b style="color: red">Only JPG, JPEG, PNG, and GIF files are allowed for the cover image.</b><br>';
     }

     if (coverImageSize > maxCoverImageSize) {
       coverImageErrorMessages+='<b style="color: red">Cover image size should not exceed 1MB.</b><br>';
     }
   }

   if ( !file) {
     fileErrorMessages+='<b style="color: red">Please select an e-book file.</b><br>';
   }

   else {
     if ( !allowedFileTypes.includes(fileType)) {
       fileErrorMessages+='<b style="color: red">Only PDF, DOC, and DOCX files are allowed for the e-book file.</b><br>';
     }

     if (fileSize > maxFileSize) {
       fileErrorMessages+='<b style="color: red">File is too large (max file size is '+(maxFileSize / 1000000)+' MB).</b><br>';
     }
   }

   // Display error messages separately for "cover image" and "e-book file" sections
   coverImageErrors.innerHTML=coverImageErrorMessages;
   fileErrors.innerHTML=fileErrorMessages;

   if (coverImageErrorMessages || fileErrorMessages) {
     return false;
   }

   return true;
 }

 </script>
</head>
<body>
<?php
// If the form is submitted
if (isset($_POST['submit'])) {

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO `e-books` (`book_title`, `author`, `publisher`,`edition`, `page_number`, `ISBN`, `department`, `cover_image`, `file_path`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $bookTitle, $author, $publisher, $edition, $pageNumber, $ISBN, $department, $coverImage, $filePath);

    // Get the form data
    $bookTitle = $_POST['book_title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $edition = $_POST['edition'];
    $pageNumber = $_POST['page_number'];
    $ISBN = $_POST['isbn'];
    $department = $_POST['department'];


    // Resize cover image

    // Define the target directory where the resized image will be stored
    $targetDir = "../Books/Cover-images/";

    // Get the original file name of the cover image
    $coverImage = $_FILES['cover_image']['name'];

    // Define the target file path by appending the target directory and the original file name
    $targetFile = $targetDir . $coverImage;

    // Get the width and height of the original image using the getimagesize function
    list($width, $height) = getimagesize($_FILES["cover_image"]["tmp_name"]);

    // Define the desired dimensions for the resized image
    $newWidth = 4400;
    $newHeight = 2800;

    // Create a new true-color image with the specified dimensions
    $imageResized = imagecreatetruecolor($newWidth, $newHeight);

    // Create a new image resource from the original image file
    $source = imagecreatefromjpeg($_FILES["cover_image"]["tmp_name"]);

    // Resize the original image to the desired dimensions using the imagecopyresized function
    // This function resizes and copies a portion of the original image onto the new image
    imagecopyresized($imageResized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    // Save the resized image to the target file path as a JPEG image with maximum quality (100)
    imagejpeg($imageResized, $targetFile, 100);

    // Destroy the original and resized images resources to free up memory
    imagedestroy($source);
    imagedestroy($imageResized);

    // Update the coverImage variable with the target file path
    $coverImage = $targetFile;


    // Upload e-book file
    $targetDir = "../Books/E-books/"; //  directory where we store e-books
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $filePath = $targetFile;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
        echo "";
    }

    // Execute the SQL statement
    $stmt->execute();

    // Check if the SQL statement was executed successfully
    if ($stmt) {
        ?>
        <script type="text/javascript">
            alert("E-book added successfully.");
            window.location = "add-e-book.php"
        </script>
        <?php
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
<div class="container mt-3">
    <h3 class="text-center">Add E-book Form</h3>
</div>
<div class="container" style="height: 600px;">
    <div class="form-container">
        <form action="add-e-book.php" method="POST" enctype="multipart/form-data" onsubmit="return validate(this);">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="book_title" class="form-label">Book Title:</label>
                        <input type="text" class="form-control" id="book_title" name="book_title" required placeholder="Enter book-title">
                    </div>
                    <div class="form-group">
                        <label for="author" class="form-label">Author:</label>
                        <input type="text" class="form-control" id="author" name="author" required placeholder="author">
                    </div>
                    <div class="form-group">
                        <label for="publisher" class="form-label">Publisher:</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" required placeholder="Enter publisher">
                    </div>
                    <div class="form-group">
                        <label for="edition" class="form-label">Edition</label>
                        <input type="text" name="edition" class="form-control" id="edition" required placeholder="Enter edition">
                    </div>
                    <div class="form-group">
                        <label for="page_number" class="form-label">Page Number:</label>
                        <input type="number" class="form-control" id="page_number" name="page_number" required placeholder="Enter page-number" min="0">
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="isbn" class="form-label">ISBN:</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" required placeholder="Enter ISBN">
                    </div>
                    <div class="form-group">
                        <label for="department" class="form-label">Department:</label>
                        <select class="form-control" name="department" id="department" required placeholder="Choose department">
                            <option value="Computer Science">Computer Science</option>
                            <option value="Information System">Information System</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Bio-medical Engineering">Bio-medical Engineering</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cover_image" class="form-label">Cover Image:</label>
                        <input type="file" class="form-control-file" id="cover_image" name="cover_image" required placeholder="Select cover-image">
                        <div id="cover-image-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="file" class="form-label">E-Book File:</label>
                        <input type="file" class="form-control-file" id="file" name="file" required placeholder="Select file">
                        <div id="file-errors"></div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Add E-Book</button>
            <a href="../Circulation staff/index.php" class="btn btn-danger ml-2">Cancel</a>

        </form>
    </div>
</div>
</body>
</html>
