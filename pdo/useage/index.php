<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 上午11:09
 */

/**
 * 1、连接数据库
 */
try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" ,"") ;
}catch (PDOException $e){
    die("数据库连接失败" . $e->getMessage()) ;
}

echo "数据库连接成功！" . "</br>" ;

/**
 * 2、执行查询语句 ，返回一个预处理对象
 */
$sql = "select * from users" ;
$stmt = $pdo->query($sql) ;
$list = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
//print_r($list) ;

/**
 * 3、解析数据
 */
foreach ($list as $val){
    echo $val['id'] . " " . $val['name'] . " " . $val['age'] . "</br>" ;
}

/**
 * 4、释放资源
 */
$stmt = null ;
$pdo = null ;


