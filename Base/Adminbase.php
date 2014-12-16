<?php

/**
 * Description:扩展测试基类
 * Created on : 2014-12-9 
 */
namespace Base;
use Base\Controller;
class Adminbase extends Controller {

	const PAGE_ROWS = 20; //后台分页每页个数 

	protected $s = null;

	/**
	 * 目前该处用于控制非登录状态不可对后台操作
	 */

	function init() {
		/**
		 * 这里可以判断用户是否有登录权限等
		 * 
		 */
	}

	

	/**
	 * 更友好的打印信息
	 */
	public function dump($vars, $label = '', $return = false) {
		header("Content-Type:text/html; charset=utf-8");
		if (ini_get('html_errors')) {
			$content = '';
			if ($label != '') {
				$content .= "<br/><br/><br/><strong>{$label}</strong>\n";
			}
			$content .= "<pre style=\"background-color: white;\">" . htmlspecialchars(var_export($vars, true)) . "</pre>";
		} else {
			$content = $label . " :<br/>\n--------<br/>\n" . var_dump($vars, true) . "\n<hr/>\n";
		}
		if ($return) {
			return $content;
		}
		echo $content;
		return null;
	}





}

