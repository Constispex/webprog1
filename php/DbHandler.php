<?php
require "DbConnection.php";
require "Book.php";

class DbHandler {

    /**
     * Converts a mysqli_result to an array of Book objects
     * @param $result mysqli_result
     * @return array of Book objects
     */
    function resultToArray($result): array {
        $items = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Book($row["Title"], $row["Author"], $row["Publisher"], $row["Rating"], $row["Subareas"]);
                $items[] = $item;
            }
        }
        return $items;
    }

    /**
     * Executes a query and returns the result
     * @param $query string
     * @return mysqli_result|bool the result of the query
     */
    function executeQuery(string $query): mysqli_result|bool {
        $conn = connectToDb();
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }

    /**
     * @return array of Book objects
     */
    function getFilteredItems($filters): array {
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
        return $this->resultToArray($result);
    }
    /**
     *
     * @param array $filters
     * @param string $sort
     * @return array
     */
    public function getSortedItems(array $filters, string $sort): array {
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

        return $this->resultToArray($result);
    }
}
