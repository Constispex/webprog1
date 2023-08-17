<?php
include "DbConnection.php";
include "Bike.php";

class DbHandler {

    /**
     * Converts a mysqli_result to an array of Book objects
     * @param $result mysqli_result
     * @return array of Book objects
     */
    private function resultToArray(mysqli_result $result): array {
        $items = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Bike($row["TYP"], $row["BEZ"], $row["PREIS"], $row["GEWICHT"],
                    $row["RADGROESSE"], $row["GAENGE"], $row["ELEKTRO"], $row["BREMSE"],
                    $row["BELEUCHTUNG"], $row["BILD"], $row["RAHMENHOEHE"]);
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
    public function executeQuery(string $query): mysqli_result|bool {
        $conn = connectToDb();
        $result = $conn->query($query);
        if (!$result) {
            die("Query failed: " . $conn->error . "<br>Query: " . $query);
        }
        $conn->close();
        return $result;
    }

    /**
     * @return array of Book objects
     */
    public function getFilteredItems($filters): array {
        $query = "SELECT * FROM fahrrad";
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
        $query = "SELECT * FROM fahrrad";
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
