<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午3:46
 */

/**
 * 利用session在多个页面之间传值
 */

session_start() ;
$_SESSION["name"] = "jack" ;

header("Location:b.php") ;