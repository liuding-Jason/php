<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午2:24
 */

/**
 * PDO 异常处理方式
 */

try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "") ;
    echo "连接成功！" ;

    /**
     * 设置错误异常的方式
     */
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "连接失败 " . $e->getMessage() ;
}

$sql = "insert into useres VALUE (null , 'tom' , 16 )" ;
try{
    $res = $pdo->exec($sql) ;
}catch(PDOException $e){
    echo "插入失败 " . $e->getMessage() ;
}
