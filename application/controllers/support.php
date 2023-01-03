<?php

class support extends fw_controller 
{
    public $m_core;

    public function __construct() 
	{
        $this->m_core = new m_core();
        $this->initial();	
		//--------------------------------------------
		$this->data["title"] = "ความช่วยเหลือ";
		//--------------------------------------------
    }
	
    public function index() 
	{
		//--------------------------------------------
		$mtitle 		= $this->data["title"];
		$subtitle 	= "ความช่วยเหลือ";
		//--------------------------------------------
		
		$this->theme("default", "support", "index", $meta, $this->data);
    }
}
?>
