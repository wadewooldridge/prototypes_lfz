<!-- Session Reader -->
<!-- Feature Set 1 - Echo the form data. -->
<?php
session_start();

//print('session_reader.php<br>');
//print_r($_GET);
//print('<br>');

$name = $_GET['name'];
$age = $_GET['age'];
$occupation = $_GET['occupation'];

$_SESSION['savedName'] = $name;
$_SESSION['savedAge'] = $age;
$_SESSION['savedOccupation'] = $occupation;

// Feature Set 2 - Perform checks on the various data fields.
$errors = [];
if (strlen($name) == 0) {
    array_push($errors, 'Name field must be supplied.');
} elseif (preg_match('/[^A-Za-z ]+/', $name)) {
    array_push($errors, 'Name field must contain only alphabetical characters and spaces.');
}

if (strlen($age) == 0) {
    array_push($errors, 'Age field must be supplied.');
} elseif (preg_match('/[^0-9]+/', $age)) {
    array_push($errors, 'Age field must contain only numeric characters.');
} elseif ($age < 0 || $age > 110) {
    array_push($errors, 'Age field must be a valid integer between 0 and 110.');
}

if (strlen($occupation) == 0) {
    array_push($errors, 'Occupation field must be supplied.');
} elseif (preg_match('/[^A-Za-z ]+/', $occupation)) {
    array_push($errors, 'Occupation field must contain only alphabetical characters and spaces.');
}

// If we built something in the $errors array, add it to the $_SESSION.
if (count($errors) == 0) {
    //print('No errors<br>');
    unset($_SESSION['errors']);
    print("<p>Accepted: name='$name', age='$age', occupation='$occupation'</p>");
} else {
    //print('Errors found:<br>');
    //print_r($errors);
    //print('<br>');
    $_SESSION['errors'] = $errors;
    header("Location: session_setter.php");
}

//print('<br>');
//print_r($_SESSION);