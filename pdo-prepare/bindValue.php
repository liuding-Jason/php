<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午2:36
 */

/*
 * 连接数据库
 */

try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" ,"") ;
    echo "连接成功！" ;
}catch(PDOException $e){
    die("数据库连接失败 " . $e->getMessage()) ;
}

/**
 * 预处理语句
 */
$sql = "insert into users(id , name , age) VALUE (? , ? , ?)" ;
$res = $pdo->prepare($sql) ;

/**
 * 绑定参数 -- bindValue
 */
$res->bindValue(1 , null);
$res->bindValue(2 , 'test');
$res->bindValue(3 , 13);

/**
 * 执行
 */
$res->execute() ;

echo $res->rowCount() ;