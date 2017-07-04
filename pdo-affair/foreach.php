<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午4:04
 */

/**
 * 事务处理过程 - foreach遍历
 */
try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "") ;
    echo "连接成功！" ;
}catch(PDOException $e){
    die("连接失败 " . $e->getMessage() );
}

// 开启事务
$pdo->beginTransaction() ;
$sql = "insert into users(id , name , age) VALUES (? , ? , ?)" ;
$stmt = $pdo->prepare($sql) ;

$datalist = array(
    array(null , "test41" , 12) ,
    array(null , "test42" , 15) ,
    array(null , "test43" , 19)
) ;

$isCommit = true ;
foreach ($datalist as $item){
    $stmt->execute($item) ;
    if($stmt->errorCode() > 0){
        $pdo->rollBack() ;
        $isCommit = false ;
    }
}

if($isCommit){
    $pdo->commit() ;
    echo "操作成功！" ;
}
