<?php

class error extends fw_controller 
{
    public $m_core;

    public function __construct() 
	{
		//--------------------------------------------
		$this->data["title"] = "หน้าหลัก";
		//--------------------------------------------
    }
	
    public function index() 
	{
		//--------------------------------------------
		$mtitle 		= $this->data["title"];
		$subtitle 	= "ยินดีต้อนรับ";
		//--------------------------------------------
	
		$this->theme("default", "error", "index", $mtitle, $subtitle, $this->data);
    }
	
}

?>
