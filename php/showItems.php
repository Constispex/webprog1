<?php
//require "Result.php";
require "DbHandler.php";
$ok = true;

$sqlQuery = array();
if (isset($_GET["title"]) && $_GET["title"] !== "") {
    $str = "title LIKE '%" . $_GET["title"] . "%'";
    $sqlQuery[] = $str;
}
if (isset($_GET["author"]) && $_GET["author"] !== "") {
    $str = "author LIKE '%" . $_GET["author"] . "%'";
    $sqlQuery[] = $str;
}
if (isset($_GET["publisher"]) && $_GET["publisher"] !== "") {
    $str = "publisher LIKE '%" . $_GET["publisher"] . "%'";
    $sqlQuery[] = $str;
}
if (isset($_GET["subareas"]) && $_GET["subareas"] !== "") {
    $str = "subareas LIKE '%" . $_GET["subareas"] . "%'";
    $sqlQuery[] = $str;
}
if (isset($_GET["rating"]) && $_GET["rating"] !== "") {
    $str = "rating >= " . $_GET["rating"];
    $sqlQuery[] = $str;
}
$handler = new DbHandler();


if (isset($_GET["sort"]) && $_GET["sort"] !== "") {
    $sort = $_GET["sort"];
    if ($sort === "name") $sort = "title";
    $items = $handler->getSortedItems($sqlQuery, $sort);

} else {
    $items = $handler->getItems($sqlQuery);
}


echo json_encode($items);
