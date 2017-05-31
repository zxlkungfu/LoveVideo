<?php

header("content-type=text/html; charset=utf-8");

require_once 'include.php';

$username = $_POST["username"];



// returnData($video, "", "true");
$file = $_FILES;
// 判断请求中是否包含文件
if(!$file) {
    returnData("", "文件内部发生错误");
}
// 请求中文件的信息对象
$fileInfo = array();
foreach($file as $key => $value) {
    $fileInfo = $value;
}
// 获取文件信息
$fileName = $fileInfo["name"];
$fileType = $fileInfo["type"];
$fileTmpName = $fileInfo["tmp_name"];
$fileError = $fileInfo["error"];
$fileSize = $fileInfo["size"];
// 如果不存在，创建路径
$path = "uploads";
if(!file_exists($path)) {
    mkdir($path);
    chmod($path, 0777);
}
// 文件的扩展名
$ext = pathinfo($fileName, PATHINFO_EXTENSION);
// 生成唯一的文件名，并设置文件路径
$destination = $path . "/" . md5(uniqid()) . '.' . $ext;
// 文件保存是否成功
$flag = move_uploaded_file($fileInfo["tmp_name"], $destination);
// 取得完整的当前页URL
$url = 'HTTP://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
// 取得当前页的路径
$pathPrefix = dirname($url);
// 取得文件保存的路径
$url = $pathPrefix . '/' . $destination;
//echo $url;

if($flag) {
    returnData($url, "", $link, "true");
} else {
    returnData("", "异常错误", $link);
}


