<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 上午11:21
 */

class Student {

    private  $_name , $_age ;

    /**
     * 静态属性
     */
    private static $num = 0 ;

    /**
     *  常量  -- 不可以更改
     *  在类中访问常量，需要Student::MAX_STUDENT_NUM
     */
    const MAX_STUDENT_NUM = 200 ;

    /**
     * static 定义的方法，叫类方法，或者静态方法，可以直接通过类名进行调用
     */
    public static function sayHello(){
        print "hello all student" . "</br>";
    }

    /**
     * 访问静态属性
     */
    public static function showNum(){
        echo Student::$num . "</br>" ;
    }


    /**
     * Student constructor.
     * @param $name string
     * @param $age int
     */
    public function  __construct($name , $age){
        $this->_name = $name ;
        $this->_age = $age ;
        echo "constructor..." . "</br>" ;
        Student::$num++ ;
        if(Student::$num > Student::MAX_STUDENT_NUM){
            thow new Exception("only ". Student::MAX_STUDENT_NUM ." students can be create!") ;
        }
    }

    public function showName(){
        echo $this->_name ;
    }

    public function showAge(){
        echo $this->_age ;
    }
}