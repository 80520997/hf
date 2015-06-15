<?php
namespace Controllers\Index;
use Base\Controller;
class IndexController extends Controller
{
	//这个方法会最先被执行
    function init(){}
	
	/**
	 * 模版测试
	 */
	function indexAction(){	
		$this->View->name = "hf";
		//echo	$this->View->setTmp('Index/index');

	}
	
	/**
	 * mysql测试
	 */
	function testdbAction() {
		
		$mod = new \Models\Test();
		$item = $mod->testdb();

		print_r($item);
		exit;
	}
	
	/**
	 * redis测试
	 */
	function testredisAction() {
	
		$mod = new \Models\Test();
		$item = $mod->testRedis();
		print_r($item);
		exit;
	}
	
}
