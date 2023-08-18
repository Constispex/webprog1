<?php
require "DbHandler.php";

$sqlQuery = array();
if (isset($_GET["name"]) && $_GET["name"] !== "") {
    $sqlQuery[] = "BEZ LIKE '%" . $_GET["name"] . "%'";
}
if (isset($_GET["maxPrice"]) && $_GET["maxPrice"] !== "") {
    $sqlQuery[] = "preis <= " . $_GET["maxPrice"];
}
if (isset($_GET["size"]) && $_GET["size"] !== "") {
    $sqlQuery[] = "radgroesse LIKE " . $_GET["size"];
}
if (isset($_GET["elektro"]) && $_GET["elektro"] === "true") {
    $sqlQuery[] = "elektro = 'ja'";
}
if (isset($_GET["beleuchtung"]) && $_GET["beleuchtung"] === "true" ) {
    $sqlQuery[] = "beleuchtung = 'mit'";
}
$handler = new DbHandler();

if (isset($_GET["sort"]) && $_GET["sort"] !== "") {
    $sort = $_GET["sort"];
    if ($sort === "Name"){
        $sort = "bez";
    }

    $items = $handler->getSortedItems($sqlQuery, $sort);

} else {
    $items = $handler->getFilteredItems($sqlQuery);
}
echo json_encode($items);
