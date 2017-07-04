<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午12:04
 */

/**
 * PDO 异常处理 -- 默认方式 errorCode() errorInfo()
 */

try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "") ;
    echo "连接成功！";
}catch (PDOException $e){
    echo "连接失败 " . $e->getMessage() ;
}

$sql = "insert into useres VALUES (null , 'lisa' , 28)" ;
$res = $pdo->exec($sql) ;
if($res){
    echo "插入成功！" ;
}else{
    echo $pdo->errorCode() ;
    // 返回数组
    print_r($pdo->errorInfo()) ;
}


