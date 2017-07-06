<?php
/**
 * Created by PhpStorm.
 * User: liuding
 * Date: 2017/7/6
 * Time: 上午11:54
 */

/**
 * 虚拟主机 -- 设定方式
 *
 * 1、修改apache配置文件
 *
 *      include conf/extra/httpd-conf #
 *      找到改行将该行前面的#去掉
 *
 * 2、修改虚拟主机子配置文件（wamp/bin/apache/apache2.4.17/conf/extra/httpd-vhosts.conf）
 *      <VirtualHost *:80>
 *          ServerAdmin webmaster@dummy-host2.example.com
 *          DocumentRoot "Application/wamp/www/class/Public/laravel"      #网站根目录
 *          ServerName namespace.com        #域名
 *          ErrorLog "logs/dummy-hosts3.example.com-error.log"
 *          Customlog "log/dummy-hosts.example.com-access.log" common
 *      <VirtualHost>
 *
 * 3、重启wempserver
 *
 * 4、域名解析  修改hosts文件
 *
 *      127.0.0.1   namespace.com
 *
 */



