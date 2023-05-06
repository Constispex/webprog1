<?php
//require "Result.php";
$ok = true;


/*if (isset($_GET["title"]) && $_GET["title"] !== "") {
    $str = "title LIKE '%" . $_GET["title"] . "%'";
    array_push($filters, $str);
}
if (isset($_GET["author"]) && $_GET["author"] !== "") {
    $str = "author LIKE '%" . $_GET["author"] . "%'";
    array_push($filters, $str);
}
if (isset($_GET["publisher"]) && $_GET["publisher"] !== "") {
    $str = "publisher LIKE '%" . $_GET["publisher"] . "%'";
    array_push($filters, $str);
}
if (isset($_GET["rating"]) && $_GET["rating"] !== "") {
    $str = "rating = " . $_GET["rating"];
    array_push($filters, $str);
}
if (isset($_GET["subareas"]) && $_GET["subareas"] !== "") {
    $str = "subareas LIKE '%" . $_GET["subareas"] . "%'";
    array_push($filters, $str);
}*/


$title = $_GET["title"] ?? "no title";
$s = json_encode($title);
if ($s === false) {
    $ok = false;
    echo "json_encode failed";
} else {
    echo $s;
}
