<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午2:50
 */

/**
 * 连接数据库
 */
try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "") ;
    echo "连接成功！" ;
}catch(PDOException $e){
    die("数据库连接失败 " . $e->getMessage()) ;
}

$sql = "insert into users(id , name , age) VALUE (? , ? , ?) " ;
$res = $pdo->prepare($sql) ;

/**
 * bindParam
 */
$res->bindParam(1 , $id) ;
$res->bindParam(2 , $name) ;
$res->bindParam(3 , $age) ;

$id = null ;
$name = 'test1';
$age = 16 ;

/**
 * 执行查询
 */
$res->execute() ;

echo $res->rowCount() ;