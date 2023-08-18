<?php
require "DbHandler.php";
$handler = new DbHandler();
$sql = "SELECT RADGROESSE FROM fahrrad GROUP BY RADGROESSE;";
$result = $handler->executeQuery($sql);

$groessen = array();
while ($row = $result->fetch_assoc()) {
    $groessen[] = $row["RADGROESSE"];
}

echo json_encode($groessen);
