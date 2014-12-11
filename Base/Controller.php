<?php

/* Description:控制层基类
 * Encoding : UTF-8
 * Created on : 2012/9/5
 * Update : 2014/12/4
 * Author : 侯伟 
 */

namespace Base;
use Base\View;
abstract class Controller {
    /**
     * @var View
     */
    public $View;
    
    /**
     * @var string
     */
    private $_modules;
   
    /**
     * @var string
     */
    private $_controller;
    
    /**
     * @var string
     */
    private $_action;

    function __construct($modules, $controller, $action) {
		$this->_modules = $modules;
		$this->_controller = $controller;
		$this->_action = $action;
		$this->View = new View($modules, $controller, $action);
		$this->init();
    }

    /**
     * 子类必须实现此方法
     * @param void
     * @return void
     */
    protected abstract function init();
    
    /**
     * 获取动作名
     * @return string 
     */
    protected function getModName() {
		return $this->_modules;
    }
    
    /**
     * 获取动作名
     * @param string 
     */
    protected function getCtlName() {
		return $this->_controller;
    }
    
    /**
     * 获取动作名
     * @param string 
     */
    protected function getActName() {
		return $this->_action;
    }

    /**
     * 获取请求URL路径
     * 
     */
	protected function getRqPath() {
		return '/'.$this->_modules.'/'.$this->_controller.'/'.$this->_action;
	}


    /**
     * 加载模板文件
     */
    public function showtmp() {
		$this->View->showtmp();
    }

    /**
	* 显示一条信息然后跳转(这个方法以后可能去去掉)
	*
	*/
	public function showmsg($msg, $gourl = null, $js = '') {
		if($gourl == null) {
			$gourl = $_SERVER['HTTP_REFERER'];
		}
		$this->View->msg = $msg;
		$this->View->gourl = $gourl;
		$this->View->js = $js;
		if($this->getModName() == 'admin') {
			$this->View->setTmp('admin/login/showmsg');
		} else {
			$this->View->setTmp('user/showmsg');
		}
		$this->View->showtmp();
		exit;
    }

    /**
     * 取得$_POST变量的某个值
     * @param string $key $_POST 变量的建
     */
    protected function getPost($key = null, $default = null) {
		return $this->_getParam('_POST', $key, $default);
    }

    /**
     * 取得$_GET变量的某个值
     * @param string $key $_GET 变量的建
     */
    protected function getGet($key = null, $default = null) {
		return $this->_getParam('_GET', $key, $default);
    }

    /**
     * 取得$_REQUEST变量的某个值
     * @param string $key $_REQUEST 变量的建
     */
    protected function getParam($key = null, $default = null) {
		$_REQUEST;//不加这个返回值会是空的
		return $this->_getParam('_REQUEST', $key, $default);
    }

    /**
     * 
     * @param string $t 全局变量或数组的名称
     * @param string $key  变量的建
     */
    private function _getParam($t, $key, $default) {
		$v = &$GLOBALS[$t];
		if (!$key) {
			return $v;
		}
		return isset($v[$key]) ? $v[$key] : $default;
    }

	/**
	* 跨域写cookie时使用
	*
	*
	*/
    protected function p3p() {
		header('P3P: CP="CAO DSP COR CUR ADM DEV TAI PSA PSD IVAi IVDi CONi TELo OTPi OUR DELi SAMi OTRi UNRi PUBi IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE GOV"');
    }

}
