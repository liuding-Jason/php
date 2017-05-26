<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/5/26
 * Time: 下午2:51
 */

/*
 * 常量
 * 1. 常量是全局变量
 * 2. [ 常量名 ， 常量值 ， 是否大小写敏感 ]
 * */
define("PI" , 3.1415 , true) ;
echo PI . "</br>" ;

function circleSquare($r){
   return PI * pow($r , 2) ;
}

echo circleSquare(15) ;



