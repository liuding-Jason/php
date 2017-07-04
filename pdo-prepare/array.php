<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午2:58
 */

/**
 * PDO 预处理
 */
try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "") ;
    echo "连接成功！" ;
}catch (PDOException $e){
    die("连接失败 " . $e->getMessage()) ;
}

/**
 * 执行预处理
 */
$sql = "insert into users(id , name , age) VALUE (? , ? , ?)" ;
$res = $pdo->prepare($sql) ;

/**
 * 进行预处理参数绑定 -- array
 */
$res->execute(array(null , 'test2' , 16)) ;

echo $res->rowCount() ;