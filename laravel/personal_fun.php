<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/11
 * Time: 下午5:22
 */


/**
 * 
自定义函数和自定义类

1、通过配置composer文件，可以实现自定义函数和自定义类的自动加载

1> 进入laravel根路径下，app文件夹下，新建Commone文件夹，在Common中新建index.php文件

2> 进入laravel根路径下，修改composer.json，在autoload配置项中添加：
autoload:{
	"classmap": [
        "database"
    ],
    "psr-4": {
        "App\\": "app/"
    },
	"files" : [
		"app/Common/function.php" ,
	]	
}

3> 执行
composer dump-auto 
命令，完成autoload文件的重新生成

4> 在文件中直接使用自定义函数和自定义类即可


 */