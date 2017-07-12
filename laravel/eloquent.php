<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/11
 * Time: 下午8:26
 */

/**
 *
模型

Laravel提供了简洁的、漂亮的和数据库交互的方式，每一个数据库表都有一个对应的模型用来与数据表进行交互。

1、创建模型，
1> 进入laravel根路径，执行：
php artisan make:modal Post
创建好的模型文件，默认位于laravel根路径下的app文件夹中

2> 还可以执行：
php artisan make:modal Post -m 
这时会创建一个Post对应的modal文件和一个对应的数据库迁移post文件，便于使用模型对数据库进行操作

3>、创建指定路径的模型，进入laravel根路径，进入app，新建Model文件夹，在laravel根路径下执行：
php artisan make:model Model/Order -m

2、模型限定
限定规则：
1> 模型所对应的默认的表名是在模型后面加s，如果模型名称后面有s，则表名跟模型名称相同，例如：Order => orders  ， Goods => goods
2> 默认创建主键字段id
3> 默认创建时间字段create_at、updated_at
4> 模型文件中 protected $fillable = ['name', 'email', 'password'] 表示设置允许模型文件操作的字段

3、修改模型默认的限定（不建议）
1> 进入laravel根路径下的app中，打开对应的模版文件
2> 修改模版默认限定的表名：public $table = "newname" ;
3> 修改模版默认限定的时间字段：public $timestamps = false ;
4> 修改模版默认限定的主键字段：public $primaryKey = 'uid' ;

4、使用模型进行数据表操作
1> 进入laravel根路径下，在app/http/routes.php新建路由匹配规则：
Route::get("/post/create" , 'PostController@create') ;
Route::get("/post/del" , 'PostController@delete') ; 
Route::get("/post/find" , 'PostController@find') ;
Route::get("/post/update" , 'PostController@update') ;

2> 修改PostController中的createTest方法，
代码一

3> 像使用DB数据库构造器一样对数据库数据进行操作：
$data = \App\Post::get() ;
$dataList = \App\Post::orderBy('id' ,"desc")->where("id" , "<" , 100)->get() ;

4、多种关系的模型建设 

模型关系：
一对一关系 每一个用户 id 对应 一个 用户详情信息
一对多关系 每一个用户 id 对应 多篇 编辑文章 、 每一个用户 id 对应 多张 银行卡
从属于关系 每一个用户 id 属于 一个 国家
多对多关系 每一个用户 id 属于 多个组 ，每一个组 id 可以 包含多个用户
通过model文件建立多个模型之间的关联，通过建立模型之间的关系，可以方便数据的获取
基础信息搭建：
1> 创建多个模型
php artisan make:model User -m
php artisan make:model UserInfo -m
php artisan make:model Post -m
php artisan make:model Country -m
php artisan make:model Group -m

2> 分别修改对应的数据库迁移文件，并创建对应的测试数据

5、一对一模型建设
通过建立一对一的关系，可以在获取到主表信息的同时也就能获取到关联表的数据
例如：在user模型中，建立一对一的userInfo关联关系

1> 新建RelationController控制器，进入laravel根路径下，执行：
php artisan make:controller RelationController

2> 修改routes.php文件，新建路由匹配规则：
Route::get("/relation/index" , 'RelationController@index');

3> 修改对应的index方法，通过一对一关系模型的建立读取userInfo的信息
hasOne('App\UserInfo' , 'user_id')

6、一对多关系模型建立
1> 修改routes.php文件，新建路由匹配规则：
Route::get("/relation/many" , 'RelationController@manyTest');

2> 建立user与post文章之间一对多的关系，在user模型文件中，通过设置：
hasMany('App\Post' , 'user_id') ;

7、从属关系模型建立
1> 修改routes.php文件，新建路由匹配规则：
Route::get("/relation/belong" , 'RelationController@belongTest'); 

2> 建立user与country之间从属关系，在user模型文件中，通过设置：
belongsTo('App\Country' , 'user_id') ;

8、多对多关系模型建立
1> 修改routes.php文件，新建路由匹配规则：
Route::get("/relation/maynToMany" , 'RelationController@manyToMany');

2> 建立group和user之间多对多的关系，在user模型文件中，通过设置：
belongsToMany('App\Group' , 'group_user' , 'user_id' , 'group_id' );
注意：
第二个参数表示 多对多关系中的关联表  
第三个参数表示 多对多关系中的 本模型关联字段
第四个参数表示 多对多关系中的 关联模型关联字段

9、一对多关系模型写入
1> 修改routes.php文件，新建路由匹配规则：
Route::get("/relation/writeMany" , 'RelationController@writeMany');

10、其他的关系模型操作
1> 多对多模型的添加：将用户id为1和组id为2进行关联
$user = User::find(2) ;
$user->manyToMany()->attach(1) ;

2> 多对多模型的删除：删除用户id为1的组id为2的关联关系
$user = User::find(1) ;
$user->manyToMany()->detach(2) ;

3> 多对多模型的同步：用户id为1的与所有的组建立关联关系
$user = User::find(1) ;
$user->manyToMany()->sync([1 , 2 , 3 , 4]);

代码二

*/
?>

