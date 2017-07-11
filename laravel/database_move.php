<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/11
 * Time: 上午11:04
 */

/**
 * 

数据库迁移
基本概念
数据库迁移是laravel中对数据库结构管理的一种方式。
它所要解决的问题就是：实际团队项目开发过程中，数据库的同步功能。
它的解决思路就是：将数据库创建和修改放到php代码中，而放弃工具化数据库操作。

1、基础的数据库迁移操作
基本信息：
这种方式创建的数据库迁移，只适用于前期数据库中数据无用前提下的操作，因为这种操作再进行删除表格操作时，会删除掉表格中原有的数据。

使用方法：
1> 创建迁移类文件，进入laravel根路径下，执行：
php artisan make:migration test
创建的文件，位于laravel根路径下的database/migration文件夹下

2> 进入laravel根路径database/migration文件夹中，找到对应的test迁移文件，默认情况下，这个迁移类文件中，包括up和down两个公共方法，其中up方法是在执行迁移时执行的方法，而down方法是在执行回滚时执行的方法。在up方法中，对数据库进行一些操作，比如表创建、创建表字段、设置引擎

3> 在up方法中，执行：
Schema::create('test' , function(Blueprint $table){});
创建表

4> 在上述的function(Blueprint $table){}函数中，创建表字段
常用语句：
创建主键： $table->increments(name) 
创建vchar类型：$table->string(name)
创建指定长度的char类型：$table->char(name , length)

5、给指定的字段设置属性：
常用的语句
添加注释：$table->string(name)->commit(yourcommit)
可为空值：$table->string(name)->nullable()
设置默认值：$table->string(name)->default(your_default_value)

6> 执行迁移操作：
php artisan migrate
这里laravel会执行三个migration操作，其中两个是laravel帮我们默认创建的，还有我们的test

7> 在已经存在的表格中，添加字段：
需要在对应的migration文件中，function(Blueprint $table){}函数中，添加对应的字段，
同时，需要在down方法中，执行删除表格的操作。
Schema::drop(tablename) ;
执行对应的更新迁移操作：
php artisan migrate:refresh 

8> 利用数据库迁移类文件，给数据库加索引
常用语句：
增加唯一索引：$table->unique('username')
增加一般索引：$table->index('email')
删除主键：$table->dropPrimary("PRIMARY")
删除唯一索引:$table->dropUnique("username")
删除一般索引：$table->dropIndex("username")

查看索引语句：
show index from test

9> 修改数据库默认引擎：innodb引擎可以使用数据库事务操作
$table->engine = 'innodb' ;


2、记录表结构的变化
基本信息：
检测表结构变化，如果表存在则不创建，如果表不存在则创建
检测表字段变化，如果表字段存在则不添加，否则添加字段
注意：需要将down中的回滚操作进行注释

使用方法：
1> 检测数据库中，是否存在表格
Schema::hasTable('test')，存在返回true，否则返回false

针对上面检测结果进行不同的操作：
if(!Schema::hasTable('test')){
	Schema::create("test" , function(Blueprint $table){
		$table->increments('id') ;
		......
	}) ;
}else{
	Schema::table('test' , function($table){
		$table->tinyInteget('sex')->default(1) ;
	}) ;
}

2> 检测表字段是否存在：
Schema::hasColumn(tablename , keyname)

针对检测结果进行不同的操作：
if(!Schema::hasTable("test")){
	Schema::create('table' , function(Blueprint $table){
		$table->char('name' , 50)->commit("名称") ;
		......
	}) ;
}else{
	if(!Schema::hasColumn("test" , "gender")){
		Schema->table("test" , function($table){
			$table->tinyInteger("gender")->commit("性别");
		}) ;
	}
}


3> 修改字段属性：
需要安装一个composer的扩展
composer require doctrine/dbal
在function($table){}中输入：
if(Schema::hasColumn("test" , "password")){
	// 将password类型修改为text
	$table->text('password')->change() ; 
}


4> 删除字段
 if(Schema::hasCloumn("test" , "gender")){
	Schema::table("test" , function($table){
		$table->dropColumn("gender");
	});
 }





错误信息搜集：
1071 Specified key was too long
表示数据库的排序规则中选中的字符集所支持的最大长度小于我们创建表格使用的字段长度，导致了问题的发生。

 */

?>

<?php
	// Test
	use Illuminate\Database\Schema\Blueprint ;
	use Illuminate\Database\Migrations\Migration ;

	class Test extends Migration {
		
		/**
		* Test a table whether has the index
		*/
		public function index($table , $index){
			$conn = Schema::getConnection() ;
			$dbSchemaManager = $conn->getDoctrineSchemaManager() ;
			$doctrineTable = $dbSchemaManager->listTableDetails($table) ;
			return $doctrineTable->hasIndex($index) ;
		}

		/**
		* Run the migration
		* @return void
		*/
		public function up(){

			if(!Schema::hasTable("test")){
				// 创建表格 test
				Schema::create('test' , function(Blueprint $table){
					// 创建主键字段
					$table->increments("id")->commit("用户ID") ;
					// 创建邮箱
					$table->string('email')->commit("邮箱") ;
					// 创建vchar类型的字段
					$table->string("name")->nullable()->commit("用户名称") ;
					// 创建制定长度的char类型字段
					$table->char("password" , 100)->nullable()->default("123456")->commit("用户密码") ;

					// 增加数据库索引
					$table->unique("name") ;
					$table->index("email") ;
				});
			}else{
				if(!Schema::hasCloumn("test" , "gender")){
					Schema::table('test' , function($table){
						$table->tinyInteger('gender')->default(1)->commit("性别");
					}) ;
				}
				// 检测主键
				if($this->index("test" , "test_name_unique")){
					$table->dropIndex("test_name_unique");
				}
			}
		}
		/**
		* Reverse the migration
		* @return void
		*/
		public function down(){
			// 删除表格
			//Schema::drop("test") ;
		}

	}
?>











