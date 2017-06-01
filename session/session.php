<?php
session_start();
if(isset($_SESSION["views"])){
    if($_SESSION["views"] >= 30){
        // 销毁session变量
        unset($_SESSION["views"]) ;
    }else{
        $_SESSION["views"] += 1 ;
    }
}else{
    $_SESSION["views"] = 1 ;
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
    $time = $_SESSION["views"] ;
    echo "<h1>访问次数：$time</h1>"  ;
?>

</body>
</html>