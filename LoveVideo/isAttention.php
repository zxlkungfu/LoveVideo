<?php
/**
 * Created by PhpStorm.
 * User: zhengxiaolong
 * Date: 2017/6/6
 * Time: 14:01
 */
header("content-type=text/html; charset=utf-8");
require_once 'include.php';

$username = $_POST['username'];
$currentName = $_POST['currentName'];

if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB();
if($link) {
    $sql = "select * from Friend where username = '{$username}' and friend = '{$currentName}';";
    $row = fetchData($sql, $link);
    if($row) {
        returnData("已经关注", "", $link, "true");
    } else {
        returnData("没有关注", "", $link);
    }
} else {
    returnData("", mysqli_connect_error());
}