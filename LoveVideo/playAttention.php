<?php

header("Content-Type=text/html; charset=UTF-8");
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

$sql = "select * from Friend where username = '{$username}' and friend = '{$friend}';";

$row = fetchData($sql, $link);
if($row) {
    returnData("", "你们已经是好友了");
}

$sql = "insert into Friend (id, username, friend) values (0, '{$username}', '{$friend}');";
$result = insertData($sql, $link);
if($result) {
    
    
    $data = array("username" => $username, "friend" => $friend);
    returnData($data, "", "true");
    
} else {
    $output["error"] = "发生异常";
    exit(json_encode($output));
}

mysqli_close($link);
