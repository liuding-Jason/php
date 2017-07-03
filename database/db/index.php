<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午4:16
 */

/**
 * 兼容语法
 */


//if(function_exists("mysql_connect")){
//    /**
//     * @ 忽略警告
//     *
//     */
//    $conn =  @mysql_connect("localhost" , 'root' , '') ;
//}else{
//    /*
//     * php5.5以上版本语法
//     * */
//    $conn = new mysqli("localhost" , 'root' , '') ;
//}
$conn = new mysqli("localhost" , 'root' , '') ;

if($conn){
    echo "connect success!" ;
    /**
     * 连接数据库
     *
     */
    mysqli_select_db($conn , "test") ;
    /**
     * 执行查询 -- 只查询一条数据
     */
    $result =  mysqli_query($conn , "SELECT * FROM users") ;
    $result_arr = mysqli_fetch_array($result) ;
    echo "</br>" ;
    $result_acc = mysqli_fetch_assoc($result) ;
    print_r($result_arr) ;
    echo "</br>" ;
    print_r($result_acc) ;
}else{
    echo "connect fail" ;
}