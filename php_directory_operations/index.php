<div id="image-container">

<?php
    $imageArray = glob("images/*.jpg");
    for ($i = 0; $i < count($imageArray); $i++) {
        print("<img src=$imageArray[$i]>");
    }
?>

</div>

