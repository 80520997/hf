<?php

namespace Models;
use Base\Model;

class Test extends Model {

	private $_tname = "test";


	public function init() {
		
	}

	public function testdb() {
		
		//强推荐使用这种方式。虽然麻烦一点但是却带来了安全
		$sth = \Std::getPdo()->prepare("SELECT * FROM $this->_tname WHERE ?=?");
		$sth->execute(array(1,1));
		$item = $sth->fetchAll();
		
		//不要使用这种方式 $item = \Std::getPdo()->query("SELECT * FROM $this->_tname WHERE 1=1")->fetchAll();
		
		if ($item) {
			return $item;
		} else {
			return array();
		}
	}
	
	public function testRedis() {
		$redis = \Std::getRedis();
		$redis->set("test","redis 测试数据");	
		return $redis->get("test");		
	}
	




}