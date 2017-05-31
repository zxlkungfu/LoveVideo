<?php

header("Content-Type=text/html; charset=UTF-8");
require_once 'include.php';


if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB();
if(!$link) {
    returnData("", mysqli_connect_error());
}

$where = $_POST["username"];
$sql = "select * from Video order by date desc limit 20";
$row = fetchMultiData($sql, $link);

$count = count($row);

$videos = array();
for($i = 0; $i < $count; $i++) {
    $videos[$i]["username"] = $row[$i][1];
    $videos[$i]["title"] = $row[$i][2];
    $videos[$i]["date"] = $row[$i][3];
    $videos[$i]["duration"] = $row[$i][4];
    $videos[$i]["url"] = $row[$i][5];
    
    $comment = array();
    $sql = "select * from Comment where url = '{$row[$i][5]}' order by date DESC;";
    $rows = fetchMultiData($sql, $link);
    $num = count($rows);
    for($j = 0; $j < $num; $j++) {
        $comment[$j]["username"] = $rows[$j][2];
        $comment[$j]["date"] = $rows[$j][3];
        $comment[$j]["content"] = $rows[$j][4];
    }
    $videos[$i]["comment"] = $comment;
    
}

if($count) {
    $output["error"] = "";
    $output["data"] = $videos;
    $output["count"] = $count;
    $output["message"] = "true";
    mysqli_close($link);
    exit(json_encode($output));
} else {
    returnData("", "当前网站没有视频", $link);
}


