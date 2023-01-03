<?php
class app extends fw_controller
{
    public $m_core;

    public function __construct()
    {
      $this->m_core = new m_core();
      $this->initial();
      //--------------------------------------------
      $this->data["title"] = "แบบฟอร์มใบสมัคร";
      //--------------------------------------------
    }

    public function index()
    {
      $userToken = engine::user("etracking");

      $url       = "app/dashboard/" . $userToken;
      $output    = engine::api("GET", $url);

      $this->data["App"] = $output;

      $meta = array
      (
        'title'    => $this->data["title"],
        'subtitle' => "ภาพรวม",
        'page'     => "",
        'seo'      => "",
      );
      $this->theme("default", "app", "app-dashboard", $meta, $this->data);
    }


    public function powerbi()
    {
      $userToken = engine::user("etracking");

      $url       = "app/dashboard/" . $userToken;
      $output    = engine::api("GET", $url);

      $this->data["App"] = $output;

      $meta = array
      (
        'title'    => $this->data["title"],
        'subtitle' => "ภาพรวม",
        'page'     => "",
        'seo'      => "",
      );
      $this->theme("default", "app", "app-dashboardbi", $meta, $this->data);
    }

    public function assumption_cal($args)
    {
      $meta = array
      (
        'title'    => $this->data["title"],
        'subtitle' => "Continual Improvement",
        'page'     => "",
        'seo'      => "",
      );
      $this->theme("default", "app", "app-assumption-continual-calculator", $meta, $this->data);
    }


    public function assumption($args)
    {
      $suit   = $args[0];
      $number = $args[1];
      $access = $args[2];

      // ini Data
      $user_token = engine::user("etracking");

      if(isset($_SESSION["AppData"]))
      {
        $ap_token   = $_SESSION["AppData"]['ap_token'];
        $formset    = $_SESSION["AppData"]['formset'];
        $user_token = $_SESSION["AppData"]['user_token'];

        $url        = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
        $output     = engine::api("GET", $url);

        // -- Website -- //
        $this->data["Output"]       = $output;

        $this->data["Application"]  = $output['Application'];
        $this->data["Detail"]       = $output['Detail'];
        $this->data["Default"]      = $output['Default'];

        $this->data["FormSetRow"]   = $output['FormSetRow'];
        $this->data["FormSet"]      = $output['FormSet']['table'];
        $this->data["Document"]     = $output['Document'];
        $this->data["Status"]       = $output['Status'];

        $sub_page       = $output['FormSetRow']['style'];
        $foirm_type     = $output['Detail']['app_type'];

        switch ($suit)
        {
          case "dashboard":
            $meta = array
            (
              'title'    => $this->data["title"],
              'subtitle' => "Dashboard",
              'page'     => "",
              'seo'      => "",
            );
            $this->theme("default", "app", "app-assumption-dashboard", $meta, $this->data);
          break;

          case "result":
            $meta = array
            (
              'title'    => $this->data["title"],
              'subtitle' => "Result",
              'page'     => "",
              'seo'      => "",
            );
            $this->theme("default", "app", "app-assumption-result", $meta, $this->data);
          break;

          case "general":

            $meta = array
            (
              'title'    => $this->data["title"],
              'subtitle' => "General",
              'page'     => "",
              'seo'      => "",
            );
            $this->theme("default", "app", "app-assumption-general", $meta, $this->data);

          break;

          case "continual":

            $meta = array
            (
              'title'    => $this->data["title"],
              'subtitle' => "Continual Improvement",
              'page'     => "",
              'seo'      => "",
            );
            $this->theme("default", "app", "app-assumption-continual", $meta, $this->data);

          break;

          case "continual-calculator":

            $meta = array
            (
              'title'    => $this->data["title"],
              'subtitle' => "Continual Improvement",
              'page'     => "",
              'seo'      => "",
            );
            $this->theme("default", "app", "app-assumption-continual-calculator", $meta, $this->data);

          break;

          case "specific":

            //$access = $_SESSION["AppData"]['viewer'];

            if($access=="member")
            {
              $page = "app-assumption-specific-" . $number;
            }
            else if($access=="audit")
            {
              $page = "app-assumption-specific-" . $number . "-" . $access;
            }
            else
            {
              $page = "app-assumption-specific-" . $number;
            }

            $this->data["choice"] = $number;

            $meta = array
            (
              'title'    => $this->data["title"],
              'subtitle' => "Specific ข้อที่ " . $number,
              'page'     => "",
              'seo'      => "",
            );
            $this->theme("default", "app", $page, $meta, $this->data);

          break;
        }
      }
      else
      {
        header("location: /member");
      }
    }

    public function assumption_audit($args)
    {
      $ap_token   = $args[0];
      $formset    = $args[1];
      $user_token = $args[2];
      $view       = $args[3];

      $_SESSION["AppData"]['ap_token']    = $ap_token;
      $_SESSION["AppData"]['formset']     = $formset;
      $_SESSION["AppData"]['user_token']  = $user_token;
      $_SESSION["AppData"]['viewer']      = $view;

      header("location: /app/assumption/dashboard/{$ap_token}/{$formset}");

    }

    public function create($args)
    {
      // ini Data
      $app_token  = $args[0];
      $user_token = engine::user("etracking");

      if($user_token=="")
      {
        header("location: /auth/login");
      }
      else
      {
        $url       = "app/create/" . $app_token . "/" . $user_token;
        $output    = engine::api("GET", $url);
        $this->data["App"] = $output;
        header("location: /app/fill/" . $output['token'] . "/" . $output['first']);
      }
    }

