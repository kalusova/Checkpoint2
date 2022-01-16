<?php

$mysqli = new mysqli("localhost","c1kalusova","amHqWX9oBTWc","c1kalusova");

// Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

$mysqli -> set_charset("utf8");
?>