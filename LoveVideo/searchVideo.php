<?php

header("Content-Type=text/html; charset=UTF-8");
require_once 'include.php';


if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB("LoveVideo");

if(!$link) {
    returnData("", mysqli_connect_error());
}

$where = $_POST["where"];
$sql = "select * from Video where username like '%{$where}%' or title like '%{$where}%' order by date desc;";

$row = fetchMultiData($sql, $link);
$count = count($row);
$videos = array();

for($i = 0; $i < $count; $i++) {
    $videos[$i]["username"] = $row[$i][1];
    $videos[$i]["title"] = $row[$i][2];
    $videos[$i]["date"] = $row[$i][3];
    $videos[$i]["duration"] = $row[$i][4];
    $videos[$i]["url"] = $row[$i][5];
    $videos[$i]["imgURL"] = $row[$i][6];
}

if($count) {
    $output["data"] = $videos;
    $output["count"] = $count;
    $output["message"] = "true";
    mysqli_close($link);
    exit(json_encode($output));
} else {
    returnData("", "没有相关", $link);
}


	
