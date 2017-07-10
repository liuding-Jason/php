<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/10
 * Time: 上午10:26
 */


/**

模版
 
laravel内置的模版引擎是blade，模版文件默认放在laravel根路径下resource/views目录下。

1、解析模版

1> 进入laravel根路径下，新建ViewController控制器，执行：
php artisan make:controller ViewController 

2> 修改routes.php ，新建路由匹配规则：

Route::get("/view" , 'ViewController@viewTest') ;

3> 进入laravel根路径resource/views，新建view.blade.php，输入:

<html>
<head>
	<meta charset="utf-8" />
	<title>Test View</title>
</head>
<body>
	<div>This is a view page!</div>
</body>
</html>

4> 通过浏览器访问：localhost/view

2、对模版进行层级关系之间的划分，使用view("user.index");

1> 修改routes.php，新建路由匹配规则：
Route::get("/user/index" , 'ViewController@userIndexTest') ;

2> 进入laravel根路径resource/views下，新建user文件夹，在user中新建index.blade.php，输入：

<html>
<head>
<meta charset="utf-8" />
<title>Test params</title>
</head>
<body>
<p>This is a user index page!</p>
</body>
</html>

3>  通过浏览器访问：localhost/user/index查看

3、设置模版并传递参数

1> 修改routes.php，新建路由匹配规则：
Route::get("/view/params" , 'ViewController@paramsTest') ;

2> 进入laravel根路径resource/views，新建params.blade.php，输入：

<html>
<head>
<meta charset="utf-8" />
<title>Test params</title>
</head>
<body>

</body>
</html>








 */

?>

<?php
	// ViewController
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;

	class ViewController extends Controller {
		// 测试模版跳转
		public function viewTest(){
			return view("view");
		}
		// 测试模版分级 -- 显示user路径的index模版
		public function userIndexTest(){
			return view("user.index") ;
		}

		// 测试模版传递参数
		public function paramsTest(){
			return view("params" , [name => "jack" , age => 16 , gender => 'male']);
		}

	}


?>






