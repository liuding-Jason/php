<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/5/26
 * Time: 下午2:56
 */

$str = "test string API string" ;

/*
 * strlen([字符串]) 显示字符串的长度
 *
 * */

echo strlen($str) . "</br>" ;


/*
 * 显示 测试字符串  在 字符串 中的文字
 * strpos([字符串] , [测试字符串])
 * （只匹配第一个 , 匹配不存在的字符返回false）
 * */

echo strpos($str , "string") ;
var_dump(strpos($str , "abc"))   ;