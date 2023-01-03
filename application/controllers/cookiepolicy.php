<?php

class cookiepolicy extends fw_controller
{
  public $m_core;
  public function __construct()
  {
    $this->m_core = new m_core();
    $this->initial();
    engine::ini();
    $this->data["title"] = "หน้า";
  }

  public function index($args)
  {
    $meta = array
    (
      'title' 		=> $this->data["title"],
      'subtitle' 	=> "หน้า",
      'page' 		  => "",
      'seo' 			=> "",
    );
    $this->theme("default", "page", "cookiepolicy", $meta, $this->data);
  }
}

?>
