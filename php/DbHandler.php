<?php
require "DbConnection.php";
require "Book.php";

class DbHandler
{
    function getItems($filters): array
    {
        $query = "SELECT * FROM buecher";
        if (count($filters) > 0) {
            $query .= " WHERE ";
            foreach ($filters as $filter) {
                $query .= $filter;
                if ($filter !== end($filters)) {
                    $query .= " AND ";
                }
            }
        }
        $query .= ";";
        $result = $this->executeQuery($query);
        $items = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Book($row["Title"], $row["Author"], $row["Publisher"], $row["Rating"], $row["Subareas"]);
                $items[] = $item;
            }
        }
        return $items;
    }

    function executeQuery($query): mysqli_result|bool
    {
        $conn = connectToDb();
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    public function getSortedItems(array $filters, mixed $sort): array
    {
        $query = "SELECT * FROM buecher";
        if (count($filters) > 0) {
            $query .= " WHERE ";
            foreach ($filters as $filter) {
                $query .= $filter;
                if ($filter !== end($filters)) {
                    $query .= " AND ";
                }
            }
            $query .= " ORDER BY " . $sort;
        }
        $query .= ";";
        $result = $this->executeQuery($query);
        $items = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Book($row["Title"], $row["Author"], $row["Publisher"], $row["Rating"], $row["Subareas"]);
                $items[] = $item;
            }
        }
        return $items;
    }
}
