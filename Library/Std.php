<?php
/**
 * 这是一个共用方法类，这里之所以没有使用工厂模式是应为它对IDE的智能提示不有好
 * 开发者可以自己根据需要添加如mongo这类的方法
 * 
 * 
 * @author houwei
 *
 */

class Std
{
	
	
	
	/**
	* 获取pdo链接句柄
	*
	*
	*
	* @return PDO
	*/
	static function getPdo($dbName = 'default')
	{
		static $dbs = array();
		if(!empty($dbs[$dbName]))
		{
			return $dbs[$dbName];
		}

		$config = Std::getConfig("db");
				
		if(empty($config[$dbName])) {
			die('pdo config error');
		}
		
		$config = $config[$dbName];

		$dbs[$dbName] = new PDO(
			$config['host'],
			$config['user'],
			$config['pass'],
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
		);

		//fetch的时候默认返回数组
		$dbs[$dbName]->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $dbs[$dbName];
	}


	/**
	* 获取Redis链接句柄
	* 这个方法没有考虑分片问题。因为截止到写换个框架的时候redis3已经发布。而人家自己已经自带集群了
	* @param string $dbName 
	*
	* @return Redis
	*/
	static function getRedis($dbName = 'default')
	{
		static $dbs = array();
		if(!empty($dbs[$dbName])) return $dbs[$dbName];
		$config = Std::getConfig("redis");
		if(empty($config[$dbName])) {
			die('redis config error');
		}
		
		$config = $config[$dbName];
		$dbs[$dbName] = new Redis();
		if(!$dbs[$dbName]->connect($config['host'], $config['port'])) {
			exit('Redis connect error');
		}
		return $dbs[$dbName];
	}
	
	
	//获取配置信息
	static function getConfig($key = null)
	{
		if($key === null)
			return $GLOBALS ['config'];
		return empty($GLOBALS ['config'][$key]) ? null : $GLOBALS ['config'][$key];
	}
	
	
}