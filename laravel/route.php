<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/6
 * Time: 下午3:33
 */

/**
laravel 框架
1、框架的路由文件放在：app/http/routes.php , 框架的入口文件放在public中

2、框架的模版文件放在：resources/views/yourm/yourm.blade.php  ， 模版文件必须以.blade.php结尾

3、客户端通过表单发送post请求到服务端时，需要在客户端的表单处增加隐藏域 ， get请求不需要
 客户端：
 <form action="/insert" method="post">
      用户名: <input type="text" name="username" palceholder="please input" />
      密码： <input type="password" name="password" placeholder="password" />
      {{csrf_field()}}
 </form>

4、利用跨站请求伪造方式，发送put 或者 delete 请求

 客户端
 put
 <form action="/update" method="post">
      <input type="hidden" name="_method" value="PUT" />
      用户名：<input type="text" name="username" placeholder="username" />
      密码：  <input type="password" name="password" placeholder="password" />
      {{ csrf_field() }}
</form>

delete
<form action="/update" method="post">
      <input type="hidden" name="_method" value="PUT" />
      用户名：<input type="text" name="username" placeholder="username" />
      密码：  <input type="password" name="password" placeholder="password" />
      {{ csrf_field() }}
</form>

服务端路由

Route::put("/update" , function(){
        echo "update" ;
});

Route::delete("/delete" , function(){
        echo "delete" ;
});

5、带参数的路由匹配规则

服务端：
Route::get("/article/{id}" , function($id){
        echo "当前文章的id为" . $id ;
});

客户端访问：localhost/article/32

6、限制参数类型
服务端：
Route::get("/goods/{id}" , function($id){
        echo "当前文章的id为" . $id ;
}).where("id" , "\d+") ;

7、传递多个参数
服务端：
Route::get("/{type}-{id}" , function($type , $id){
        echo "当前类型为：" . $type . " ; 当前的id为：" . $id ;
}) ;

客户端：
localhost/goods-15

8、路由别名 -- 便于创建复杂、多级路由对应的模版

// route是一个函数，用于快速创建完整url
Route::get("/admin/users/list" , [
  "as" => "ulist" ,
  "uses" => function(){
    echo route('ulist');
  }
]);

9、路由组 -- 可以为某些路由增加中间件，用于组别路由的验证和处理规则

Route::group([] , function(){
    Route::get("/{type}-{id}" , function($type , $id){
        echo "当前类型为：" . $type . " ; 当前的id为：" . $id ;
    }) ;

    Route::get("/goods/{id}" , function($id){
        echo "当前文章的id为" . $id ;
    }).where("id" , "\d+") ;
});


10、关于路由404的设置，当路由规则匹配不到规则的时候，就会显示这个404页面内容
在resorces/view/error新建404.blade.php文件 ， 可以作为404错误信息页面
服务端：
Route::get("/404" , function(){
  echo view("404") ;
});























 */