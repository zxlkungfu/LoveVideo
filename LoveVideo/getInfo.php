<?php
/**
 * Created by PhpStorm.
 * User: zhengxiaolong
 * Date: 2017/5/29
 * Time: 20:08
 */

header("content-type=text/html; charset=utf-8");
require_once 'include.php';

$username = $_POST["username"];

if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB();
if(!$link) {
    returnData("", mysqli_connect_error());
}

if(strlen($username)) {
    
    $sql = "select * from User where username = '{$username}';";
    $row = fetchData($sql, $link);
    if($row) {
        returnData($row, "", $link, "true");
        
    } else {
        returnData("", "查无此人，请核对用户名", $link);
    }
    
}