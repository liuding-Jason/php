<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/6/1
 * Time: 下午4:04
 */



/*
 * session 会话管理
 *
 * */

/*
 * 启动session
 *
 * session启动时，php会给每一个session创建一个独立的session_id，
 * 这个session_id对应着服务端的一个session文件，
 * 同时，php调用cookie操作函数，将默认的session_id设置到cookie中PHPSESSID
 * */
session_start() ;

