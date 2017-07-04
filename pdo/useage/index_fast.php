<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 上午11:37
 */


/**
 * 1、连接数据库
 */
try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "") ;
    echo "连接成功！" ;
}catch(PDOException $e){
    echo "连接失败：" .$e->getMessage() ;
}

/**
 * 2、执行查询  快速的方式
 */
//
//$sql = "select * from users" ;
//foreach($pdo->query($sql) as $val){
//    echo $pdo['id'] . " " . $val['name'] . " " . $val['age'] . "</br>" ;
//}


/**
 * 插入语句
 */

$sql = "insert into users VALUES (null , 'jason' , 26)" ;
$res = $pdo->exec($sql) ;
if($res){
    echo "插入成功！" ;
}

/**
 * 删除语句
 */
$sql_del = "delete from users where id=1" ;
$res_del = $pdo->exec($sql_del) ;
if($res_del){
    echo "删除成功！" ;
}


/*
 * 修改语句
 * */
$sql_fix = "update users set name='roses' where id=2" ;
$res_fix = $pdo->exec($sql_fix) ;
if($res_fix){
    echo "修改成功！" ;
}
