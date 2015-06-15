<?php
//phpinfo();

//exit('ok');

//DEBUG模式是否开启
define('DEBUG',true);

//当前时间
define('TIME',time());

////基本路径配置
defined('PATH_ROOT')		|| define('PATH_ROOT',dirname(__DIR__));
defined('PATH_CONFIG')		|| define('PATH_CONFIG', PATH_ROOT.'/config');
require_once '../application/Hf.php';

Hf::run();
