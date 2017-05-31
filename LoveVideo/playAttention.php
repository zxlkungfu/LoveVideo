<?php

header("Content-Type=text/html; charset=UTF-8");
require_once 'include.php';
$username = $_POST["username"];
//$password = $_POST["password"];
$friend = $_POST["friend"];


if($username == $friend) {
    returnData("", "不可关注自己");
}

if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB();
if(!$link) {
    returnData("", mysqli_connect_error());
}

$sql = "select * from User where username = '{$username}' or username = '{$friend}' limit 2;";
$row = fetchMultiData($sql, $link);
if(count($row) != 2) {
    if(!count($row)) {
        returnData("", "'{$username}'和'{$friend}'不是注册用户", $link
        );
    } else {
        returnData("", "'{$username}'或'{$friend}'不是注册用户", $link);
    }
}

$sql = "select * from Friend where username = '{$username}' and friend = '{$friend}' limit 1;";

$row = fetchData($sql, $link);
if($row) {
    returnData("", "你们已经是好友了", $link);
}

$sql = "insert into Friend (id, username, friend) values (0, '{$username}', '{$friend}');";
$result = insertData($sql, $link);
//var_dump($result);
if($result) {
    $data = array("username" => $username, "friend" => $friend);
    returnData($data, "", $link, "true");
    
} else {
    returnData("", "关注未成功，请重新尝试", $link);
}

