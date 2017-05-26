
<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/5/26
 * Time: 下午2:12
 */

/*
 * 简单的显示计数器
 * */
$count = 0 ;

function showCount(){
    global $count ;
    echo "<h1>简单的计数器程序</h1>"
        ."<span>当前计数：</span>"
        ."<h5>$count</h5>"
        ."<button onclick='add()'>增加计数</button>"
        ."<button onclick='red()'>减少计数</button>" ;
}

function add(){
    global $count ;
    $count++ ;
    showCount() ;
}

function red(){
    global $count ;
    $count-- ;
    showCount();
}

showCount() ;

?>


</body>
</html>


