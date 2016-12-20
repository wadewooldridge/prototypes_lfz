<!-- Session Setter -->
<!-- Feature Set 1 -->
<?php
session_start();

//print('$_SESSION: ');
//print_r($_SESSION);
//print('<br>');
if (array_key_exists('errors', $_SESSION)) {
    print('<p><ul>Error(s):');
    $errors = $_SESSION['errors'];
    for ($i = 0; $i < count($errors); $i++) {
        print("<li>$errors[$i]</li>");
    }
    print('</ul></p><br>');
}
?>
<form action="http://localhost/prototypes_C11/php_sessions/session_reader.php" method="get">
    <label for="name-input">Name: </label>
    <input type="text" name="name" id="name-input" value="<?php print($_SESSION['savedName']); ?>">
    <br>
    <label for="age-input">Age: </label>
    <input type="text" name="age" id="age-input" value="<?php print($_SESSION['savedAge']); ?>">
    <br>
    <label for="occupation-input">Occupation: </label>
    <input type="text" name="occupation" id="occupation-input" value="<?php print($_SESSION['savedOccupation']); ?>">
    <br>
    <input type="submit">
</form>
