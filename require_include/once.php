<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 上午11:12
 */


/*
 * require_once 对资源进行多次引用时，只会引用一次，不会报错
 * */
require_once "./fun.php" ;
require_once "./fun.php" ;

sayHello();