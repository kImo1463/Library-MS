<?php
session_start();
include "../Connection/connection.php"; // db configuration
include "../Header/staff_header.php";

if (isset($_POST['update'])) {
    // Get form data
    $isbn = $_POST['isbn'];
    $book_title = $_POST['book_title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $edition = $_POST['edition'];
    $pageNumber = $_POST['page_number'];
    $department = $_POST['department'];
    $coverImage = $_FILES['cover_image']['name'];
    $filePath = $_FILES['file']['name'];

    // Check if a new cover image is selected for uploading
    if (!empty($_FILES['cover_image']['name'])) {
        // Upload cover image file
        $targetDir = "../Books/Cover-images/"; // Directory where you want to store cover images
        $targetFile = $targetDir . basename($_FILES["cover_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $targetFile)) {
            // Cover image uploaded successfully
            $coverImage = $targetFile; // Set $coverImage to the actual file path of the uploaded image
        } else {
            echo "Error uploading cover image: " . $_FILES["cover_image"]["error"];
            exit();
        }
    }

    // Check if a new file is selected for uploading
    if (!empty($_FILES['file']['name'])) {
        // Upload e-book file
        $targetDir = "../Books/E-books/"; // Directory where you want to store e-books
        $targetFile = $targetDir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            // E-book file uploaded successfully
            $filePath = $targetFile; // Set $filePath to the actual file path of the uploaded file
        } else {
            echo "Error uploading e-book file: " . $_FILES["file"]["error"];
            exit();
        }
    }

    // Update book record in database
    $sql = "UPDATE `e-books` SET `book_title`='$book_title', `author`='$author', `publisher`='$publisher', `edition`='$edition', `page_number`='$pageNumber', `department`='$department'";

    // Update cover image path if a new cover image is uploaded
    if (!empty($_FILES['cover_image']['name'])) {
        $sql .= ", `cover_image`='$coverImage'";
    }

    // Update file path if a new file is uploaded
    if (!empty($_FILES['file']['name'])) {
        $sql .= ", `file_path`='$filePath'";
    }

    $sql .= " WHERE `ISBN`='$isbn'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        ?>
        <script type="text/javascript">
            alert("E-book updated successfully.");
            window.location = "../Books/e-books-card.php";
        </script>
        <?php
    } else {
        echo "Error updating book record: " . mysqli_error($conn);
    }
} else {
    $isbn = $_GET['isbn'];

    $get_book_query = "SELECT * FROM `e-books` WHERE ISBN='$isbn'";
    $book_result = mysqli_query($conn, $get_book_query);

    if (mysqli_num_rows($book_result) == 1) {
        $row = mysqli_fetch_assoc($book_result);
    } else {
        echo "Error fetching book data";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Book</title>
    <!-- Custom CSS -->
    <style>
      .form-container {
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 30px;
        margin-top: 25px;
        width: 1100px;
      }
      .form-label {
        font-weight: bold;
      }
    </style>

<script type="text/javascript">
  function validate(form) {
  let coverImageInput = form.querySelector('#cover_image');
  let coverImageErrors = form.querySelector('#cover-image-errors');
  let allowedCoverImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];  
  let coverImageType = coverImageInput.files[0].type;
  let coverImageSize = coverImageInput.files[0].size;
  let maxCoverImageSize = 1 * 1024 * 1024; // 1MB in bytes
  let coverImageExtension = coverImageType.split('/').pop().toLowerCase();

  let file = form.querySelector('#file').value;
  let fileErrors = form.querySelector('#file-errors');
  let allowedFileTypes = ['pdf', 'doc', 'docx'];
  let fileType = file.split('.').pop().toLowerCase();

  let fileSize = form.querySelector('#file').files[0].size;
  let maxFileSize = 50000000; // Set the maximum file size here (in bytes) which is 50 mb

  let coverImageErrorMessages = ""; // Variable to store cover image error messages
  let fileErrorMessages = ""; // Variable to store e-book file error messages

  if (!coverImageInput.value) {
    coverImageErrorMessages += '<b style="color: red">Please select a cover image.</b><br>';
  } else {
    if (!allowedCoverImageExtensions.includes(coverImageExtension)) {
      coverImageErrorMessages += '<b style="color: red">Only JPG, JPEG, PNG, and GIF files are allowed for the cover image.</b><br>';
}
    if (coverImageSize > maxCoverImageSize) {
      coverImageErrorMessages += '<b style="color: red">Cover image size should not exceed 1MB.</b><br>';
    }
  }

  if (!file) {
    fileErrorMessages += '<b style="color: red">Please select an e-book file.</b><br>';
  } else {
    if (!allowedFileTypes.includes(fileType)) {
      fileErrorMessages += '<b style="color: red">Only PDF, DOC, and DOCX files are allowed for the e-book file.</b><br>';
    }
    if (fileSize > maxFileSize) {
      fileErrorMessages += '<b style="color: red">File is too large (max file size is ' + (maxFileSize / 1000000) + ' MB).</b><br>';
    }
  }

  // Display error messages separately for "cover image" and "e-book file" sections
  coverImageErrors.innerHTML = coverImageErrorMessages;
  fileErrors.innerHTML = fileErrorMessages;

  if (coverImageErrorMessages || fileErrorMessages) {
    return false;
  }

  return true;
}
</script>
</head>
<body>
<div class="container mt-3">
    <h3 class="text-center">Update E-Book</h3>
</div>

<div class="container" style="height: 550px;">
    <div class="col-md-6">
        <div class="form-container">
         <form action="edit-e-book.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="isbn" value="<?php echo $row['ISBN']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="book_title" class="form-label">Book Title:</label>
                            <input type="text" class="form-control" id="book_title" name="book_title" value="<?php echo $row['book_title']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="author" class="form-label">Author:</label>
                            <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['author']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="publisher" class="form-label">Publisher:</label>
                            <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $row['publisher']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edition" class="form-label">Edition:</label>
                            <input type="text" class="form-control" id="edition" name="edition" value="<?php echo $row['edition']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="page_number" class="form-label">Page-number:</label>
                            <input type="text" class="form-control" id="page_number" name="page_number" value="<?php echo $row['page_number']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="cover_image" class="form-label">Cover Image:</label>
                            <input type="hidden" name="cover_image_original" value="<?php echo $row['cover_image']; ?>">
                             <div id="cover-image-errors"></div>
                            <a href="<?php echo $row['cover_image']; ?>" target="_blank"><?php echo $row['cover_image']; ?></a>
                            <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                            <span id="cover-image-name"></span>
                        </div>

                        <div class="form-group">
                            <label for="file" class="form-label">E-Book File:</label>
                            <input type="hidden" name="file_path_original" value="<?php echo $row['file_path']; ?>">
                            <div id="file-errors"></div>
                            <a href="<?php echo $row['file_path']; ?>" target="_blank"><?php echo $row['file_path']; ?></a>
                            <input type="file" class="form-control-file" id="file" name="file">
                            <span id="file-path-name"></span>
                        </div>

                        <div class="form-group">
                            <label for="department" class="form-label">Department:</label>
                            <select class="form-control" id="department" name="department" required>
                                <option value="Computer Science" <?php if ($row['department'] == 'Computer Science') {
                                    echo 'selected';
                                } ?>>Computer Science</option>
                                <option value="Information System" <?php if ($row['department'] == 'Information System') {
                                    echo 'selected';
                                } ?>>Information System</option>
                                <option value="Information Technology" <?php if ($row['department'] == 'Information Technology') {
                                    echo 'selected';
                                } ?>>Information Technology</option>
                                <option value="Electrical Engineering" <?php if ($row['department'] == 'Electrical Engineering') {
                                    echo 'selected';
                                } ?>>Electrical Engineering</option>
                                <option value="Mechanical Engineering" <?php if ($row['department'] == 'Mechanical Engineering') {
                                    echo 'selected';
                                } ?>>Mechanical Engineering</option>
                                <option value="Bio-medical Engineering" <?php if ($row['department'] == 'Bio-medical Engineering') {
                                    echo 'selected';
                                } ?>>Bio-medical Engineering</option>
                            </select>
                        </div>
                    </div>
                </div>
             <button type="submit" name="update" class="btn btn-success" onclick="return validate(this.form);">Update e-book</button>
                <a href="index.php" class="btn btn-danger ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var originalCoverImagePath = '<?php echo $row['cover_image']; ?>';

        $('#cover_image').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $('#cover-image-name').text(fileName);
            } else {
                $('#cover-image-name').text(originalCoverImagePath);
            }
        });

        // Update cover image name if the file input already has a value
        var coverImageValue = $('#cover_image').val();
        if (coverImageValue) {
            var fileName = coverImageValue.split('\\').pop();
            $('#cover-image-name').text(fileName);
        }
    });

    $(document).ready(function() {
        var originalFilePath = '<?php echo $row['file_path']; ?>';

        $('#file').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $('#file-path-name').text(fileName);
            } else {
                $('#file-path-name').text(originalFilePath);
            }
        });

        // Update file path name if the file input already has a value
        var filePathValue = $('#file').val();
        if (filePathValue) {
            var fileName = filePathValue.split('\\').pop();
            $('#file-path-name').text(fileName);
        }
    });
</script>
</body>
</html>
