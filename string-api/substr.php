<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 上午10:54
 */


/*
 * 字符串分割
 *
 * */

$str = "Hello , this is jack!";
/*
 * 截取从第2个开始的连续五个字符
 * */
$str_sub = substr($str , 2 , 5) ;
echo $str_sub . "</br>" ;

echo "==============================" . "</br>" ;
/*
 * 按长度为2的标准，分割字符串
 * 返回一个数组
 * */
$str_split = str_split($str , 2) ;
var_dump($str_split) ;
echo "</br>" ;
echo "==============================" . "</br>" ;


/*
 * 以指定格式分割字符串 explode
 * */
$language = "Java C++ Php Python JavaScript" ;
$str_explode = explode(" " , $language) ;
var_dump($str_explode) ;
