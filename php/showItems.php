<?php
require "DbHandler.php";

$sqlQuery = array();
if (isset($_GET["name"]) && $_GET["name"] !== "") {
    $sqlQuery[] = "bez LIKE '%" . $_GET["name"] . "%'";
}
if (isset($_GET["maxPrice"]) && $_GET["maxPrice"] !== "") {
    $sqlQuery[] = "preis >= " . $_GET["maxPrice"];
}
if (isset($_GET["size"]) && $_GET["size"] !== "") {
    $sqlQuery[] = "radgroesse >= " . $_GET["size"];
}
if (isset($_GET["elektro"]) && $_GET["elektro"] !== "") {
    if ($_GET["elektro"] === "on") {
        $_GET["elektro"] = "Ja";
    } else {
        $_GET["elektro"] = "Nein";
    }
    $sqlQuery[] = "elektro = '" . $_GET["elektro"] . "'";
}
if (isset($_GET["beleuchtung"]) && $_GET["beleuchtung"] !== "") {
    if ($_GET["beleuchtung"] === "on") {
        $_GET["beleuchtung"] = "mit";
    } else {
        $_GET["beleuchtung"] = "ohne";
    }
    $sqlQuery[] = "beleuchtung = '" . $_GET["beleuchtung"] . "'";
}
$handler = new DbHandler();

if (isset($_GET["sort"]) && $_GET["sort"] !== "") {
    $sort = $_GET["sort"];
    if ($sort === "name"){
        $sort = "bez";
    }
    $items = $handler->getSortedItems($sqlQuery, $sort);

} else {
    $items = $handler->getFilteredItems($sqlQuery);
}
echo json_encode($items);
