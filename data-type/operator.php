<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/5/26
 * Time: 下午3:26
 */


/*
 * 算数运算符符号
 * */

$a = 1 ;
$b = 10 ;
function add($a , $b){
    return $a + $b ;
}

function red($a , $b){
    return $b - $a ;
}

function mul($a , $b){
    return $a * $b ;
}

function dev($a , $b){
    return $a / $b ;
}
$add = $a + $b ;
$red = $b - $a ;
$mul = $a * $b ;
$dev = $b / $a ;

echo add(1 , "hello") ; // 返回1
var_dump(add("hello" , 1))  ; //返回1

/*
 * 逻辑运算符号
 * */
echo $a < $b ;
echo $a > $b ;
echo $a >= $b ;
echo $a <= $b ;
echo $a == $b ;  // 相等
echo $a === $b ; // 恒等
echo $a != $b ;  // 不想等
echo $a <> $b ;  // 不想等
echo $a !== $b ; // 不恒等

/*
 * 赋值运算符
 * */

$b += $a ; // $b = $b + $a ;
$a -= $b ;
$b *= $a ;

/*
 * 递增／递减运算符
 * */
$a++ ;
$b-- ;
++$a ;
--$b ;










