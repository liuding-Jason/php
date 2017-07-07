<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/6
 * Time: 下午4:52
 */


/**

中间件

中间件是在路由和路由对应的控制器之间，用于对请求进行合理性检测。
常用作用：
用于用户登录状态检测
用于用户权限检测
用于请求日志的记录
 
1、创建中间件

通过命令行创建，需要进入laravel根目录，执行：
php artisan make:middleware YourMiddleware

这个创建好的中间件，将被存放于：laravel根路径下：app/Http/Middleware下

2、修改中间件代码：

3、注册中间件

全局注册 ： 所有路由都要限制
路由注册 ： 对某个路由或者路由组进行限制

注册方法：打开laravel根路径下的App/Http/Kernal.php文件，
变量$middleware=[] , 表示注册全局中间件；
变量$routeMiddleware=[] ,表示注册路由中间件

4、全局注册的应用 -- TestMiddleware

1> 创建
php artisan make:middleware TestMiddleware

2> 修改 App/Http/Middleware/TestMiddleware.php
代码1

3> 注册：
//::class表示类的带有命名空间的全路径
protected $middleware = [
	\App\Http\Middleware\TestMiddleware::class
]

修改配置文件:
//::class表示类的带有命名空间的全路径
protected $middleware = [
	\App\Http\Middleware\TestMiddleware::class
]


5、路由注册的应用 -- LoginMiddleware

1> 创建
php artisan make:middleware LoginMiddleware

2> 修改 App/Http/Middleware/LoginMiddleware.php
代码2

3> 注册：
protected $middleware = [
	"login" => \App\Http\Middleware\LoginMiddleware::class
]

4> 应用
// 单个路由限制 -- 方式一
Route::get("/info" , [
	"middleware" => "login" ,
	"uses" => function(){
		echo "这是info页面" ;
	}
]) ;
// 单个路由限制 -- 方式二
Route::get("/admin" , function(){
	echo "这是后台页面！" ;
})->middleware("login");

// 设置session
Route::get("/session" , function(){
	return session(["uid" => 10]);
});

*/
?>

<?php
	// TestMiddleware.php
	
	namespace App\Http\Middleware ;

	use Closure ;

	class TestMiddleware {
		
		/**
		* Handle an incoming request
		*
		* @param \Illuminate\Http\Request $request
		* @param \Closure $next
		* @param mixed
		*/
		public function handle($request , Closure $next){
			// 记录该请求的路径
			// $request 表示请求相关的信息
			$path = '[' . date('Y:m:d H:i:s')  . ']' . $request->ip() . '------' . $request->path() ;
			// 将请求路径存入request.log日志文件中，此时request.log是相对于请求的文件的路径而生成的
			// FILE_APPEND -- 表示追加的方式
			file_put_contents('request.log' , $path."\r" , FILE_APPEND) ;
			// $next 是变量函数 ，表示下一个中间件
			return $next($request) ;
		}
	}

?>


<?php
	// LoginMiddleware.php
	
	namespace App\Http\Middleware ;
	use Closure ;

	class LoginMiddleware {
		/**
		* Handle an incoming request
		*
		* @param \Illuminate\Http\Request $request
		* @param \Closure $next
		* @param mixed
		*/
		public function handle($request , Closure $next){

			// 判断session是否存在
			if(!session("uid")){
				// 跳转
				redirect("/login") ;
			}
			return $next($request);
		}
	}
?>




 


