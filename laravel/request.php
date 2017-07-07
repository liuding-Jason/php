<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/7
 * Time: 上午11:55
 */

/**
 * 请求  -- 请求中的$request对象
 
 请求 - http请求中的相关信息，被封装在了$request对象中
 1、$request对象的基本信息

 1> 新建TestController控制器
 php artisan make:controller TestController 

 2> 新建路由匹配规则，修改routes.php
 
 Route::get("/test/info" , 'TestController@info');

 // 获取请求的ip信息
 $request->ip();

 // 获取请求的method信息
 $request->method() ;

 // 检测请求方法是否为get
 $request->isMethod("get") ;
 
 // 获取请求的path信息
 $request->path() ;
 
 // 获取请求的url信息
 $request->url() ;

 // 获取请求的端口信息
 $request->getPort() ;



 2、请求参数的获取 - get

 1> 新建路由匹配规则，
 Route::get("/test/list" , 'TestController@list' )

 2> get请求 http://localhost/test/list?username=123&password=123'
 在控制器对应的方法中，使用$request->input("username") 获取参数
 

 3、请求参数的匹配 - post
 在控制器对应的方法中，使用$request->input("username") 获取参数

 1> 新建路由匹配规则，
 Route::get("/test/form" , 'TestController@form') ;
 Route::post("/test/insert" , 'TestController@insert') ;
 
 2> 新建form.blade.php， 输入：
 <html>
	<head>
		<meta charset="utf-8" />
		<title>Form</title>
	</head>
	<body>
		<form action="/test/insert" method="post">
			<input type="text" name="username" placeholder="username" />
			<input type="password" name="password" placeholder="password" />
			{{csrf_field()}}
		</from>
	</body>
 </html>
	
 4、为参数设置默认值，如果客户端发送请求时，并没有携带对应的参数，使用$request->input()的方式，将获取到null，为了避免这种情况，我们可以给这些对应的参数设置默认值：
 $request->input("username" , 'jack') ;
 
 5、检测客户端请求中，是否包含某个参数，$request->has("username") , 包含返回true，否则返回false 

 6、获取所有参数：$request->all() ，返回php的数组类型 ；
  
 7、获取指定参数：$request->only(["username" , "password"])，只获取username和password两个参数
 
 8、排除获取的参数：$request->except(["username" , "password"])，获取除了username和password之外的所有参数

 9、获取http的头信息：$request->header("Connection")
 
 10、文件上传
 相关API：
 1> 检测请求中，是否包含某个文件，profile表示类型为type的input框的name属性
 $request->hasFile("profile") ;  
 
 2> 移动上传的文件：表示将客户端传过来的profile文件，放在./upload下，并且命名为1.jpg
 $request->file("profile").move("./upload" , "1.jpg") ;

 1> 添加路由规则：
 // 显示上传文件
 Route::get("/file" , 'FileController@form') ;
 // 进行文件上传操作
 Route::post("/file/upload" , 'FileController@upload') ;
 
 2> 新建FileController控制器，进入laravel根路径，执行：
 php artisan make:controller FileController 
 
 3> 新建fileForm.blade.php , 输入：
 <html>
	<head>
		<meta charset="utf-8" />
		<title></title>
	</head>
	<body>
		<form action="/file/upload" action="post" enctype="multipart/form-data" >
			头像：<input type="file" name="profile" placeholder="please choose" />
			{{csrf_field()}}
			<button>头像上传</button>
		</from>
	</body>
 </html>


 4> 修改Filecontroller.php 代码，如下：
	
 （重点）
 注意：php中的相对路径都是针对当前请求的文件的，比如：客户端请求：http://localhost/index.php/file/upload ;
 那么这时候，在controller所有的路径都是相对于locahost/index.php而判断的

 11、Cookie操作
 基础概念：
 1> 在Laravel中，对原生的php中的cookie操作进行了封装为一个Cookie类，这个类的命名空间为顶级命名空间
 在控制器中，可以通过\Cookie进行访问
 2> Laravel对cookie进行了加密设置，所以在客户端查看时，会看到经过加密之后的非明文格式的cookie值
 3> 设置cookie的方式：
	\Cookie::queuea("name" , "jack" , 10) ;
	return response("")->widthCookie("name" , "jack" , 10) ;
 4> 获取cookie的方式：
    $res = \Cookie::get("name") ;
	$res = $request->cookie("name") ;
 
 使用方法：
 1> 新建路由匹配规则，
 Route::get("/test/cookie" , 'TestController@cookie');

 2> 修改TestController中对应的方法
	
 12、闪存操作
 基础概念：
 1> 闪存是存在于服务端中的临时存储的内容，闪存只能请求一次，第二次再请求时，就会读取不到。
 2> 闪存常常用于用户注册过程中，对于参数的验证过程。
 3> 设置闪存：$request->flash() ; 闪存所有http中request的参数
    获取闪存：old("username") ; 获取username闪存
 4> 通过Session设置闪存，\Session::flash(name , value) ; 设置自定义闪存
	获取闪存：session(name) ; 



 使用方法：
 1> 新建控制器，进入laravel根路径下，执行：
 php artisan make:controller FlashController 	

 2> 新建路由规则：
 Route::get("/flash/index" , 'FlashController@index') ;
 Route::post("/flash/register" , 'FlashController@register') ;
 Route::get("/flash/get" , 'FlashController@get') ; 
 
 3> 新建模版文件，flashIndex.blade.php ，输入：
  <html>
	<head>
		<meta charset="utf-8" />
		<title>Test Flash</title>
	</head>
	<body>
		<form>
			用户名：<input type="text" name="username" placeholder="username" /></br>
			密码：<input type="password" name="password" placeholder="password" /></br>
			年龄：<input type="number" name="age" placeholder="age" /></br>
			{{csrf_field()}}
			<button>点击提交</button>
		</from>
	</body>
  </html>


 修改FlashController.php代码：


 参考链接：
 http://chuanke.baidu.com/v1344269-224913-1535398.html

 */	
