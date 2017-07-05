<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/5
 * Time: 下午6:20
 */

include "./home/index.php" ;

/**
 * 通过use导入对应命名空间下的方法
 */
use \home\Home ;

$home = new Home() ;
$home->sayHello() ;