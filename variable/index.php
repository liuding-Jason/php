<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/5/26
 * Time: 下午1:46
 */


/*
 * 全局作用域
 * 1. 在最外层定义的变量
 * */
$a = 10 ;
$b = 20 ;
$z = $a + $b ;

echo "The result is $z </br>" ;

/*
 * 局部作用域
 * 1. 定义在函数内部的变量
 * */
//function test (){
//    $t = "temp variable" ;
//    echo "$t" . "</br>" ;
//}
//test() ;
//echo  "尝试访问函数局部变量 $t" ; // 报错

// 在函数内部通过global访问全局变量
function testGlobal(){
    global $a  ;
    echo "a" . "<br/>" ;
}
testGlobal() ;



/*
 *  通过static 关键字定义的局部变量在函数执行结束后，不会释放
 * */
function showCount(){
    static $count = 1 ;
    echo  "The count is $count </br>" ;
}
showCount() ;
showCount() ;
showCount() ;

