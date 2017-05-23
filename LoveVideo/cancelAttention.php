<?php
header("Content_type=text/html; charset=UTF-8");
require_once 'include.php';

$username = $_POST["username"];
$friend = $_POST["friend"];

if($username == $friend) {
    returnData("", "无法取关自己");
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
    
    $sql = "delete from Friend where username = '{$username}' and friend = '{$friend}';";
    $result = deleteData($sql, $link);
    
    if($result) {
        $data = array("username" => $username, "friend" => $friend);
        returnData($data, "", "true");
    } else {
        returnData("", "取关失败");
    }
    
} else {
    returnData("", "不是好友关系，无法取关");
}
mysqli_close($link);


