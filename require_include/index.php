<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/3
 * Time: 上午11:09
 */


/*
 * include 和 require 的主要区别是，资源引用发生错误之后，include主要是警告，而require会发生错误
 * */

/*
 * 提示警告
 * */
include "lib.php" ;

/*
 *  提示错误
 * */
require "lib.php" ;