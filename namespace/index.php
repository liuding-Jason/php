<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/5
 * Time: 下午6:02
 */

/**
 * 命名空间是PHP中防止相同名称的类和方法等等元素冲突的一种解决方案
 * 命名空间分为 绝对命名空间  和  相对命名空间
 * 默认是全局命名空间
 */

include "./home/index.php" ;
include "./users/index.php" ;
/**
 * 使用绝对命名空间
 */
$home = new namespace\home\Home() ;
$home->sayHello() ;

$user = new namespace\users\Users() ;
$user->sayHello() ;
