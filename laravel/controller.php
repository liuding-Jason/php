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
]) ;
// 方式二
Route::get("/user/jinyong/{id}" , 'TestController@jinyong')->middleware('login') ;

5、隐式控制器

1> 创建GoodsController控制器
php artisan make:controller GoodsController --plain

2> 修改GoodsController.php代码

3> 修改routes.php，新建路由匹配规则
// 表示路由中以goods开头的所有请求，都会交给GoodsController处理，
// 例如：localhost/goods/add , localhost/goods/del
Route::controller("goods" , "GoodsController") ;

注意：要在对应的控制器方法名前面加上请求的方式(加粗)
例如：使用get方式请求goods/add的方式，那么控制器中对应的方法应该是用驼峰的方式写成getAdd：
class GoodsController extends Controller {
	public function getAdd(){
		return view("add") ;
	}
}

4> 新建add.blade.php模版文件，输入：
<form action="/goods/add" method="post">
	用户名： <input type="text" name="username" palceholder="username" />
	</br>
	{{csrf_filed()}}
	<input type="submit" value="submit" />
</from>


6、Restful控制器 -- 匹配固定7种方式的路由规则

1> 创建PhotosController
php artisan make:controller PhotosController

2> 修改routes.php，新建路由匹配规则

// 通过Route::resource()建立Restful控制器
Route::resource("photos" , "PhotosController") ;

3> 修改PhotosController.php文件




?>

<?php
	// TestController.php
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;
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
		public function jinyong($id){
			return "This is jinyong page!user's id is " . $id ;
		}
	}
?>

<?php
	// GoodsController.php
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;
	class GoodsController extends Controller
	{	
		// 商品添加 -- 传递视图
		public function getAdd(){
			// 在laravel中，可以使用return的方式，向客户端返回内容
			return view("add") ;
		}

		// 商品添加 -- 传递参数
		public function postAdd(){
			return "This is a postAdd page!" ;
		}
	}
?>



<?php
	
	// PhotosController.php
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;
	class PhotosController extends Controller {

		// get /photos http/1.1
		public function index(){

		}

		// get /photos/create http/1.1
		public function create(){

		}

		// post /photos http/1.1
		public function store(){

		}

		// get /photos/{id} http/1.1
		public function show($id){

		}

		//get /photos/{id}/edit http/1.1
		public function edit($id){

		}

		// put/patch /photos/{id} http/1.1
		public function update($id){

		}

		// delete /photos/{id} http/1.1
		public function destory($id){

		}

	}


?>


 */









