<?php
/**
 * Created by PhpStorm.
 * User: zhengxiaolong
 * Date: 2017/5/29
 * Time: 19:42
 */

header("content-type=text/html; charset=utf-8");
require_once 'include.php';

$imgURL = $_POST["imgURL"];

$path = "headerImage";
if(!file_exists($path)) {
    mkdir($path, 0777);
    chmod($path, 0777);
}

$ext = pathinfo($imgURL, PATHINFO_EXTENSION);
$destination = $path . '/' . md5(uniqid()) . '.' . $ext;
$flag = copy($imgURL, $destination);

$url = 'HTTP://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
// 取得当前页的路径
$pathPrefix = dirname($url);
// 取得文件保存的路径
$url = $pathPrefix . '/' . $destination;
//echo $url;

$username = $_POST["username"];

if($flag) {
    // 写入User表格
    $link = connectDB("LoveVideo");
    if(!$link) {
        returnData("", "数据库服务器错误");
    }
    
    $sql = "update User set headerURL = '{$url}' where username = '{$username}'";
    
    if(!updateData($sql, $link)) {
        
        returnData("", "数据库服务器错误", $link);
    }
    
    returnData($url, "", $link, "true");
    
    
} else {
    
    returnData("", error_get_last(), $link);
}