    public function fill($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $viewer     = $args[2];
      $user_token = engine::user("etracking");

      $url        = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output     = engine::api("GET", $url);

      // -- Website -- //
      $this->data["Output"]       = $output;

      $this->data["Application"]  = $output['Application'];
      $this->data["Message"]      = $output['Message'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];

      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet']['table'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];

      $sub_page                   = $output['FormSetRow']['style'];
      $form_type                  = $output['Detail']['app_type'];

      $interface                  = $output['FormSetRow']['interface'];

      if($interface!="")
      {
        $interface = "-" . $interface;
      }
      else 
      {
        $interface = "";
      }

      if($form_type=="form2")
      {
        //-------
        $_SESSION["AppData"]['ap_token']    = $ap_token;
        $_SESSION["AppData"]['formset']     = $formset;
        $_SESSION["AppData"]['user_token']  = $user_token;
        $_SESSION["AppData"]['viewer']      = $viewer;
        //-------
        header("location: /app/assumption/dashboard/" . $ap_token . "/" . $formset);
        
      }
      else if($form_type=="form")
      {
        //Meta Tag
    		$meta = array
    		(
    			'title' 		=> $this->data["title"],
    			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
    			'menu' 		  => "member",
    			'page'		  => "member",
          'class'		  => "page-task",
    		);
    		$this->theme("default", "app", "app-form-" . $sub_page , $meta, $this->data);
      }
      else
      {
        //Meta Tag
    		$meta = array
    		(
    			'title' 		=> $this->data["title"],
    			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
    			'menu' 		  => "member",
    			'page'		  => "member",
          'class'		  => "page-task",
    		);
    		$this->theme("default", "app", "app-fill-" . $sub_page , $meta, $this->data);
      }
    }

    public function result($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $viewer     = $args[2];
      $user_token = engine::user("etracking");

      $url        = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output     = engine::api("GET", $url);

      // -- Website -- //
      $this->data["Output"]       = $output;

      $this->data["Application"]  = $output['Application'];
      $this->data["Message"]      = $output['Message'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];

      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet']['table'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];

      $sub_page                   = $output['FormSetRow']['style'];
      $form_type                  = $output['Detail']['app_type'];

      $interface                  = $output['FormSetRow']['interface'];

      if($interface!="")
      {
        $interface = "-" . $interface;
      }
      else 
      {
        $interface = "";
      }
      /*
      //Meta Tag
      $meta = array
      (
        'title' 		=> $this->data["title"],
        'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
        'menu' 		  => "member",
        'page'		  => "member",
        'class'		  => "page-task",
      );
      $this->theme("default", "app", "app-fill-" . $sub_page . $interface , $meta, $this->data);
      */
      
      if($form_type=="form2")
      {
        //-------
        $_SESSION["AppData"]['ap_token']    = $ap_token;
        $_SESSION["AppData"]['formset']     = $formset;
        $_SESSION["AppData"]['user_token']  = $user_token;
        $_SESSION["AppData"]['viewer']      = $viewer;
        //-------
        header("location: /app/assumption/dashboard/" . $ap_token . "/" . $formset);
        
      }
      else if($form_type=="form")
      {
        //Meta Tag
    		$meta = array
    		(
    			'title' 		=> $this->data["title"],
    			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
    			'menu' 		  => "member",
    			'page'		  => "member",
          'class'		  => "page-task",
    		);
    		$this->theme("default", "app", "app-form-result", $meta, $this->data);
      }
      else
      {
        //Meta Tag
    		$meta = array
    		(
    			'title' 		=> $this->data["title"],
    			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
    			'menu' 		  => "member",
    			'page'		  => "member",
          'class'		  => "page-task",
    		);
    		$this->theme("default", "app", "app-fill-" . $sub_page , $meta, $this->data);
      }
    }

    public function upload($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $user_token = engine::user("etracking");

      $url        = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output     = engine::api("GET", $url);

      $this->data["Application"]  = $output['Application'];
      $this->data["Message"]      = $output['Message'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];

      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];

      $sub_page                   = $output['FormSetRow']['style'];

      $GLOBALS['document']        = $this->data["Document"];

