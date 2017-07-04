<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/4
 * Time: 下午3:48
 */

/**
 * 预处理 + 事务 处理方式
 *
 * 事务：是对一组操作语句的统一处理，如果其中任何一个语句有问题，则整组语句都失效，
 * 可以在执行失败的语句处，进行异常捕获，并进行相关的事务回滚操作
 *
 */

try{
    $pdo = new PDO("uri:mysqlpdo.ini" , "root" , "") ;
    echo "连接成功！"  ;
}catch (PDOException $e){
    die("连接失败 " . $e->getMessage() ) ;
}

try{
    // 开启事务
    $pdo->beginTransaction() ;
    $sql = "insert into users(id , name , age) VALUES (? , ? , ?)" ;
    $stmt = $pdo->prepare($sql) ;

    /**
     * 正确的
     */
//    $stmt->execute(array(null , 'test31' , 15)) ;
//    $stmt->execute(array(null , 'test32' , 18)) ;
//    $stmt->execute(array(null , 'test33' , 23)) ;

    /**
     * 错误的
     */
    $stmt->execute(array(null , 'test31' , 15)) ;
    $stmt->execute(array(null , 'test32' , 18)) ;
    $stmt->execute(array(null , 'test33' , 23 , 18)) ;

    // 提交事务
    $pdo->commit() ;
}catch(PDOException $e){
    $pdo->rollBack();
    die("操作失败 "  . $e->getMessage()) ;
}

