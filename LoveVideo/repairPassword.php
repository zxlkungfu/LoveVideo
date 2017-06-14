<?php

header("Content-Type=text/html; charset=UTF-8");
require_once 'include.php';


$username = $_POST["username"];
$password = $_POST["password"];
$verify = $_POST['verify'];

if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB("LoveVideo");

if(!$link) {
    returnData("", mysqli_connect_error());
}

$sql = "select * from User where username = '{$username}';";
$row = fetchData($sql, $link);
if(!$row) {
    returnData("", "服务器错误");
}

if($row["verify"] != $verify) {
    returnData("", "请输入验证信息");
}


$sql = "update User set password = '{$password}' where username = '{$username}' and verify = '{$verify}';";
if(!$verify) {
    $sql = "update User set password = '{$password}' where username = '{$username}';";
}

if(updateData($sql, $link)) {
    $data = array("username" => $username, "password" => $password);
    returnData($data, "", $link, "true");
} else {
    returnData("", "服务器错误", $link);
}
