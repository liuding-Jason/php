<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午9:26
 */

/*
 * PDO 初始化连接
 * */

try{
    /*
     * 1、通过直接写在连接处
     * */
    // $pdo = new PDO("mysql:host=localhost;dbname=test" , "root" , "") ;

    /*
     * 2、通过本地配置文件
     */
    $pdo = new PDO("uri:mysqlPdo.ini" , "root" , "") ;

    /*
     * 3、通过php.ini全局配置文件加配置
     *  */
    //$pdo = new PDO("mysqlpdo" , "root" , "");

    print_r($pdo) ;
    echo "</br>" ;

}catch(PDOException $e){
    die("数据库连接失败" .$e->getMessage()) ;
}

/**
 * 通过PDO获取相关的参数
 */

echo "客户端版本是：" . $pdo->getAttribute(PDO::ATTR_CLIENT_VERSION) . "</br>" ;
echo "服务器版本是：" . $pdo->getAttribute(PDO::ATTR_SERVER_INFO) . "</br>" ;

/**
 * 自动提交
 */
echo "自动提交配置：" . $pdo->getAttribute(PDO::ATTR_AUTOCOMMIT) ;
// 取消自动提交
//$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT , 0) ;


