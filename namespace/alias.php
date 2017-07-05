<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/5
 * Time: 下午6:32
 */

/**
 * 使用use导入命名空间的方法
 */

include "./home/index.php" ;

use \home\Home as A ;
$home = new A() ;
$home->sayHello() ;