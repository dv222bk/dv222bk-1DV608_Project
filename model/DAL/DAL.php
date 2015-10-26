<?php

namespace model\DAL;

abstract class DAL {
	
	protected function GetMysqli() {
		return new \mysqli('localhost', 'root', '', '1dv608_project');
	}
}
