<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 下午12:54
 */

require_once "./student_class.php" ;

class Junior extends Student {

    public function __construct($name, $age){
        parent::__construct($name, $age);
    }
}

$junior = new Junior('Tom' , 15) ;
$junior->showName() ;