<?php

class member extends fw_controller
{
  public $m_core;
  public function __construct()
  {
    $this->m_core = new m_core();
    $this->initial();
    engine::ini();
    $this->data["title"] = "บริการสมาชิก";
  }

  public function index($args)
  {
    engine::session();
    
    $userToken = engine::user("etracking");
    $url       = "app/dashboard/" . $userToken;
    $output    = engine::api("GET", $url);
    $this->data["App"] = $output;

    /*

    //--------------------------------------------
		$url = "lesson/list";
		//---------------- get data -----------------//
		$course = engine::api("GET", $url);

		$this->data["Course"]['lesson']	        = $course['lesson'];
    $this->data["Course"]['public_lesson']	= $course['public_lesson'];
    $this->data["Course"]['central_lesson']	= $course['central_lesson'];

		$this->data["Course"]['department']	    = $course['department'];
		$this->data["Course"]['class']	        = $course['class'];
		$this->data["Course"]['type']	          = $course['type'];

		$this->data["Search"]['filter']         = "";
		$this->data["Search"]['item']           = "";

    */


    //--------------------- ini ----------------------//
    $meta = array
    (
    'title' 		=> $this->data["title"],
    'subtitle' 	=> "ข้อมูลสมาชิก",
    'page' 		  => "",
    'seo' 			=> "",
    );
    $this->theme("default", "member", "dashboard", $meta, $this->data);
  }

  public function assignment($args)
  {
    engine::session();
    
    $userToken = engine::user("etracking");
    $url       = "app/dashboard/" . $userToken;
    $output    = engine::api("GET", $url);
    $this->data["App"] = $output;

    //--------------------- ini ----------------------//
    $meta = array
    (
    'title' 		=> $this->data["title"],
    'subtitle' 	=> "รายชื่อโรงงาน",
    'page' 		  => "",
    'seo' 			=> "",
    );
    $this->theme("default", "member", "assignment", $meta, $this->data);
  }

  public function profile($args)
  {
    engine::session();

    $userToken = engine::user("etracking");
    $url       = "app/dashboard/" . $userToken;
    $output    = engine::api("GET", $url);
    $this->data["App"] = $output;

    /*
    //--------------------------------------------
		$url = "lesson/list";
		//---------------- get data -----------------//
		$course = engine::api("GET", $url);

		$this->data["Course"]['lesson']	        = $course['lesson'];
    $this->data["Course"]['public_lesson']	= $course['public_lesson'];
    $this->data["Course"]['central_lesson']	= $course['central_lesson'];

		$this->data["Course"]['department']	    = $course['department'];
		$this->data["Course"]['class']	        = $course['class'];
		$this->data["Course"]['type']	          = $course['type'];

		$this->data["Search"]['filter']         = "";
		$this->data["Search"]['item']           = "";

    $student = engine::student("id");

    // Student Course
    $course = engine::api("GET", "user/permission/" . $student);
    $this->data["Lesson"]	= $course;

    // Student Invoice
    $order = engine::api("GET", "user/invoice/" . $student);
    $this->data["Order"]	= $order;

    // Student Overview
    $overview = engine::api("GET", "user/dashboard/" . $student);
    $this->data["Overview"] = $overview;

    $this->data["Student"] = engine::student("profile");

    */


    //--------------------- ini ----------------------//
    $meta = array
    (
      'title' 		=> $this->data["title"],
      'subtitle' 	=> "ข้อมูลสมาชิก",
      'page' 		  => "",
      'seo' 			=> "",
    );
    $this->theme("default", "member", "profile", $meta, $this->data);
  }
}

?>