<!-- 代码一 -->
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PostController extends Controller
{
        // 新增
    public function create(){
        // 新建模型对象
        $post = new \App\Post() ;
        // 添加表字段内容
        $post->title = "这是测试文章标题" ;
        $post->content = "这是测试文章内容" ;
        $post->created_at = date('Y-m-d H:i:s') ;
        $post->updated_at = date('Y-m-d H:i:s') ;
        $post->save() ;
        dd($post) ;
    }
    // 查询
    public function find(){
        // 新建模型对象
        $info = \App\Post::find(3) ;
        dd($info) ;
        // 对表进行删除操作

    }
    // 删除
    public function delete(){
        $info = \App\Post::find(3) ;
        $res = $info->delete() ;
        if($res){
            echo "delete success！" ;
        }
        // dd($res);
    }
    // 更新
    public  function update(){
        $info = \App\Post::find(4) ;
        if($info){
            $info->title("这是一个新的测试标题") ;
            $info->save();
        }else{
            echo "sorry , not found" ;
        }
    }
    // 操作数据表数据
    public getData(){
    	$data = \App\Post::get() ;
    	$dataList = \App\Post::orderBy("id" , "desc")->where("id" , "<" , 100)->get() ;
    }
}

?>
<!-- 代码二 -->
<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * 做模型之间的关联
     * 一对一
     */
    public function userInfo(){
        return $this->hasOne('App\UserInfo' , 'user_id');
    }
    /**
    * 做模型之间的关联
    * 一对多
    */
    public function manyPost(){
        return $this->hasMany('App\Post' , 'user_id');
    }
    /**
    * 做模型之间从属关联
    * 从属关系
    */
    public function belong(){
        return $this->belongsTo('App\Country' , 'country_id');
    }
    /**
     * 做模型之间关联
     * 多对多关联
     */
    public function manyToMany(){
        return $this->belongsToMany('App\Group' , 'group_user' , 'user_id' , 'group_id') ;
    }
        
}

?>

<!-- 代码三 -->
<?php
// RelationController.php 文件
namespace App\Http\Controllers;
use App\User ;
use Illuminate\Http\Request;
class RelationController extends Controller
{
    // index
    public function index(){
       $user = User::find(1) ;
       // 读取详细信息 方法一
       //$detail = $user->userInfo()->first() ;
       //读取详细信息 方法二
       $detail = $user->userInfo ;
       dd($detail);
    }
    // manyTest
    public function manyTest(){
        $user = User::find(1) ;
        // 获取多个信息
        $data = $user->manyPost ;
        dd($data) ;
    }
    // belongTest 从属关系
    public function belongTest(){
        $user = User::find(1) ;
        // 获取从属关系
        //$count = $user->belong()->first() ;
        $count = $user->belong ;
        dd($count);
    }
    // 利用模型执行 一对多写入
    public function writeMany(){
        // 引入数据库迁移对象
        $post = new Post() ;
        $post->title = "test_title_1" ;
        $post->content = "test_content_1" ;
        $post->author = "jack" ;
        // 引入user模型
        $user = User::find(2) ;
        if($user->manyPost()->save($post)){
            echo "写入成功！" ;
        }
    }
}
?>




