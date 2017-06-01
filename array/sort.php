<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/6/1
 * Time: 下午2:12
 */

/*
 * 数组排序
 * 1 PHP数组排序操作，会影响原来的数组
 * */

// 升序排
$arr = array( 1 , 5 , 3 , 4 , 10) ;
sort($arr);
var_dump($arr);
echo "</br>" ;

// 降序排
$arrT = array("jack" , "tom", "aoo" , "lose" ) ;
rsort($arrT);
var_dump($arrT) ;
echo "</br>" ;


/*
 * 键名
 * */
// 键名升序排
$arrS = array(
    "a" => 15 ,
    "c" => 26 ,
    "b" => 24
) ;
ksort($arrS);
var_dump($arrS);
echo "</br>" ;

// 键名降序排序
krsort($arrS) ;
var_dump($arrS) ;
echo "</br>" ;

/*
 * 值
 * */

// 值升序排
asort($arrS);
var_dump($arrS) ;
echo "</br>" ;

// 值降序排
arsort($arrS) ;
var_dump($arrS) ;
echo "</br>" ;
