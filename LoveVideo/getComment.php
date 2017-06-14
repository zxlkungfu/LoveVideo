<?php
/**
 * Created by PhpStorm.
 * User: zhengxiaolong
 * Date: 2017/6/6
 * Time: 13:35
 */

header("content-type=text/html; charset=utf-8");
require_once 'include.php';

$url = $_POST["url"];
if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB();
if($link) {
    $sql = "select * from Comment where url = '{$url}' order by date;";
    $rows = fetchMultiData($sql, $link);
    $count = count($rows);
    $comment = array();
    if($count) {
        for($i = 0; $i < $count; $i++) {
            $comment[$i]["username"] = $rows[$i][2];
            $comment[$i]["date"] = $rows[$i][3];
            $comment[$i]["content"] = $rows[$i][4];
            $comment[$i]["headerURL"] = $rows[$i][5];
        }
        returnData($comment, "", $link, "true");
    } else {
        returnData($comment, "还没有用户发表评论");
    }
} else {
    returnData("", mysqli_connect_error());
}