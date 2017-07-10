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
事务操作是对一组sql语句进行执行的操作，可以根据每一条语句的执行结果进行判断是否执行回滚操作，回滚成功之后，所有这个组的语句都将不执行。

常用语句：
开启事务：Db::beginTransaction()
回滚事务：Db::rollback()
提交事务：Db::commit()

使用方法：
1> 修改routes.php文件，新建路由匹配规则：
Route::get("/db/affair" , 'DbTestController@affair');
2>

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

	}

?>