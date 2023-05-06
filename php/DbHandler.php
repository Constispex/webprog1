<?php
require "DbHandler.php";
function executeQuery($query): mysqli_result|bool
{
    $conn = connectToDb();
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function getItems($filters)
{
    $query = "SELECT * FROM buecher";
    if (count($filters) > 0) {
        $query .= " WHERE ";
        foreach ($filters as $filter) {
            $query .= $filter->getFilter();
            if ($filter !== end($filters)) {
                $query .= " AND ";
            }
        }
    }
    $query .= ";";
    $result = executeQuery($query);
    $items = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $item = new Book($row["title"], $row["author"], $row["publisher"], $row["rating"], $row["subareas"]);
            array_push($items, $item);
        }
    }
    return $items;
}
