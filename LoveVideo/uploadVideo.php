<?php
/**
 * Created by PhpStorm.
 * User: zhengxiaolong
 * Date: 2017/5/30
 * Time: 17:05
 */

header("content-type=text/html; charset=utf-8");
require_once 'include.php';

$video = $_POST["video"]; // title、date 、duration
$username = $_POST['username'];
$title = $video[0]["title"];
$date = $video[1]["date"];
$duration = $video[2]["duration"];
$url = $video[3]["url"];
$imgURL = $video[4]["imgURinsertData($sql, $link)L"];

if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB();

if(!$link) {
    returnData("", mysqli_connect_error());
} else {
    $sql = "insert into Video (id, username, title, date, duration, url, imgURL) VALUES (0, '{$username}', '{$title}', '{$date}', '{$duration}', '{$url}', '{$imgURL}');";
    
    if(insertData($sql, $link)) {
        $sql = "select * from Video where username = '{$username}';";
        $row = fetchData($sql, $link);
        returnData($row, "", $link, "true");
    } else {
        returnData("", "异常错误", $link);
    }
}