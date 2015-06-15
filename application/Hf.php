<?php

require_once PATH_CONFIG.'/config.php';

//自动加载对象
spl_autoload_register(function($class_name) {
	$key = substr($class_name,0,4);
	$file_path = '';
	switch($key){
		case 'Base':
			$file_path = PATH_ROOT."/{$class_name}.php";
			break;
		case 'Mode':
			$file_path = PATH_ROOT."/{$class_name}.php";
			break;
		default:
			$file_path = PATH_ROOT."/Library/{$class_name}.php";
			break;
	}
	$file_path = str_replace('\\', '/', $file_path);
	if(is_file($file_path)){
		include_once $file_path;
	}
});


class Hf{

	private static function _init() {
		//脚本执行时间及调试信息
		set_time_limit(30);
		if (DEBUG) {
			ini_set('display_errors', 'On');
			error_reporting(E_ALL);
		} else {
			ini_set('display_errors', 'Off');
		}
		// 设置时区
		function_exists('date_default_timezone_set') && date_default_timezone_set('Asia/Shanghai');
	}

	/**
	* 开始加载
	*
	*
	*
	*/
	public static function run(){
		
		self::_init();
		
		$ps = $_SERVER['REQUEST_URI'];
		$s = strpos($ps, '?');

		if ($s !== false) {
			$ps = substr($ps, 0, $s);
		}
		$ps = explode('/', $ps);
		for ($i = 0; $i < 4; ++$i) {
			if (empty($ps[$i]))
				$ps[$i] = 'index';
		}

		list(,$module, $controller, $action) = $ps;
		$module = ucfirst($module);
		$ctlname = 'Controllers\\'."$module\\".ucfirst($controller) . 'Controller';
		$ctl_path = str_replace('\\', '/',PATH_ROOT . '/' . $ctlname . '.php');		
		try {
			if (!is_file($ctl_path)) {
				throw new Exception('控制器不存在，请检查路径！', 404);
			}
			require $ctl_path;
			$obj = new $ctlname($module, $controller, $action);
			$action_name = $action . 'Action';
			if (!method_exists($obj, $action_name)) {
				throw new Exception('对应动作不存在，请检查路径！', 404);
			}
			$obj->$action_name();
			$obj->showTmp();
		} catch (Exception $e) {
			print_r($e);
			exit;
			include PATH_ROOT . '/Controllers/Index/ErrorController.php';
			$obj = new ErrorController('index', 'error', 'error');
			$obj->errorAction();
			$obj->showtmp();
		}
	
	}


}

