<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/10
 * Time: 下午4:37
 */

/**
 * 
数据库操作
数据库增删改查操作，laravel中数据库操作采用的是DB这个类，这个类位于根命名空间下。使用的时候，需要引入。
数据库的配置文件放置在，laravel根路径下config/database.php文件中，该文件中的内容是对laravel中的数据库连接进行设置的文件。
在config/database.php文件中，使用env(key , value)函数读取laravel根路径下的.env文件设置的变量内容值，因此我们可以将数据库的相关配置，设置在.env文件中，然后通过在database.php文件中使用env函数读取数据库配置。



1、配置数据库链接配置：
常用语句：
查询语句：DB::select() 
增加语句：DB::insert()
修改语句：DB::update()
删除语句：DB::delete()
一般语句：DB::statment()，例如创建表格和删除表格

1> 在laravel根路径下的.env文件中，根据自己的数据库设置，修改数据库配置
2> 进入laravel根路径，新建DbTestController控制器，执行：
php artisan make:controller DbTestController 
3> 修改routes.php文件，新建路由匹配规则：
Route::get("/db/select" , 'DbTestController@select') ;
Route::get("/db/insert" , 'DbTestController@insert') ;
Route::get("/db/update" , 'DbTestController@update') ;
Route::get("/db/delete" , 'DbTestController@delete') ;
Route::get("/db/create" , 'DbTestController@create') ;

2、事务操作
事务操作是对一组sql语句进行执行的操作，可以根据每一条语句的执行结果进行判断是否执行回滚操作，回滚成功之后，所有这个组的语句都将不执行。保证数据的完整性和安全性。

常用语句：
开启事务：Db::beginTransaction()
回滚事务：Db::rollback()
提交事务：Db::commit()

使用方法：
1> 修改routes.php文件，新建路由匹配规则：
Route::get("/db/affair" , 'DbTestController@affair');

3、在主从数据库之间实现读写分离

1> 进入laravel根路径下，找到config/database.php，新建从数据库的配置：
"slever-1" : [
	'dirver' 	=> 'mysql' ,
	'host'		=> '192.168.60.54' ,
	'database'  => 'test' ,
	'username'  => 'root' ,
	'password'  => '' ,
	'charset'   => 'utf-8' ,
	'collation' => 'utf8_unicode_ci' ,
	'prefix'	=> '' ,
	'strict'	=> false
]

2> 修改routes.php，新增路由匹配规则：
Route::get("/db/slever" , 'DbTestController@sleverTest');

4、构造器
构造器是laravel封装好的增删改查操作的一些方法，方便我们对数据库进行操作。
常用语句：
单条插入语句：DB::table('users')->insert(["name" => 'jack' , "age" => 16 , "gender" => 'male']) ;
多条插入语句：DB::table('users')->insert([
	["name" => 'a' , "age" = > 16 , "gender" => 16] ,
	["name" => 'b' , "age" = > 18 , "gender" => 16] ,
	["name" => 'c' , "age" = > 19 , "gender" => 16] 
]);
插入并获取id：DB::table("users")->insertGetId(['name' => 'l' , "age" => 15 , "gender" => "male"]);
更新语句：DB::table("users")->where("id" , "=" , 2)->update(['name' => 'lll']) ;
删除语句：DB::table("users")->where("id" , "<" , 30)->delete() ;
查询语句：DB::table("users")->get() ;
查询第一条：DB::table("users")->first() ;
查询第一个结果的某个字段：DB::table("users")-value("name") ;
查询表中的某列数据：DB::table("users")->lists("name") ;

连贯操作：
查询某些字段：DB::table("users")->select("name" , "age").get() ;
查询满足条件的数据：DB::table("users")->where("id" , "=" , 18)->first() ;
查询满足多个条件的数据：DB::table("users")->where('id' , "=" , 18)->orWhere("id" , "=" , 16)->get() ;
查询某个范围内的数据： DB::table("users")->whereBetween("id" , [5 , 10])->get() ;
查询在某几个中的数据：DB::table("users")->whereIn("id" , [1 , 16 , 18])->get() ;
排序语句：DB::table("users")->orderBy("id","desc")->get()
分页语句：DB::table("users")->skip(10)->take(5)->where("id" , ">" , 100)->get();
连表语句：DB::table("goods")->leftJoin('cate' , 'cate.id' , "=" , 'goods.gid')->where('goods.gid' ,'<' , 20)->get() ; //在goods表中连接cate表，使得cate的id和goods的gid相同
获取总数：DB::table("users")->count() ;
获取最大值：DB::table("users")->max("age") ;
获取平均值：DB::table("users")->avg("age") ;

5、记录sql语句
1> 修改routes.php，加入下面代码，即可在页面中打印对应的sql语句：
Event::listen('illuminate.query' , function($query){
	var_dump($query);
}) ;

*/

?>

<?php
	// DbTestController.php
	namespace App\Http\Controller ;
	use DB ;
	use Illuminate\Http\Request ;
	use App\Http\Request ;
	use App\Http\Controllers\Controller ;
	class DbTestController extends Controller {
		// select
		public function select(){
			$res = Db::select("select * from test where id < 50") ;
			echo "<pre>" ;
			var_dump($res) ;
		}
		// insert -- 执行成功返回影响函数
		public function insert(){
			return DB::insert('insert into test (name , age , gender) values("jack" , 16 , "male")');
		}
		// update -- 执行成功返回影响函数
		public function update(){
			return DB::update('update test set name="jason" where id=18') ;
		}
		// delete
		public function delete(){
			return DB::delete('delete from test where id=15');
		}
		// statment 
		public function create(){
			return Db::statement('drop table users (id int primary key auto_increment , name char(40))');
		}
 		// affair事务操作
 		public function affair(){
 			Db::beginTransaction() ;
 			// 扣钱操作
 			$setRes = Db::update('update acount set acount=acount - 2000 where id = 18') ;
 			// 加钱操作
 			$delRes = Db::update('update ourAcount set acount = acount + 2000 where id = 18') ;
 			if($setRes&&$delRes){
 				Db::commit() ;
 				echo "转账成功！" ;
 			}else{
 				DB::rollback() ;
 				echo "转账失败！";
 			}
 		}
 		// 执行从数据库的操作
 		public function sleverTest(){
 			$res = DB::connection("slever").select() ; // update insert delete执行相关的操作
 		}
	}
?>