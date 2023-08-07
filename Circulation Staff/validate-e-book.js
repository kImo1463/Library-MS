
  function validateForm() {
    let form = document.getElementById('update-form');

    let coverImageInput = form.querySelector('#cover_image');
    let coverImageErrors = form.querySelector('#cover-image-errors');
    let allowedCoverImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    let coverImageType = coverImageInput.files[0].type;
    let coverImageSize = coverImageInput.files[0].size;
    let maxCoverImageSize = 1 * 1024 * 1024; // 1MB in bytes
    let coverImageExtension = coverImageType.split('/').pop().toLowerCase();

    let fileInput = form.querySelector('#file');
    let fileErrors = form.querySelector('#file-errors');
    let allowedFileTypes = ['pdf', 'doc', 'docx'];
    let fileType = fileInput.files[0].type;
    let fileSize = fileInput.files[0].size;
    let maxFileSize = 50 * 1024 * 1024; // 50MB in bytes

    let coverImageErrorMessages = ""; // Variable to store cover image error messages
    let fileErrorMessages = ""; // Variable to store e-book file error messages

    if (!coverImageInput.value) {
      coverImageErrorMessages += '<b>Please select a cover image.</b><br>';
    } else {
      if (!allowedCoverImageExtensions.includes(coverImageExtension)) {
        coverImageErrorMessages += '<b>Only JPG, JPEG, PNG, and GIF files are allowed for the cover image.</b><br>';
      }
      if (coverImageSize > maxCoverImageSize) {
        coverImageErrorMessages += '<b>Cover image size should not exceed 1MB.</b><br>';
      }
    }

    if (!fileInput.value) {
      fileErrorMessages += '<b>Please select an e-book file.</b><br>';
    } else {
      if (!allowedFileTypes.includes(fileType)) {
        fileErrorMessages += '<b>Only PDF, DOC, and DOCX files are allowed for the e-book file.</b><br>';
      }
      if (fileSize > maxFileSize) {
        fileErrorMessages += '<b>File is too large (max file size is 50 MB).</b><br>';
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

  // Rest of the code...

