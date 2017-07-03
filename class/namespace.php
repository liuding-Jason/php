<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 上午11:37
 */

require_once "init/index.php";
require_once "get_data/init_class.php" ;

$init = new \init\Init() ;
$init->init() ;

$getData = new \get_data\GetData();
$getData->init() ;
