<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午9:11
 */

/**
 * PDO扩展中，phpstatemnt类是对查询结果的处理的工具类，在pdo的手册中，它是没有构造方法存在的，
 * 原因是PDO将它的构造方法设置为了私有的 单态类  ， 这样可以防止它在进行数据库操作的过程中，每次
 * 产生一个实例对象，导致了内存泄漏
 */

/**
 * 单态类
 */

class A {
    private static $a = null ;
    private function __construct(){
        echo "constructor" ;
    }
    // 实际产生对象的方法 ， 通过内部方法访问private
    static function makeA(){
        if(self::$a === null){
            return new self() ;
        }
        return self::$a ;
    }
}

print_r(A::makeA()) ;