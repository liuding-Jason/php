<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/6
 * Time: 下午7:55
 */

/**
控制器
1、创建控制器
使用命令行模式，切换到laravel根路径下，执行：
php artisan make:controller TestController
这个创建好的controller放在，laravel根路径下App/Http/Controller/下

创建干净控制器，执行：
php artisan make:controller UserController --plain

2、结合路由设置控制器

// routes.php
// 当用户请求服务器的test路径时，服务器会执行TestController中的show方法
Route::get("/test" , 'TestController@show');

3、带参数的路由使用控制器

// routes.php
Route::get("/user/edit/{id}" , 'TestController@edit');

4、带参数的路由配合中间件使用控制器

// routes.php
Route::get("/user/shengji/{id}" , [
	"middleware" => "login" ,
	"uses" => 'TestController@shengji'
]);


*/

?>

<?php
	
	// TestController.php

	namespace App\Http\Controller ;

	use Illuminate\Http\Request ;

	use App\Http\Request ;
	use App\Http\Controllers\Controller ;

	/**
	* 
	*/
	class TestController extends Controller
	{
		public function show(){
			// 在laravel中，可以使用return的方式，向客户端返回内容
			return "This is test page!" ;
		}
		
		public function edit($id){
			return "This is edit page!user's id is " . $id ;
		}

		public function shengji($id){
			return "This is shengji page!user's id is " . $id ;
		}

	}

?>

