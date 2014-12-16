<?php
/**
 * 业务模型基础类
 * @author houwei
 *
 */
namespace Base;
abstract class Model
{
	function __construct()
	{
	    $this->init();
	}
	protected abstract function init();
}