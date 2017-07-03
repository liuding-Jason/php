<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Test File Upload</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午2:35
 */
$file = $_FILES['file'] ;
$filename = $file['name'] ;
move_uploaded_file($file['tmp_name'] , $filename) ;
echo "<img src='$filename' />" ;
?>

</body>
</html>