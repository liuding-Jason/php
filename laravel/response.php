<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/9
 * Time: 下午5:41
 */

/**
 * 

响应 -- response
 
响应是指服务器端对客户端的请求，进行的响应的过程。在http协议中，响应服务端的响应包含响应行、响应header、响应body。
引用：
1、响应行，则为第一行，其中包括：GET或POST URL HTTP版本（注意：URL的信息必须是已经urlencoded编码后的（浏览器不会自动编码），否则将不符合要求，如：中文）
2、响应头，则第二行之后的信息，可以在 HttpConext.Request.Headers中查询，浏览器设置后自动附带上的。
3、响应体，则在响应头信息结束后，隔一空行之后的信息，响应体的编码方式与enctype的设置有关，其中enctype的默认值是application/x-www-form-urlencoded，浏览器会自动编码非法字符（这与响应行不同）；对上传文件数据时，则要将method设置为post和enctype设置为multipart/form-data。

1、响应普通的字符串

1> 新建ResponseController，进入laravel根路径，执行：

php artisan make:controller ResponseController

2> 新建路由规则：
Route::get("/reponse/string" , 'ResponseControler@stringTest');

3> 在控制器对应的string方法中，使用return yourstring即可。

2、响应头设置cookie

1> 新建路由匹配规则
Route::get("/response/cookie" , 'ResponseController@cookieTest') ;

2> 使用response()->withCookie(key , value , expire)进行设置，这里的expire是以分钟为单位的




3、响应json格式的数据

1> 新建路由匹配规则：

Route::get('/response/json' , 'ResponseController@jsonTest') ;

2> 使用response()->json([name -> 'jack' , age -> 12])进行返回


4、下载文件

1> 新建路由匹配规则：
Route::get("/response/download" , 'ResponseController@download') ;

2> 使用response()->download(filename)执行下载，这里服务器上的filename的路径，都是针对public/index.php设置的

5、进行路由的跳转，可以跳网站内部路径，也可以外网路径

1> 新建路由匹配规则：
Route::get("/response/redirect" , 'ResponseController@redirectTest');

2> 使用response()->redirect(yourpath)进行跳转。


5、模版解析，

1> 新建路由规则：
Route::get("/response/view" , 'ResponseController@viewTest') ;

2> 使用view(filename)进行模版解析和返回操作


注意：
模版文件存放在laravel根路径下resource/views中， 模版文件必须以 .blade.php 结尾


6、设置相应头信息

1> 新建路由匹配规则：
Route::get("/response/header" , 'ResponseController@headerTest') ;

2> 使用response()->header(key , value)对相应头进行设置

 */

?>

<?php
 
 	// ResponseController
	namespace App\Http\Controller ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;

	class Response extends Controller {

		// 响应普通字符串
		public function stringTest(){
			return "reponse string test!" ;
		}
 
 		// 设置cookie，有效时间为10分钟
		public function cookieTest(){
			return response()->withCookie('test' , 'testCookie' , 10) ;
		}

		// 响应json
		puublic function jsonTest(){
			return response()->json([name => 'jack' , age => 11]);
		}

		// 下载文件
		public function download(){
			return response()->download("./images/404.png") ; 
		}

 		// 服务器跳转 
 		public function redirectTest(){
 			// 内网路径
 			//return response()->redirect("/response/string") ;
 			// 外网路径
 			return response()->redirect("www.baidu.com") ;

 		}

 		// 模版解析
 		public function viewTest(){
 			return view("form.blade.php") ;
 		}

 		// 响应头信息设置
 		public function headerTest(){
 			return response("123")->header('Context-type' , 'Application/json')->header(age , 14) ;
 		}

	}
?>










