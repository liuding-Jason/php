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
<ul>
<li><span>姓名：</span>{{$name}}</li>
<li><span>年龄：</span>{{$age}}</li>
<li><span>性别：</span>{{$gender}}</li>
</ul>
</body>
</html>


3> 通过浏览器访问：localhost/view/params查看

4、blade模版基本使用方法介绍
基本信息：
1> 模版文件中以{{}}为标志进行解析，这里一般在控制器中使用view()方法进行模版调取时候，需要传递一个新的模版变量，用于数据的解析，例如view("index" , ["newname" => $oldName])；
2> 模版文件路径分割采用的是“.”，而不是“/”；
3> 在模版文件中，可以直接使用函数，{{time()}}，这里的函数是php自带函数和用户自定义函数都可以；
4> 设置默认值，通过“or”，例如{{$username or "jack"}}；
5> 显示代码设置，通过{!!$html!!}；

使用方法：
1> 修改routes.php文件，新建路由规则：
Route::get("/blade" , 'ViewController@bladeTest');

2> 进入laravel根路径resource/views，新建bladeTest.blade.php，输入：
<html>
<head>
<meta charset="utf-8" />
<title>Test params</title>
</head>
<body>
<div>模版变量的使用测试：{{$info['name']}}</div>
<div>模版使用函数的测试：{{time()}}</div>
<div>模版使用函数的测试：{{substr($info['name'], 0 , 2)}}</div>
<div>模版变量默认值测试：欢迎回来{{$info['age'] or 18}}</div>
<div>模版显示代码测试：{!!$info['html']!!}</div>
</body>
</html>

5、blade模版引入子试图
通过@include(yourfile)，这里以laravel根路径的resource/views为基准选取的

1> 修改routes.php文件，新建路由规则：
Route::get("/page" , 'ViewController@pageTest') ;

2> 进入laravel根路径下，新建page文件夹，新建index.blade.php、header.blade.php、footer.blade.php三个文件，分别输入：

header.blade.php
<html>
<head>
<meta charset="utf-8" />
<title>Test params</title>
</head>
<body>

footer.blade.php
</body>
</html>

index.blade.php
@include('page.header')
<div>This is body part!</div>
@include('page.footer')

3> 浏览器访问localhost/page查看

6、模版继承
基本介绍：
1> 使用@extends()完成集成操作
2> 在模版中使用$yeild(yourname)进行占位符控制
3> 在原模版中使用
@section(yourname)
@show
进行区块标记，然后在继承模版中使用：
@section(yourname)
@endsection
进行内容的重写
注意：在第2条中，两个yourname必须一致；如果在继承模版中，只写继承标记不写内容时，表示删除原模版中的内容不继承。

1> 修改routes.php，新建路由规则：
Route::get("/page/extends" , 'ViewController@extends');

2> 进入laravel根路径下，新建extends文件夹，新建index.blade.php、extends.blade.php，分别输入：

index.blade.php
<html>
<head>
<meta charset="utf-8" />
<title>@yeild('title')</title>
</head>
<body>
	<div style="height:100px ; background-color:red;">Header</div>
	@section("content")
	<div style="height:400px ; background-color:blue;">Body</div>
	@show
	
	@section("footer")
	<div style="height:100px ; background-color:green;">footer</div>
	@show
	@section("js")
	@show
</body>
</html>

extends.blade.php
<!-- 继承extends/index -->	
@extends('extends.index');
@section('title' , 'Extends Test');
<!-- 重写 -->
@section("content")
<div style="height:300px ; background-color:lightblue;">New Body</div>
@endsection

<!-- 添加 -->
@section("js")
<script>
	alert("hello world!");
</script>
@endsection

<!-- 删除 -->
@section("footer")
@endsection

7、流程控制
基本信息：
1> 使用@if、@elseif、@endif完成流程控制

使用方法：
1> 修改routes.php文件，新建路由匹配规则：
Route::get("/page/liucheng" , 'ViewController@liuchengTest');

2> 进入laravel根路径page文件夹下，新建liucheng.blade.php文件，输入：
<html>
<head>
<meta charset="utf-8" />
<title>Liucheng Test</title>
</head>
<body>
@if($count >= 20)
	您输入的总数大于20
@elseif($count >= 10 && $count < 20)
	您输入的总数在10和20之间
@endif
	您输入的总数不在合理的范围内

请选择性别：
<input name="sex" value="1" @if($sex == 1) checked="checked" @endif />男
<input name="sex" value="0" @if($sex == 0) checked="checked" @endif />女
</body>
</html>

3> 通过浏览器访问：localhost/page/liucheng查看

8、循环控制
基本信息：
1> 使用
@for()
@endfor
完成for循环控制
2> 使用
@foreach()
@endforeach
完成foreach循环控制

使用方法：
1> 修改routes.php文件，新建路由匹配规则：
Route::get("/page/circle" , 'ViewController@circleTest') ;

2> 进入laravel根路径page文件夹下，新建circle.blade.php文件，输入：
<html>
<head>
<meta charset="utf-8" />
<title>circle test</title>
</head>
<body>
	<!-- for循环 -->
	@for($i = 0 ; $i < 100 ; $i++)
		{{$i}}
	@endfor

	<!-- foreach循环 -->
	<ul>
	@foreach($list as $k=>$v)
		<li>姓名：{{$v->name}} ； 年龄：{{$v->age}} , 性别：{{$v->gender}}</li>
	@endforeach
	</ul>
</body>
</html>

3> 通过浏览器访问lcoalhost/page/circle查看

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
			return view("params" ,  ['name' => "jack" , 'age' => 16 , 'gender' => 'male']);
		}
		// blade模版介绍
		public function bladeTest(){
			$info = [
				"name" => "jack" , 
				"age" => 15 , 
				"html" => "<span style='color:red;'>Hello world!</span>"
			] ;
			return view("user.blade" , ["info" => $info]) ;
		}
		// 子试图测试
		public function pageTest(){
			return view("page.index");
		}
		// 流程控制
	 	public function liuchengTest(){
	 		return view("page.liucheng" , ["count" => 15 , "sex" => 1]);
	 	}
	 	// 循环控制
	 	public function circleTest(){
	 		$list = array(
	 			array("name" => "jack" , age => 15 , gender => "male") ,
	 			array("name" => "Tom" , age => 18 , gender => "female") ,
	 			array("name" => "Bob" , age => 14 , gender => "male")
	 		);
	 		return view("page.circle" , ["list" => $list]);
	 	}
	}
?>






