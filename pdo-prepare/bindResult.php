<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午3:18
 */

/**
 * PDO 预处理 -- 绑定预处理执行结果
 */

try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "");
}catch(PDOException $e){
    die("连接失败 " . $e->getMessage()) ;
}

/**
 *  执行预处理查询
 */
$sql = "select id , name , age from users" ;
$res = $pdo->prepare($sql) ;

/*
 * 执行
 * */
$res->execute() ;

/**
 * 遍历查询结果
 */
//foreach ($res as $val) {
//    echo $val['id'] . " " . $val['name'] . " " . $val['age'] . "</br>" ;
//}


/**
 * 绑定结果 -- 真正要用的方式（重点）
 */
$res->bindColumn(1 , $id) ;
$res->bindColumn("name" , $name) ;
$res->bindColumn("age" , $age);

while($row = $res->fetch(PDO::FETCH_COLUMN)){
    echo "{$id} : {$name} : {$age}" ."</br>" ;
}

