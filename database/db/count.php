<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午8:50
 */


$conn = mysqli_connect("localhost" , "root" , "") ;

if(!$conn){
    throw  new Exception("Connect fail") ;
}

/**
 * 获取数据条数 （高效的方式）
 * $len[0] 存储数据条数
 */
mysqli_select_db($conn , "test") ;
$result = mysqli_query($conn , "SELECT COUNT(*) FROM users") ;
if($result){
    $len = mysqli_fetch_array($result) ;
    echo "数据的条数是：" . $len[0] ;
}else{
    echo "查询失败！" ;
}

