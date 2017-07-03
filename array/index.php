<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/5/31
 * Time: 上午10:46
 */

/*
 * 数值数组 -- key有序的自然数(ID)
 * 1 php的数组可以存放任意的元素
 * */

$myArr = array("hello" , 1 , "world") ;
echo $myArr[0] . $myArr[2] . "</br>" ;

$len = count($myArr) ;
for($i = 0 ; $i < $len ; $i++){
    echo $myArr[$i] . "</br>" ;
}


/*
 * 关联数组 -- key为主动分配的键名
 * */

$myConArr = array(
    "Tom" => 15 ,
    "Jack" => 18 ,
    "Rose" => 25
) ;

echo $myConArr["Tom"] . "</br>" ;

foreach ($myConArr as $key => $value){
    echo "name = " . $key . "; age = " . $value . "</br>" ;
}