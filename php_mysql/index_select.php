<!-- index_select.php -->
<?php
require_once('mysql_connect.php');
if (!$conn) {
    die('Connection error: ' . mysqli_connect_error());
}
print('Connection:<br>');
print_r($conn);
print('<hr>');
$query = "SELECT * FROM `todo_items` WHERE `user_id` = 99999";
$result = mysqli_query($conn, $query);
if ($result === false) {
    print('Error: $result is false.<br>');
}
print('Number of rows from query: '.mysqli_num_rows($result).'<br>');
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        print('<hr><pre>');
        print_r($row);
        print('</pre><br>');
    }
}
