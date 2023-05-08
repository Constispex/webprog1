<?php
$db_servername = "localhost";
$db_database = "informatik";
$db_tableName = "buecher";
$db_username = "root";
$db_password = "";
$db_port = "3306";

function connectToDb() {
    global $db_servername, $db_database, $db_username, $db_password, $db_port;
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_database, $db_port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}