  		//Meta Tag
  		$meta = array
  		(
  			'title' 		=> $this->data["title"],
  			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
  			'menu' 		  => "member",
  			'page'		  => "member",
        'class'		  => "page-task",
  		);
  		$this->theme("default", "app", "app-upload" . $sub_page, $meta, $this->data);

    }

    public function detail($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $user_token = engine::user("etracking");

      $url       = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output    = engine::api("GET", $url);

      $this->data["Application"]  = $output['Application'];
      $this->data["Message"]      = $output['Message'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];
      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];
      $this->data["Certification"]= $output['Certification'];
      $this->data["User"]         = engine::student("profile");
      $sub_page                   = $output['FormSetRow']['style'];

      $this->data["documentAPI"]  = $output['doc_check'];
      $this->data["formAPI"]      = $output['form_check'];

  		//Meta Tag
  		$meta = array
  		(
  			'title' 		=> $this->data["title"],
  			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
  			'menu' 		  => "member",
  			'page'		  => "member",
        'class'		  => "page-task",
  		);
  		$this->theme("default", "app", "app-detail" . $sub_page, $meta, $this->data);

    }

    public function message($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $user_token = engine::user("etracking");

      $url       = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output    = engine::api("GET", $url);

      $this->data["Application"]  = $output['Application'];
      $this->data["Message"]      = $output['Message'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];
      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];
      $this->data["Certification"]= $output['Certification'];
      $this->data["User"]         = engine::student("profile");
      $sub_page                   = $output['FormSetRow']['style'];

      $this->data["documentAPI"]  = $output['doc_check'];
      $this->data["formAPI"]      = $output['form_check'];

  		//Meta Tag
  		$meta = array
  		(
  			'title' 		=> $this->data["title"],
  			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ / ข้อความ",
  			'menu' 		  => "member",
  			'page'		  => "member",
        'class'		  => "page-task",
  		);
  		$this->theme("default", "app", "app-message" . $sub_page, $meta, $this->data);

    }


    public function view($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $user_token = engine::user("etracking");

      $url       = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output    = engine::api("GET", $url);

      $this->data["Output"]       = $output;

      $this->data["Application"]  = $output['Application'];
      $this->data["Message"]      = $output['Message'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];
      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];
      $this->data["Certification"]= $output['Certification'];
      $this->data["User"]         = $output['Member'];
      $sub_page                   = $output['FormSetRow']['style'];

      $this->data["documentAPI"]  = $output['doc_check'];
      $this->data["formAPI"]      = $output['form_check'];

  		//Meta Tag
  		$meta = array
  		(
  			'title' 		=> $this->data["title"],
  			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
  			'menu' 		  => "member",
  			'page'		  => "member",
        'class'		  => "page-task",
  		);
  		$this->theme("default", "app", "app-view" . $sub_page, $meta, $this->data);

    }

    public function view_result($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $viewer     = $args[2];
      $user_token = engine::user("etracking");

      $url        = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output     = engine::api("GET", $url);

      // -- Website -- //
      $this->data["Output"]       = $output;

      $this->data["Application"]  = $output['Application'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];

      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet']['table'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];

      $sub_page                   = $output['FormSetRow']['style'];
      $form_type                  = $output['Detail']['app_type'];

      $interface                  = $output['FormSetRow']['interface'];

      if($interface!="")
      {
        $interface = "-" . $interface;
      }
      else 
      {
        $interface = "";
      }
      /*
      //Meta Tag
      $meta = array
      (
        'title' 		=> $this->data["title"],
        'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
        'menu' 		  => "member",
        'page'		  => "member",
        'class'		  => "page-task",
      );
      $this->theme("default", "app", "app-fill-" . $sub_page . $interface , $meta, $this->data);
      */
      
      if($form_type=="form2")
      {
        //-------
        $_SESSION["AppData"]['ap_token']    = $ap_token;
        $_SESSION["AppData"]['formset']     = $formset;
        $_SESSION["AppData"]['user_token']  = $user_token;
        $_SESSION["AppData"]['viewer']      = $viewer;
        //-------
        header("location: /app/assumption/dashboard/" . $ap_token . "/" . $formset);
        
      }
      else if($form_type=="form")
      {
        //Meta Tag
    		$meta = array
    		(
    			'title' 		=> $this->data["title"],
    			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
    			'menu' 		  => "member",
    			'page'		  => "member",
          'class'		  => "page-task",
    		);
    		$this->theme("default", "app", "app-view-result", $meta, $this->data);
      }
      else
      {
        //Meta Tag
    		$meta = array
    		(
    			'title' 		=> $this->data["title"],
    			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
    			'menu' 		  => "member",
    			'page'		  => "member",
          'class'		  => "page-task",
    		);
    		$this->theme("default", "app", "app-fill-" . $sub_page , $meta, $this->data);
      }
    }

    public function view_fill($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $viewer     = $args[2];
      $user_token = engine::user("etracking");

      $url        = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output     = engine::api("GET", $url);

      // -- Website -- //
      $this->data["Output"]       = $output;

      $this->data["Application"]  = $output['Application'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];

      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet']['table'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];

      $sub_page                   = $output['FormSetRow']['style'];
      $form_type                  = $output['Detail']['app_type'];

      $interface                  = $output['FormSetRow']['interface'];

      if($interface!="")
      {
        $interface = "-" . $interface;
      }
      else 
      {
        $interface = "";
      }

      if($form_type=="form2")
      {
        //-------
        $_SESSION["AppData"]['ap_token']    = $ap_token;
        $_SESSION["AppData"]['formset']     = $formset;
        $_SESSION["AppData"]['user_token']  = $user_token;
        $_SESSION["AppData"]['viewer']      = $viewer;
        //-------
        header("location: /app/assumption/dashboard/" . $ap_token . "/" . $formset);
        
      }
      else if($form_type=="form")
      {
        //Meta Tag
    		$meta = array
    		(
    			'title' 		=> $this->data["title"],
    			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
    			'menu' 		  => "member",
    			'page'		  => "member",
          'class'		  => "page-task",
    		);
    		$this->theme("default", "app", "app-view-form-" . $sub_page , $meta, $this->data);
      }
      else
      {
        //Meta Tag
    		$meta = array
    		(
    			'title' 		=> $this->data["title"],
    			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
    			'menu' 		  => "member",
    			'page'		  => "member",
          'class'		  => "page-task",
    		);
    		$this->theme("default", "app", "app-view-fill-" . $sub_page , $meta, $this->data);
      }
    }



    public function view_upload($args)
  	{
      // ini Data
      $ap_token   = $args[0];
      $formset    = $args[1];
      $user_token = engine::user("etracking");

      $url        = "app/detail/" . $ap_token . "/" . $formset . "/" . $user_token;
      $output     = engine::api("GET", $url);

      $this->data["Output"]       = $output;

      $this->data["Application"]  = $output['Application'];
      $this->data["Detail"]       = $output['Detail'];
      $this->data["Default"]      = $output['Default'];

      $this->data["FormSetRow"]   = $output['FormSetRow'];
      $this->data["FormSet"]      = $output['FormSet'];
      $this->data["Document"]     = $output['Document'];
      $this->data["Status"]       = $output['Status'];

      $sub_page                   = $output['FormSetRow']['style'];

      $GLOBALS['document']        = $this->data["Document"];

  		//Meta Tag
  		$meta = array
  		(
  			'title' 		=> $this->data["title"],
  			'subtitle'	=> "ใบสมัครที่ปรึกษา/ผู้ทวนสอบ",
  			'menu' 		  => "member",
  			'page'		  => "member",
        'class'		  => "page-task",
  		);
  		$this->theme("default", "app", "app-view-upload" . $sub_page, $meta, $this->data);

    }

    public function action($args)
	  {
        $action = $args[0];
        switch ($action)
        {
          case "save-application":
    				//
    				ob_end_clean();

            //------------------------------------------------------------------
            $ap_form_token                         = $_SESSION["Application"]['ap_token'];
            //------------------------------------------------------------------
            $ap_id                                 = $_POST["_wpcf7_form"];
    		    $ap_firstname                          = $_POST["ap_firstname"];
            $ap_lastname                           = $_POST["ap_lastname"];
            $ap_phone                              = $_POST["ap_phone"];
            $ap_citizen_number                     = $_POST["ap_citizen_number"];

            $ap_business_type                      = $_POST["ap_business_type"];
            $ap_business_area                      = $_POST["ap_business_area"];
            $ap_position                           = $_POST["ap_position"];
            $ap_email                              = $_POST["ap_email"];
            $ap_mobile                             = $_POST["ap_mobile"];
            $ap_business_name                      = $_POST["ap_business_name"];
            $ap_business_address                   = $_POST["ap_business_address"];
            $ap_business_number                    = $_POST["ap_business_number"];
            $ap_business_regdate                   = $_POST["ap_business_regdate"];
            $ap_business_budget                    = $_POST["ap_business_budget"];
            $ap_business_phone                     = $_POST["ap_business_phone"];
            $ap_business_depa_number               = $_POST["ap_business_depa_number"];
            $ap_business_province                  = $_POST["ap_business_province"];
            $ap_business_category                  = $_POST["ap_business_category"];
            $ap_business_category_other            = $_POST["ap_business_category_other"];
            $ap_business_problem                   = $_POST["ap_business_problem"];
            $ap_business_point                     = $_POST["ap_business_point"];
            $ap_business_technology_group          = $_POST["ap_business_technology_group"];
            $ap_business_technology_name           = $_POST["ap_business_technology_name"];
            $ap_business_technology_number         = $_POST["ap_business_technology_number"];
            $ap_business_technology_regcode        = $_POST["ap_business_technology_regcode"];
            $ap_business_technology_service        = $_POST["ap_business_technology_service"];
            $ap_business_technology_price          = $_POST["ap_business_technology_price"];

            $ap_business_technology_contact_name   = $_POST["ap_business_technology_contact_name"];
            $ap_business_technology_contact_phone  = $_POST["ap_business_technology_contact_phone"];
            $ap_business_technology_contact_email  = $_POST["ap_business_technology_contact_email"];

            //BU
            $aff_token          = $_POST["_wpcf7_session"];
            $memRow             = $this->m_core->getMemRow_token($aff_token);

            $ap_ref             = "1";
            $ap_ref_code        = "C";

            $today              = engine::today();
            // APP CODE ============================================================================================
            $date 							= date('Y-m-d H:i:s');
    	      $itemcode 					= $DefaultApp['app_default_code'] . $ap_ref_code;
    	      $year 							= date('Y', strtotime($date)) + 543;
    	      $year 							= substr($year, 2);
    		    $lastID 						= $this->m_core->getApplicationLastcode($itemcode,$year);
    	      $nowID							= $lastID + 1;
            $tempnum 				    = substr($lastID, $GLOBALS["Setting"]['sc_default_ap_code_digit']);

            if ($tempnum == 0)
            {
              $tempnum 			= $tempnum + 1;
            }
            else
            {
              $tempnum 			= $tempnum + 1;
            }

            $number_first   = $tempnum;
            $tempnum 				= str_pad($tempnum, $GLOBALS["Setting"]['sc_default_ap_code_digit'], '0', STR_PAD_LEFT);
            $ap_code			  = $itemcode . $year . $tempnum;

            $checkApp_citizen = $this->m_core->checkApplication_citizen($ap_citizen_number);

            if($ap_id == "")//เพิ่มแบบฟอร์มใหม่
            {
              if($checkApp_citizen)
              {
                $check = "มีเลขที่บัตรประชาชนนี้ในระบบแล้ว คุณสามารถเข้าแก้ไขข้อมูลของคุณโดยใช้ เลขที่บัตรประชาชนเป็นชื่อผู้ใช้และเบอร์โทรเป็นรหัสผ่านค่ะ";
              }
            }

            if($ap_business_category=="5")
            {
              if($ap_business_category_other=="")
              {
                $check = "เมื่อเลือก ประเภทธุรกิจ เป็น อื่นๆ ต้องระบุประเภทสมาชิกของคุณด้วยค่ะ";
              }
            }

            $app_comment  = "";
            $ap_status    = "1";

            // APP CODE ========================================================

            if($check=="")
            {
              if($ap_form_token=="")
              {
                $trace = array
        				(
        					"status"  => "false",
                  "return"  => "ไม่พบข้อมูลการทำรายการ",
        				);
              }
              else
              {
                if($ap_id == "")//เพิ่มแบบฟอร์มใหม่
                {
                  $data = array
                  (
                    // Information
                    "ap_firstname" 			   	                  => $ap_firstname,
                    "ap_lastname" 			                      => $ap_lastname,
                    "ap_phone" 			                          => $ap_phone,
                    "ap_citizen_number" 		                  => $ap_citizen_number,

                    "ap_business_type" 			   	              => $ap_business_type,
                    "ap_business_area" 			                  => $ap_business_area,
                    "ap_position" 		                        => $ap_position,
                    "ap_email" 		                            => $ap_email,
                    "ap_mobile" 			                        => $ap_mobile,
                    "ap_business_name" 			                  => $ap_business_name,
                    "ap_business_address" 				            => $ap_business_address,
                    "ap_business_number" 			                => $ap_business_number,
                    "ap_business_regdate" 			              => $ap_business_regdate,
                    "ap_business_budget" 		                  => $ap_business_budget,

                    "ap_business_phone" 		                  => $ap_business_phone,
                    "ap_business_depa_number" 		            => $ap_business_depa_number,
                    "ap_business_province" 		                => $ap_business_province,
                    "ap_business_category" 		                => $ap_business_category,
                    "ap_business_category_other" 		          => $ap_business_category_other,
                    "ap_business_problem" 		                => $ap_business_problem,
                    "ap_business_point" 		                  => $ap_business_point,
                    "ap_business_technology_group" 		        => $ap_business_technology_group,
                    "ap_business_technology_name" 		        => $ap_business_technology_name,
                    "ap_business_technology_number" 		      => $ap_business_technology_number,
                    "ap_business_technology_regcode" 		      => $ap_business_technology_regcode,
                    "ap_business_technology_service" 		      => $ap_business_technology_service,
                    "ap_business_technology_price" 		        => $ap_business_technology_price,
                    "ap_business_technology_contact_name" 		=> $ap_business_technology_contact_name,
                    "ap_business_technology_contact_phone" 		=> $ap_business_technology_contact_phone,
                    "ap_business_technology_contact_email" 		=> $ap_business_technology_contact_email,

                    // System
                    "app_comment" 		                        => $ap_status,
                    "ap_token" 		                            => $ap_form_token,
                    "ap_mode" 		                            => $ap_mode,
                    "ap_code" 			   	                      => $ap_code,
                    "ap_adddate" 				                      => $today,
                    "ap_ref" 		                              => $ap_ref,
                    "ap_type" 		                            => $_SESSION["Application"]['mode'],
                    "ap_grade" 		                            => $ap_grade,
                    "ap_status" 		                          => $ap_status,
                  );

                  $addApp     = $this->m_core->addApplication($data);
                  $member_id  = engine::user("id");
                  //Get Member
                  $dataApp = array
                  (
                    "member_id" => $member_id,
                  );

                  // Application Logs
                  //------------------------------------------------------------------------
              		engine::app_log($addApp['id'], "สมาชิก : กรอกใบสมัคร");
              		//------------------------------------------------------------------------

                  $add = $this->m_core->updateApplication($dataApp, $addApp['id']);
                  //
                  $trace = array
          				(
          					"status"    => $addApp['status'],
                    "return"    => "เพิ่มข้อมูลสำเร็จ",
                    "province"  => $ap_province,
          				);
                }
                else // แก้ไขแบบฟอร์ม
                {
                  $applicationRow  = $this->m_core->getApplicationRow_token($ap_form_token);

                  switch ($applicationRow['ap_status'])
                  {
                    case "1":

                    $app_grade   = $ap_grade;
                    $app_status  = $ap_status;
                    $app_comment .= "||- แก้ไขเอกสารยังไม่ดำเนินการ" . $applicationRow['ap_status'];

                    break;

                    case "4":

                    $app_grade   = $ap_grade;
                    $app_status  = $ap_status;
                    $app_comment .= "||- แก้ไขเอกสารยังไม่ดำเนินการ" . $applicationRow['ap_status'];

                    break;

                    default:

                    $app_grade    = $applicationRow['ap_grade'];
                    $app_status   = $applicationRow['ap_status'];
                    $app_comment .= "||- แก้ไขเอกสารดำเนินการแล้ว";
                  }

                  $data_edit = array
                  (
                    "ap_firstname" 			   	                    => $ap_firstname,
                    "ap_lastname" 			                        => $ap_lastname,
                    "ap_phone" 			                            => $ap_phone,
                    "ap_citizen_number" 		                    => $ap_citizen_number,

                    "ap_business_type" 			   	                => $ap_business_type,
                    "ap_business_area" 			                    => $ap_business_area,
                    "ap_position" 		                          => $ap_position,
                    "ap_email" 		                              => $ap_email,
                    "ap_mobile" 			                          => $ap_mobile,
                    "ap_business_name" 			                    => $ap_business_name,
                    "ap_business_address" 				              => $ap_business_address,
                    "ap_business_number" 			                  => $ap_business_number,
                    "ap_business_regdate" 			                => $ap_business_regdate,
                    "ap_business_budget" 		                    => $ap_business_budget,

                    "ap_business_phone" 		                    => $ap_business_phone,
                    "ap_business_depa_number" 		              => $ap_business_depa_number,
                    "ap_business_province" 		                  => $ap_business_province,
                    "ap_business_category" 		                  => $ap_business_category,
                    "ap_business_category_other" 		            => $ap_business_category_other,
                    "ap_business_problem" 		                  => $ap_business_problem,
                    "ap_business_point" 		                    => $ap_business_point,
                    "ap_business_technology_group" 		          => $ap_business_technology_group,
                    "ap_business_technology_name" 		          => $ap_business_technology_name,
                    "ap_business_technology_number" 		        => $ap_business_technology_number,
                    "ap_business_technology_regcode" 		        => $ap_business_technology_regcode,
                    "ap_business_technology_service" 		        => $ap_business_technology_service,
                    "ap_business_technology_price" 		          => $ap_business_technology_price,
                    "ap_business_technology_contact_name" 		  => $ap_business_technology_contact_name,
                    "ap_business_technology_contact_phone" 		  => $ap_business_technology_contact_phone,
                    "ap_business_technology_contact_email" 		  => $ap_business_technology_contact_email,
                    //------------------ System
                    "ap_updatedate" 				                    => $today,
                    "app_comment" 		                          => $app_comment,
                    "ap_status" 		                            => $app_status,
                  );

                  $update = $this->m_core->updateApplication($data_edit, $applicationRow['ap_id']);

                  //Application Logs
                  //------------------------------------------------------------------------
                  engine::app_log($applicationRow['ap_id'], "สมาชิก : แก้ไขใบสมัคร");
                  //------------------------------------------------------------------------

                  $trace = array
                  (
                    "status"    => $update,
                    "logic"     => "upload",
                    "return"    => "แก้ไขข้อมูลสำเร็จ",
                  );
                }
              }
            }
            else
            {
              $trace = array
              (
                "status"  => "false",
                "return"  => $check,
              );
            }

    				echo json_encode($trace, JSON_UNESCAPED_UNICODE);

    			break;

          case "build-application":

    				ob_end_clean();

            if($_SESSION["Application"]['ap_token']=="" || $_SESSION["Application"]['ap_token'] ==NULL)
            {
              $token = engine::createApplicationToken("20");
              $_SESSION["Application"]['ap_token'] = $token;
            }

            //----------------------------------------------------------------
            $trace = array
            (
              "status"  => "true",
              "return"  => "สร้างแบบคำขอสำเร็จ",
            );
            echo json_encode($trace, JSON_UNESCAPED_UNICODE);

          break;

          case "fill-application":

    				ob_end_clean();
            $checkUploadFiles = tracking::document();
            echo json_encode($checkUploadFiles, JSON_UNESCAPED_UNICODE);

          break;

          case "upload-application":

    				ob_end_clean();
            $checkUploadFiles = tracking::document();
            echo json_encode($checkUploadFiles, JSON_UNESCAPED_UNICODE);

          break;

          case "confirm-application":

    				ob_end_clean();

            $ap_form_token   = $_SESSION["Application"]['ap_token'];
            $applicationRow  = $this->m_core->getApplicationRow_token($ap_form_token);

            $trace = array
            (
              "status"  => "true",
              "return"  => "ยืนยันข้อมูลแบบคำขอของคุณเรียบร้อยแล้ว",
              "ap_code" => $applicationRow['ap_code'],
            );

            echo json_encode($trace, JSON_UNESCAPED_UNICODE);

          break;

          case "upload-single-document":
    				//
    				ob_end_clean();

    		    $iamgeraw       = $_POST["images"];
            $type           = $_POST["doctype"];
            $ap_form_token  = $_SESSION["Application"]['ap_token'];
            $today          = engine::today();

            //ตรวจสอบว่ามี Application อยู่ในฐานข้อมุลหรือยัง
            $CheckApplication = $this->m_core->checkApplicationExits($ap_form_token);

            if($CheckApplication=="" || $CheckApplication=NULL)
            {
              //Add
              $data = array
              (
                "ap_token" 		=> $ap_form_token,
                "ap_adddate" 	=> $today,
                "ap_ref" 		  => $_SESSION["Application"]['ap_token'],
                "ap_type" 		=> $_SESSION["Application"]['mode'],
              );

              $addApplication = $this->m_core->addApplication($data);
            }

            $ap_uploaddate  = $today;

            $applicationRow = $this->m_core->getApplicationRow_token($ap_form_token);

            //------------------------------------------------------------------

            $check = "";

             if($iamgeraw=="")
             {
               $check = "ไม่พบไฟล์เอกสาร</br>กรุณาเลือกเอกสาร";
               $logic = "";
             }

             if($applicationRow['ap_status']=="1" || $applicationRow['ap_status'] =="3" || $applicationRow['ap_status']=="4")
             {
             }
             else
             {
               //$check = "ไม่สามารถแก้ไขข้อมูลได้ในระหว่างการตรวจสอบ";
               //$logic = "back";
             }

            if($check=="")
            {
              //----------------------------------------------------------------------------------------------------------------------------------------------------------------------
              $filetype	              = engine::RetrieveExtension($iamgeraw);
              $filename	              = $type . "." . $filetype;
              $dirpath                = "/var/www/weiscp.fti.or.th/html/storage/files/client/voucher/document/" .  $ap_form_token;
              is_dir($dirpath) || mkdir($dirpath, 0755, true);
              $output_file            = "/var/www/weiscp.fti.or.th/html/storage/files/client/voucher/document/" .  $ap_form_token . "/" . $filename;
              $save_document          = "voucher/document/" . $ap_form_token . "/" . $filename;

  						 switch ($filetype)
  						 {
  							case 'jpg':
  								$image =  imagecreatefromjpeg($iamgeraw);
  							break;
  							case 'png':
  								$image =  imagecreatefrompng($iamgeraw);
  							break;
  							case 'gif':
  								$image =  imagecreatefromgif($iamgeraw);
  							break;
  						}
  						imagejpeg($image, $output_file, 100);
  						imagedestroy($image);
              //----------------------------------------------------------------------------------------------------------------------------------------------------------------------

              if($type=="citizen")
              {
                $data = array
                (
                  //------------------ Information
                  "ap_document_citizen" 		=> $save_document,
                  //------------------ System//------------------
                  "ap_uploaddate" 				  => $ap_uploaddate,
                );
              }
              else if($type=="home")
              {
                $data = array
                (
                  //------------------ Information
                  "ap_document_home" 			  => $save_document,
                  //------------------ System//------------------
                  "ap_uploaddate" 				  => $ap_uploaddate,
                );
              }
              else if($type=="bank_front")
              {
                $data = array
                (
                  //------------------ Information
                  "ap_document_bank_front" 	=> $save_document,
                  //------------------ System//------------------
                  "ap_uploaddate" 				  => $ap_uploaddate,
                );
              }

              $doc_index  = array_keys(array_combine(array_keys($GLOBALS['document']), array_column($GLOBALS['document'], 'code')), $type);
              $document   = $GLOBALS['document'][$doc_index[0]];

              //Application Logs
              //------------------------------------------------------------------------
              engine::app_log($applicationRow['ap_id'], "สมาชิก : อัพโหลด : {$document['name']}");
              //------------------------------------------------------------------------

              $add = $this->m_core->updateApplication($data, $applicationRow['ap_id']);
              //----------------------------------------------------------------
      				$trace = array
      				(
                "status"  => "true",
                "code"    => $ap_form_token,
                "image"   => "https://weiscp.fti.or.th/img.php?file=" . $save_document . "&v=" . time(),
                "return"  => "อัพโหลดไฟล์สำเร็จ",
      				);
            }
            else
            {
              //----------------------------------------------------------------
      				$trace = array
      				(
      					"status"  => "false",
                "logic"   => $logic,
                "return"  => $check,
      				);
            }
    				echo json_encode($trace, JSON_UNESCAPED_UNICODE);

    			break;

          case "mkdir":
            echo "mkdir";
            $folder = '/var/www/weiscp.fti.or.th/html/storage/files/client/voucher/';

            mkdir($folder, 0755, true);

          break;

          /*

          || API CALLBACK FUNCTION ************************************************

          */

          case "advance-search":
            //
            ob_end_clean();

            $query    = $_POST['search'];
            $app      = $_POST['app'];
            $status   = $_POST['status'];
            $owner    = $_POST['owner'];
            $formset  = $_POST['formset'];

            $data = array
            (
              'query'    => $query,
              'app'      => $app,
              'status'   => $status,
              'owner'    => $owner,
              'formset'  => $formset,
            );

            $url    = 'app/search/';
            $signup = engine::api("POST", $url, $data);
            $trace = utf8_decode(urldecode($signup));

    				echo $trace;

          break;

          case "upload-multiple-document":
  				//
  				ob_end_clean();

  		    $array          = $_POST['myarray'];
          $type           = $_POST['type'];
          $ap_form_token  = $_POST['token'];

          $data = array
          (
            'myarray'  => $array,
            'type'     => $type,
            'token'    => $ap_form_token,
          );

          $url    = 'app/upload-document/';
          $signup = engine::api("POST", $url, $data);

          $trace = $signup;
  				echo json_encode($signup, JSON_UNESCAPED_UNICODE);

    			break;

          case "upload-single-file":

            ob_end_clean();

            $form_application = $_POST['form_application'];
            $form_reference   = $_POST['form_reference'];
            $form_token       = $_POST['form_token'];
            $form_app_token   = $_POST['form_app_token'];
            $form_member      = $_POST['form_member'];
            $field_code       = $_POST['field_code'];

            $set              = $_POST['set'];
            $field            = $_POST['field'];
            $app              = $_POST['app'];

            foreach ($_FILES['file']['name'] as $keys => $values) 
            {
              $fileName     = $_FILES['file']['name'][$keys];
              $path_info    = pathinfo($fileName);
              $newFilename  = uniqid() . "." . $path_info['extension'];
              $fileContent  = $_FILES['file']['tmp_name'][$keys];
              $base64file   = base64_encode(file_get_contents($_FILES['file']['tmp_name'][$keys]));
            }
            
            $data = array
            (
              'file'        => $base64file,
              'real_name'   => $fileName,
              'ext'         => $path_info['extension'],
              'name'        => $newFilename,

              'form_application'  => $form_application,
              'form_reference'    => $form_reference,
              'form_token'        => $form_token,
              'form_app_token'    => $form_app_token,
              'form_member'       => $form_member,
              'field_code'        => $field_code,

              'set'   => $set,
              'field' => $field,
              'app'   => $app,
            );

            $url    = 'app/upload-file/';
            $upload = engine::api("POST", $url, $data);

            echo json_encode($upload, JSON_UNESCAPED_UNICODE);

    			break;

          case "delete-file-content":
    				//
    				ob_end_clean();

    		    $token = $_POST['token'];
            $data  = array
            (
              'token'  => $token,
            );

            $url    = 'app/delete-file/';
            $delete = engine::api("POST", $url, $data);

    				echo json_encode($delete, JSON_UNESCAPED_UNICODE);

          break;

          case "get-file-content":
    				//
    				ob_end_clean();

    		    $field  = $_POST['field'];
            $app    = $_POST['app'];
            $set    = $_POST['set'];
            $member = $_POST['member'];

            $data  = array
            (
              'field'   => $field,
              'app'     => $app,
              'set'     => $set,
              'member'  => $member,
            );

            $url      = 'app/get-file-list/';
            $filelist = engine::api("POST", $url, $data);

    				echo json_encode($filelist, JSON_UNESCAPED_UNICODE);

          break;

          case "delete-document":
    				//
    				ob_end_clean();

    		    $image = $_POST['image'];
            $data  = array
            (
              'image'  => $image,
            );

            $url    = 'app/delete-document/';
            $signup = engine::api("POST", $url, $data);

            $trace = $signup;
    				echo json_encode($signup, JSON_UNESCAPED_UNICODE);

          break;

          case "save-form":

            ob_end_clean();

            $form_application   = $_POST['form_application'];
            $form_token         = $_POST['form_token'];
            $form_reference     = $_POST['form_reference'];
            $member_id          = $_POST['form_member'];

            $data  = array
            (
              'form_application'  => $form_application,
              'form_token'        => $form_token,
              'form_reference'    => $form_reference,
              'form_member'       => $member_id,
              'dataarray'         => $_POST,
            );

            $url    = 'app/save-form-single/';
            $trace  = engine::api("POST", $url, $data);

    				echo json_encode($trace, JSON_UNESCAPED_UNICODE);

          break;

          case "save-form-multiple":

            ob_end_clean();

            $form_application   = $_POST['form_application'];
            $form_token         = $_POST['form_token'];
            $form_reference     = $_POST['form_reference'];
            $member_id          = $_POST['form_member'];

            $data  = array
            (
              'form_application'  => $form_application,
              'form_token'        => $form_token,
              'form_reference'    => $form_reference,
              'form_member'       => $member_id,
              'dataarray'         => $_POST,
            );

            $url    = 'app/save-form-multiple/';
            $trace  = engine::api("POST", $url, $data);

    				echo json_encode($trace, JSON_UNESCAPED_UNICODE);

          break;

          case "delete-form-multiple":

            ob_end_clean();

            $token   = $_POST['token'];

            $data  = array
            (
              'token'  => $token,
            );

            $url    = 'app/delete-form-multiple/';
            $trace  = engine::api("POST", $url, $data);

    				echo json_encode($trace, JSON_UNESCAPED_UNICODE);

          break;

          case "delete-form-relate":

            ob_end_clean();

            $token   = $_POST['token'];

            $data  = array
            (
              'token'  => $token,
            );

            $url    = 'app/delete-form-relate/';
            $trace  = engine::api("POST", $url, $data);

    				echo json_encode($trace, JSON_UNESCAPED_UNICODE);

          break;

          case "save-form-relate":

            ob_end_clean();

            $app_id     = $_POST['app'];
            $formset    = $_POST['formset'];
            $owner_id   = $_POST['owner'];
            $mem_id     = $_POST['member'];

            $data  = array
            (
              'app_id'     => $app_id,
              'formset'    => $formset,
              'owner_id'   => $owner_id,
              'mem_id'     => $mem_id,
            );

            $url    = 'app/save-form-relate/';
            $trace  = engine::api("POST", $url, $data);

    				echo json_encode($trace, JSON_UNESCAPED_UNICODE);

          break;

          case "get-district":

            ob_end_clean();

            $province_id  = $_POST['province'];
            $district_id  = $_POST['district'];
            $check        = "";

            $data  = array
            (
              'province'  => $province_id,
              'district'  => $district_id,
            );

            $url    = 'app/get-district/';
            $trace  = engine::api("POST", $url, $data);

    				echo $trace;

        break;

        case "get-subdistrict":

          ob_end_clean();

          $district_id     = $_POST['district'];
          $subdistrict_id  = $_POST['subdistrict'];
          $check           = "";

          $data  = array
          (
            'district'     => $district_id,
            'subdistrict'  => $subdistrict_id,
          );

          $url    = 'app/get-subdistrict/';
          $trace  = engine::api("POST", $url, $data);

          echo $trace;

      break;

      case "submit-application":

        ob_end_clean();

        $application   = $_POST['token'];
        $user_token    = engine::user("etracking");

        $data  = array
        (
          'application'  => $application,
          'user'         => $user_token,
        );

        $url    = 'app/submit-application/';
        $trace  = engine::api("POST", $url, $data);

        echo json_encode($trace, JSON_UNESCAPED_UNICODE);

      break;

      case "get-message":

          ob_end_clean();

          $url    = 'app/get-message/';
          $trace  = engine::api("POST", $url, $_POST);

          echo json_encode($trace, JSON_UNESCAPED_UNICODE);

      break;

      case "get-message-detail":

          ob_end_clean();

          $url    = 'app/get-message-detail/';
          $trace  = engine::api("POST", $url, $_POST);

          echo json_encode($trace, JSON_UNESCAPED_UNICODE);

      break;

      case "send-message":

          ob_end_clean();

          $url    = 'app/send-message/';
          $trace  = engine::api("POST", $url, $_POST);

          echo json_encode($trace, JSON_UNESCAPED_UNICODE);

      break;

      case "reply-message":

          ob_end_clean();

          $url    = 'app/reply-message/';
          $trace  = engine::api("POST", $url, $_POST);

          echo json_encode($trace, JSON_UNESCAPED_UNICODE);

      break;

      /*

      || API CALLBACK FUNCTION ************************************************

      */

		}
	}

}
?>
