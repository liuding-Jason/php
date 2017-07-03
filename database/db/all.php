<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午8:26
 */


$conn = new mysqli("localhost" , "root" , "") ;

if(!$conn){
    throw new Exception("Connect faild!");
}else{
    mysqli_select_db($conn , "test") ;
    $result =  mysqli_query($conn , "SELECT * FROM users") ;
    $len = mysqli_num_rows($result) ;
    for($i = 0 ; $i < $len ; $i++){
        print_r(mysqli_fetch_assoc($result)) ;
    }

    echo "</br>" ;

    /**
     * 选择部分字段
     */
    $result_some = mysqli_query($conn , "SELECT id , name FROM users") ;
    $len = mysqli_num_rows($result_some) ;

    for($j = 0 ; $j < $len ; $j++){
        print_r(mysqli_fetch_array($result_some)) ;
    }

}

