<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/11
 * Time: 下午4:18
 */

/**
 * 

数据库填充 -- 进行数据库测试数据填充

1、基本的使用方法

1> 创建数据库填充文件，进入laravel根路径下，执行
php artisan make:seeder test
创建好的类文件，存放在laravel根路径下，database/seeds文件夹中

2> 修改database/seeds文件夹下，对应的seeder文件：
代码1

3> 执行命令：
php artisan db:seed --class=test
执行db:seed，--class表示为这个命令添加参数test class

2、通过修改laravel根路径下的database/seeds/DatabaseSeeder.php文件进行多个seeder的操作

1> 创建数据库填充文件，进入laravel根路径下，执行：
php artisan make:seeder PostSeeder

2> 修改laravel根路径下database/seeds文件中，对应的PostSeeder的填充器
代码2

3> 修改laravel根路径下的database/seeds/DatabaseSeeder.php
代码3

4> 执行命令：
php artisan db:seed

注意：
这里再给seeder起类名的时候，最好不要和migrate文件一致，建议最好再migrate文件对应的名称后面，加上Seeder


 */

?>

<!-- 代码1 -->
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;

class test extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 执行插入数据操作
        $arr = [] ;
        for($i = 0 ; $i < 50 ; $i++){
            $temp = [] ;
            $temp['name'] = str_random(15) ;
            $temp['email'] = rand(100000 , 9999999) . "@qq.com" ;
            $temp['password'] = str_random(10) ;
            $temp['acount'] = rand(10000 , 50000) ;
            $temp['gender'] = rand(0 , 1) ;
            $arr[$i] = $temp ;
        }
        DB::table("test")->insert($arr);
    }
}

?>

<!-- 代码二 -->
<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr = [] ;
        for($i = 0 ; $i < 50 ; $i++){
            $temp = [] ;
            $temp['title'] = str_random(100) ;
            $temp['content'] = str_random(200) ;
            $temp['created_at'] = date('Y:m:d H:m:s') ;
            $temp['updated_at'] = date('Y:m:d H:m:s') ;
            $temp['author'] = str_random(10) ;
            $arr[$i] = $temp ;
        }
        DB::table("post")->insert($arr);
    }
}
?>

<!-- 代码三 -->
<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PostSeeder::class) ;
    }
}
?>



