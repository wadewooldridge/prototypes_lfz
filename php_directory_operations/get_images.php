<?php
/**
 *  get_images.php - Return a JSON-encoded array of the list of available images.
 */
$imageArray = glob("images/*.jpg");
$imageObject = array(
    "success"   => true,
    "error"     => "",
    "files"     => $imageArray
);

print(json_encode($imageObject));
?>
