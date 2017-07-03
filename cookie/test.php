<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午3:43
 */

setcookie("name" , "jack") ;
setcookie("age" , 16) ;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Test </title>
</head>
<body>
    <script>
        alert(document.cookie);
    </script>
</body>
</html>

