<?php
/**
 * 公用session类
 * 
 */
class Session{
    //是否已经初始化过了
	private static $init = false;
    //名称空间(SESSION)
	private $nameSpace;
    private $lifetime_key = "__lifetime";
	private $pattern = array(
			'session_name'	=> 'HSESSION',
			//SESSION域
			'domain'		=> null,
			//SESSION生存时间
			'lifetime'		=> 0
		);


    function __construct($space = 'default', $option = array())
	{
        if(!self::$init)
        {
            $this->init($option);
        }
        $this->nameSpace = $space;
	}
    
    private function init($option){
		$tmp = array_merge($this->pattern,$option);
		foreach($this->pattern as $k => $v)
		{
			switch($k)
			{
				case 'session_name':
					@ini_set('session.name',$tmp[$k]);
					break;
				case 'lifetime':
					@session_set_cookie_params($tmp[$k],'/',$tmp['domain']);
					break;
			}
		}
        $this->pattern = $tmp;
        
		//可以通过GET来初始化SESSION ID
		if(!session_id() || isset($_GET[$this->pattern['session_name']]))
		{
          if(isset($_GET[$this->pattern['session_name']]))
          {
            session_id($_GET[$this->pattern['session_name']]);
          }
          session_start();
		}
		self::$init = true;
	}	
   
	public function __set($name, $value) {
		$this->set($name, $value);
	}
   
	public function __get($name) {
		return $this->get($name);
	}
	//输出所有值
	public function __toString()
	{
		return print_r($_SESSION,true);
	}
	
	
	public function get($name){
		
		if(isset($_SESSION[$this->nameSpace][$this->lifetime_key][$name]) && $_SESSION[$this->nameSpace][$this->lifetime_key][$name] < time())
		{
			return null;
		}
		return isset($_SESSION[$this->nameSpace][$name]) ? $_SESSION[$this->nameSpace][$name] : null;
	}
   
	public function set($name, $value, $lifetime = 0){
		if($lifetime)
		{
			if(!isset($_SESSION[$this->nameSpace][$this->lifetime_key]))
			{
				$_SESSION[$this->nameSpace][$this->lifetime_key] = array();
			}
			if($lifetime === null && isset($_SESSION[$this->nameSpace][$this->lifetime_key][$name]))
			{
				unset($_SESSION[$this->nameSpace][$this->lifetime_key][$name]);
			}
			$_SESSION[$this->nameSpace][$this->lifetime_key][$name] = $lifetime;
		}
		$_SESSION[$this->nameSpace][$name] = $value;
	}

	public function clean(){
		session_destroy();
		session_unset();
        setcookie($this->pattern['session_name'], null, 0, '/');
	}
}