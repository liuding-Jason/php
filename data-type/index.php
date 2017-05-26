<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/5/26
 * Time: 下午2:39
 */

/*
 * 字符串
 * */
$str = "a string varibal" ;
var_dump($str) ;
echo "</br>" ;

/*
 * 整数
 * */
$intV = 100 ;
var_dump($intV) ;
echo "</br>" ;

/*
 * 浮点型
 * */
$floatV = 10.235 ;
var_dump($floatV) ;
echo "</br>" ;

/*
 * 布尔类型
 * */

$boolV = true ;
var_dump($boolV) ;
echo "</br>" ;

/*
 * 数组
 * */
$arrV = array([1 , "test" , 12.65]) ;
var_dump($arrV) ;
echo "</br>" ;

/*
 * 对象
 * */

class Person {
    private  $name , $age ;
    public static function showName (){
        echo self::name ;
    }

    public static function showAge(){
        echo self::age ;
    }
}
$person = new Person() ;
var_dump($person) ;
echo "</br>" ;

/*
 * NULL类型
 * */

$nullV = null ;
var_dump($nullV) ;