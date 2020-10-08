<?php
$db = mysqli_connect('localhost', 'root', '');

if ( $db === FALSE ) die('Error');

if ( mysqli_select_db($db,"library") === FALSE) die('Error');

?>