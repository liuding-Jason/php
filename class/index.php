<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 上午11:19
 */


/*
 * 类定义  类 抽象的具有相同属性和相同行为的抽象体
 * 实例 具体的具有相同属性和行为的具体的个体
 * */



require_once "./student_class.php" ;

/**
 * 调用静态方法
 */

Student::sayHello() ;
Student::showNum() ;

/**
 *   调用成员方法
 */
$stu = new Student("jack" , 15);
$stu->showName() ;


