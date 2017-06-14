<?php
/**
 * Created by PhpStorm.
 * User: zhengxiaolong
 * Date: 2017/6/10
 * Time: 14:35
 */

header("content-type=text/html; charset=utf-8");
require_once 'include.php';

$url = $_POST['url'];
$username = $_POST['username'];
$date = $_POST['date'];
$content = $_POST['content'];
$headerURL = $_POST['headerURL'];
// 通过当前用户名，获取头像
if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB();
if(!$link) {
    returnData("", mysqli_connect_error());
} else {
    
    $sql = "insert into Comment (id, url, username, date, content, headerURL) values(0, '{$url}', '{$username}', '{$date}', '{$content}', '{$headerURL}');";
    if(insertData($sql, $link)) {
        returnData("", "", $link, "true");
    } else {
        returnData("", mysqli_connect_error(), $link);
    }
}

