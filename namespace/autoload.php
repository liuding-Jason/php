<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/5
 * Time: 下午6:50
 */

/**
 * 利用autoload魔术字符串完成类的导入和加载
 */

function __autoload($classname){
    $name = str_replace("\\" , "/" , $classname);
    $name = './' . $name . ".php" ;
    if(file_exists($name)){
        include $name ;
    }
}

$a = new namespace\Personal\Person() ;
$a->sayHello() ;