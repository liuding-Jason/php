<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午2:09
 */

if(isset($_POST['a']) && isset($_POST['b'])){
    echo $_POST['a'] + $_POST['b'] ;
}else{
    echo "place input!" ;
}