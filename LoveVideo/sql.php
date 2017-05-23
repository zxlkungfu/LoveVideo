<?php

/*
 * 链接MYSQL服务器，并返回代表服务器的一个值
 */
require_once 'configs.php';

function connectSQLSever()
{
    $link = mysqli_connect(constant("DB_HOST"), constant("DB_USERNAME"), constant("DB_PASSWORD"));
    
    return $link;
}

/*
 * 创建一个数据库
 * $sql = "create database DBName"
 */
function createDB($sql)
{
    $link = connectSQLSever();
    
    return mysqli_query($link, $sql);
}

/*
 * 链接一个数据库, 参数是数据库名称
 */
function connectDB($dbName = "LoveVideo")
{
    $link = mysqli_connect(constant("DB_HOST"), constant("DB_USERNAME"), constant("DB_PASSWORD"), $dbName, constant("DB_PORT"));
    
    return $link;
}

/*
 * 创建一个表,参数是连接到数据库的值，创建爱你表的sql语句
 * $sql = "create table tableName (key type)";
 */
function createTable($sql, $link)
{
    return mysqli_query($link, $sql);
}

/*
 * 插入一条数据
 * $sql = "insert into tableName (key,...) values (value,...)";
 */

function insertData($sql, $link)
{
    return mysqli_query($link, $sql);
}

/*
 * 插入一组数据
 */
function insertMultiData($sql, $link)
{
    return mysqli_multi_query($link, $sql);
}

/*
 * 更新一条数据
 */
function updateData($sql, $link)
{
    return mysqli_query($link, $sql);
}

/*
 * 删除一条数据
 */
function deleteData($sql, $link)
{
    return mysqli_query($link, $sql);
}

/*
 * 查询一条数据
 */
function fetchData($sql, $link)
{
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    
    return $row;
}

/*
 * 查询一组数据
 */
function fetchMultiData($sql, $link)
{
    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_all($result);
    
    return $rows;
}

/*
 * 关闭数据库连接
 */
function closeDB($link)
{
    return mysqli_close($link);
}

