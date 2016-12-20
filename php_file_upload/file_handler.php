<?php
// Constant definitions.
define("MAX_FILE_SIZE", 2000000);
define("UPLOAD_DIRECTORY", 'uploads/');

// Set up basic response.
$response = array(
    'success' => false,
    'errors' => array()
);

$description = $_POST['description'];

// Check that the uploads/ directory exists.
if (!file_exists(UPLOAD_DIRECTORY)) {
    array_push($response['errors'], 'uploads directory does not exist');
}

// Check the file size.
$size = $_FILES['upload_file']['size'];
if ($size > MAX_FILE_SIZE) {
    array_push($response['errors'], 'File too large');
}

// Check the file type.
$pathinfo = pathinfo($_FILES['upload_file']['name']);
$validExtensions = array('jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF', 'png', 'PNG');

if (!in_array($pathinfo['extension'], $validExtensions)) {
    array_push($response['errors'], 'Invalid file extension');
}

// If success so far, try to move the file.
if (count($response['errors']) == 0) {
    if (move_uploaded_file($_FILES['upload_file']['tmp_name'], UPLOAD_DIRECTORY . $pathinfo['basename'])) {
        // Everything succeeded.
        $response['success'] = true;
    } else {
        array_push($response['errors'], 'Error moving file to uploads directory');
    }
}

// Return the collected response to the caller.
$response['post'] = $_POST;
$response['files'] = $_FILES;
print json_encode($response);
