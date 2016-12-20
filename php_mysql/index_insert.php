<?php
require_once('mysql_connect.php');
if (!$conn) {
    die('Connection error: ' . mysqli_connect_error());
}
//print('Connection:<br>');
//print_r($conn);
//print('<hr>');

//print('$_POST: <pre>');
//print_r($_POST);
//print('</pre><hr>');

// Data checking (details field must exist, but is allowed to be blank.
if (!isset($_POST)) {
    die('Form POST data not supplied.<br>');
} 
$response = [];

if (!isset($_POST['title']) || !strlen($_POST['title'])) {
    $response['success'] = false;
    $response['message'] = 'Form TITLE field does not exist.';
} else if (!isset($_POST['details'])) {
    $response['success'] = false;
    $response['message'] = 'Form DETAILS field does not exist.';
} else if (!isset($_POST['user_id']) || !strlen($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = 'Form USER ID field not supplied.';
} else {
    // Data defaulting.
    if (isset($_POST['timestamp']) && strlen($_POST['timestamp']) && strtotime($_POST['timestamp'])) {
        $date_string = $_POST['timestamp'];
    } else {
        $date_string = "NOW";
    }
    $date = strtotime($date_string);
    //print('$date_string: ' . $date_string . ', $date: ' . $date . '<br>');

    // Build the parameters into a query.
    $query = "INSERT INTO `todo_items` SET `id`=NULL, `title`='" . $_POST['title'] .
        "', `details`='" . $_POST['details'] . "', `timestamp`=" . $date . ", `user_id`=" . $_POST['user_id'] . ";";
    $response['query'] = $query;

    $result = mysqli_query($conn, $query);
    if ($result === false) {
        $response['success'] = false;
        $response['message'] = 'Error returned from query.';
    } else {
        $response['success'] = true;
        $response['affected_rows'] = mysqli_affected_rows($conn);
    }
};

// We have now built the response.  We can either get here from form_standard.php, in which case
// we should display the response.  We can also get here from form_ajax.php, in which case we don't
// display the data, we return it in JSON format.  The latter page will set the $_POST['return_json'] = true;
$response_json = json_encode($response);

if (isset($_POST['return_json']) && $_POST['return_json']) {
    // Return this as JSON.
    print($response_json);
} else {
    // Display this as a web page.
    print('<h3>Results from adding form data: ');
    print($response_json.success ? 'SUCCESS' : 'ERROR');
    print('</h3>');
    print('<pre>');
    print_r($response_json);
    print('</pre>');
}
