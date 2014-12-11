<?php

namespace Base;
abstract class Model
{
	function __construct()
	{
	    $this->init();
	}
	protected abstract function init();
}