<?php
/**
 * 模板基础类
 * 
 * 
 */

namespace Base;
final class View {
	private $template_name = null;

	
	//构造函数，实例化该类时执行
	public function __construct($modules, $controller, $action) {
		$this->template_name = $modules.'/'.$controller.'/'.$action;
	}
	//设置私有成员变量
	public function __set($name, $value) {
		$this->$name = $value;
	}
	
	//获取私有成员变量
	public function __get($name) {
		return isset($this->$name) ? $this->$name : null;
	}
	
	
	/**
	 * 过滤HTML字符
	 * 
	 */
	public function escape($str) {
	    return htmlspecialchars($str);
	}


	/**
	 * 返回模版解析后的内容
	 * @param void
	 * @return string
	 * @throws \Exception
	 */
	public function showtmp() {
		if(empty($this->template_name))
		{
			return ;
		}
		$f = PATH_ROOT.'/View/'. strtolower($this->template_name).'.php';
		if(!is_file($f)) {
			throw new \Exception("模板".$f."不存在");
		}

		include $f;
	}
	
	/**
	 * 自定义模版
	 * @param string $tmp
	 * @return void
	 */
	public function setTmp($tmp = null) {
		if($tmp == null) {
		    $this->template_name = $tmp;
		    return ;
		}
		$path = substr($this->template_name, 0, strpos($this->template_name,'/') + 1);
		$this->template_name = $path.$tmp;
	}

	/**
	 * 加载额外模版
	 * 
	 */
	public function reader($tmp = null) {
		
		if(!$tmp || !$this->template_name) {
			return ;
		}
		$path = substr($this->template_name, 0, strpos($this->template_name,'/') + 1);
		include_once PATH_ROOT.'/View/'.$path.$tmp.'.php';
	}
}   