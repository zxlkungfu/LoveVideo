<?php
// 返回json数据的方法：exit(json_encode(对象));
// 语法错误会导致无法运行

header("Content-Type=text/html; charset=UTF-8");
require_once 'include.php';


if(!connectSQLSever()) {
    returnData("", mysqli_connect_error());
}

$link = connectDB("LoveVideo");
if(!$link) {
    returnData("", mysqli_connect_error());
}

$username = $_POST["username"];
$password = $_POST["password"];
$sql = "select * from User where username = '{$username}';";

$row = fetchData($sql, $link);
if($row) {
    returnData("", "当前用户名已经被注册，请重新选择");
}

$sql = "insert into User (id, username, password, headerURL) values (0, '{$username}', '{$password}', '');";

if(insertData($sql, $link)) {
    $data = array("username" => $username, "password" => $password);
    returnData($data, "", "true");
} else {
    returnData("", "未知错误");
}

mysqli_close($link);