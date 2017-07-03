
<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午1:58
 */


if(!isset($_GET["username"])){
    echo  "please input a name!" ;
    return ;
}

if(!isset($_GET['password'])){
    echo "password can not be empty!" ;
    return ;
}

$username = $_GET['username'] ;
$password = $_GET["password"] ;

if($username === "jack" && $password === "123"){
    echo "hello . welcome !" ;
}else{
    echo "user dose have acess!" ;
}

