<?php
/**
 * Created by PhpStorm.
 * User: zhengxiaolong
 * Date: 2017/6/7
 * Time: 15:53
 */

header("content-type=text/html; charset=utf-8");
require_once 'include.php';

$username = $_POST['username'];
$verify = $_POST['verify'];

if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB();
if($link) {
    $sql = "update User set verify = '{$verify}' where username = '{$username}';";
    $result = updateData($sql, $link);
    if($result) {
        returnData("设置验证信息成功", "", $link, "true");
    } else {
        returnData("设置验证信息失败", "", $link);
    }
} else {
    returnData("", mysqli_connect_error());
}