?>

<?php
	// TestController
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;
	class TestController extends Controller {
		// 这里Request $request 采用了反射的原理，
		// 将函数中使用的对象，通过反射的原理，自动创建并传入到函数中
		public function info(Request $request){
			$method = $request->method() ;
			$ip = $request->ip() ;
			$isGet = $request->isMethod("get") ;
			$path = $request->path() ;
			$port = $request->getPort() ;
			echo "The Http Request info is " .
				 "method ". $method ."</br>" .
				 "ip" . $ip . "</br>" .
				 "path" . $path . "</br>" .
				 "port " . $port . "</br>" ;
		}
		// 获取参数
		public function list(Request $request){
			$username = $request->input("username") ;
			$password = $request->input("password") ;
			echo "Username is " . $username . " ;Password is " . $password ;
		}
		// form
		public function form(){
			return view("form");
		}
		// insert
		public function insert(Request $request){
			$username = $request->input("username") ;
			$password = $request->input("password") ;
			echo "Username is " . $username . " ; password is " . $password ;
		}
		public function getHeader(){
			$conn = $request->header("Connection") ;
			echo $conn ;
		}
	}
?>

<?php
	// FileController
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;
	class FileController extends Controller {
		public function form {
			return view("fileForm") ;
		}
		// Request $request 依赖注入
		public function upload(Request $request){

			// 检查是否有上传文件
			$res = $request->hasFile("profile") ;
			if($res){
				// 移动文件到当前路径下的upload中的1.jpg
				$request->file("profile")->move("./upload" , "1.jpg") ;
			}
			echo "upload" ;
		}
	}
?>

<?php
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;
	class Cookie extends Controller {
		// Cookie操作
		public function cookie(Request $request){
			// 设置cookie 
			// 这里lavavel对cookie的设置的封装，时间采用的是分钟，也就是10分钟后到期
			
			// 设置cookie -- 方式一
			//\Cookie::queuea("name" , "jack" , 10) ;
			// 设置cookie -- 方式二
			//return response("")->widthCookie("name" , "jack" , 10) ;

			// 获取cookie -- 方式一
			//$res = \Cookie::get("name") ;
			// 获取cookie -- 方式二
			$res = $request->cookie("name") ;
		}
	}
?>

<?php
	// FlashController
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;
	class FlashController extends Controller {
		// 跳转试图
		public function index(){
			return view("flashIndex") ;
		}
		// 注册
		public function register(Request $request){
 			// 闪存所有参数
		 	$request->flash() ;
		}
		// 获取缓存
		public function get(){
			var_dump(old('username'));
		}
 
 		// 设置自定义闪存 
		public function setFlash(){
			\Session::flash('name' , 'jack') ;
		}

		// 获取自定义闪存
		public function getFlash(){
			echo session("name") ;
		}
	}
?>









