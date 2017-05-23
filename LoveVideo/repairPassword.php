<?php

header("Content-Type=text/html; charset=UTF-8");
require_once 'include.php';


$username = $_POST["username"];
$password = $_POST["password"];

if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB("LoveVideo");

if(!$link) {
    returnData("", mysqli_connect_error());
}


$sql = "select * from User where username = '{$username}';";
if(!fetchData($sql, $link)) {
    returnData("", "查无此人，请检查用户名");
}

$sql = "update User set password = '{$password}' where username = '{$username}';";

if(updateData($sql, $link)) {
    $data = array("username" => $username, "password" => $password);
    returnData($data, "", "true");
} else {
    returnData("", "未知错误");
}

mysqli_close($link);