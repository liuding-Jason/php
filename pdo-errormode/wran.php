<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午2:19
 */

/**
 * PDO 异常处理  报警的方式
 */

try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "") ;
    echo "连接成功！" . "</br>" ;
    /**
     * 设置以报警的方式提示错误
     */
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_WARNING) ;
}catch(PDOException $e){
    echo "连接失败 " . $e->getMessage() ;
}

$sql = "insert into useres VALUE (null , 'jackson' , 28)" ;
$res = $pdo->exec($sql);