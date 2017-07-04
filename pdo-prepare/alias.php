<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午3:08
 */

/**
 * PDO 预处理  --- 别名的方式
 *
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
$sql = "insert into users(id , name , age) VALUES (:id , :name , :age)" ;
$res = $pdo->prepare($sql) ;

/**
 * 参数绑定方式1
 */
//$res->bindValue("id" , null) ;
//$res->bindValue("name" , 'test11') ;
//$res->bindValue("age" , 17) ;

/**
 * 参数绑定方式2
 */

//$id = null ;
//$name = "test12" ;
//$age = 15 ;
//$res->bindParam("id" , $id);
//$res->bindParam("name" , $name);
//$res->bindParam("age" , $age) ;


/**
 * 参数绑定方式3
 */

/**
 * 执行插入操作
 */
$res->execute(array(
    "id" => null ,
    "name" => "test13" ,
    "age" => 18
)) ;

echo $res->rowCount() ;