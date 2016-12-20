<?php
/**
 * Created by PhpStorm.
 * User: Wade
 * Date: 11/3/2016
 * Time: 10:14 AM
 */

/* Feature Set 1 */
$a = 1;
$b = 5;
include('includes/data.php');
$result = $a * $b;
print("<br>Feature Set 1: result is $result.");

/* Feature Set 2 */
$c = 2;
include('includes/data2.php');
include_once('includes/data2.php');
include('includes/data2.php');
$result2 = $c;
print("<br>Feature Set 2: result is $result2.");
