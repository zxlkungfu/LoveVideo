<?php

header('Content-Type=text/html; charset=UTF-8');

require_once 'include.php';


$username = $_POST['username'];
$password = $_POST['password'];


if(!connectSQLSever()) {
    returnData('', mysqli_connect_error());
}

$link = connectDB();
if(!$link) {
    returnData('', mysqli_connect_error());
}

$sql = "select * from User where username = '{$username}' limit 1;";
$row = fetchData($sql, $link);
if(!$row) {
    returnData("", "当前用户还没有注册");
}

$sql = "select * from User where username = '{$username}' and password = '{$password}';";

$row = fetchData($sql, $link);

if($row) {
    //  echo $row["id"];
    //  echo $row["username"];
    //  echo $row["password"];
    //    $data = array('username' => $row['username'], 'password' => $row['password']);
    returnData($row, '', $link, 'true');
} else {
    
    returnData('', '密码错误', $link);
}

