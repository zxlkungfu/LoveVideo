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

$sql = "select * from User where username = '{$username}' and password = '{$password}';";

$row = fetchData($sql, $link);

if($row) {
    //  echo $row["id"];
    //  echo $row["username"];
    //  echo $row["password"];
    $data = array('username' => $row['username'], 'password' => $row['password']);
    returnData($data, '', 'true');
} else {
    
    returnData('', '查无此人');
}

mysqli_close($link);