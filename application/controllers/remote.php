<?php

class remote extends fw_controller
{
    public $m_core;

    public function __construct()
    {
      // Mcore
      $this->m_core = new m_core();

      // INI
      $this->initial();
      engine::ini();
      $this->data["title"] = "Eco Factory";
    }

    public function index()
    {
      $url        = "cms/page/app-banner";
      $postRow    = engine::api("GET", $url);
      $this->data["Banner"] = $postRow;

      $url        = "cms/page/app-menu";
      $postRow    = engine::api("GET", $url);
      $this->data["Menu"] = $postRow;
      // Meta
      $meta = array(
        'title'     => $this->data["title"],
        'subtitle'  => "Dashboard",
        'theme'     => "custom",
        'page'      => "",
        'seo'       => "",
      );

      $this->theme("app", "remote", "dashboard", $meta, $this->data);
    }

    public function login()
    {
      // Meta
      $meta = array(
        'title'     => $this->data["title"],
        'subtitle'  => "เข้าสู่ระบบ",
        'theme'     => "custom",
        'page'      => "",
        'seo'       => "",
      );

      $this->theme("app", "remote", "login", $meta, $this->data);
    }

    public function register()
    {
      // Meta
      $meta = array(
        'title'     => $this->data["title"],
        'subtitle'  => "ลงทะเบียนสมาชิกใหม่",
        'theme'     => "custom",
        'page'      => "",
        'seo'       => "",
      );

      $this->theme("app", "remote", "register", $meta, $this->data);
    }

    public function member($args)
    {
      $item = $args[0];
      
      engine::appSession();
      if(isset($item))
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "หลักเกณฑ์",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "member-detail", $meta, $this->data);
      }
      else 
      {
        $userToken = engine::user("etracking");
        $url       = "app/dashboard/" . $userToken;
        $output    = engine::api("GET", $url);
        $this->data["App"] = $output;

        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "แบบฟอร์มการสมัคร Eco Factory",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "member", $meta, $this->data);
      }
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
  		$this->theme("app", "remote", "app-detail" . $sub_page, $meta, $this->data);

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
    		$this->theme("app", "remote", "app-form-" . $sub_page , $meta, $this->data);
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
    		$this->theme("app", "remote", "app-fill-" . $sub_page , $meta, $this->data);
      }
    }


    public function rule($args)
    {
      $item = $args[0];

      if(isset($item))
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "หลักเกณฑ์",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "rule-detail", $meta, $this->data);
      }
      else 
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "หลักเกณฑ์",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "rule", $meta, $this->data);
      }
    }

    public function factory($args)
    {
      $item = $args[0];

      if(isset($item))
      {
        $fact_id        = $args[1];
        $url            = "application/factory-detail/" . $fact_id;
        $contentRow     = engine::api("GET", $url);

        $this->data["Factory"] = $contentRow['detail'];
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "โรงงานที่ได้รับการรับรอง",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "factory-detail", $meta, $this->data);
      }
      else 
      {
        if(!isset($_GET["page"]))
        {
          $pageNUm = 1;
        }
        else
        {
          $pageNUm = $_GET["page"];
        }

        $url        = "application/factory?page=" . $pageNUm;
        $factory    = engine::api("GET", $url);
        $this->data["factory"] = $factory;

        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "โรงงานที่ได้รับการรับรอง",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "factory", $meta, $this->data);
      }
    }

    public function download($args)
    {
      $item = $args[0];

      if(isset($item))
      {
        $fact_id        = $args[1];
        $url            = "application/factory-detail/" . $fact_id;
        $contentRow     = engine::api("GET", $url);

        $this->data["Factory"] = $contentRow['detail'];
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "โรงงานที่ได้รับการรับรอง",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "factory-detail", $meta, $this->data);
      }
      else 
      {
        $url        = "cms/page/download";
        $postRow    = engine::api("GET", $url);
        $this->data["Download"] = $postRow;

        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "โรงงานที่ได้รับการรับรอง",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "download", $meta, $this->data);
      }
    }

    public function benefit($args)
    {
      $item = $args[0];

      if(isset($item))
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "สิทธิประโยชน์",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "benefit-detail", $meta, $this->data);
      }
      else 
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "สิทธิประโยชน์",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "benefit", $meta, $this->data);
      }
    }

    public function news($args)
    {
      $item = $args[0];

      if(isset($item))
      {
        $post           = $args[1];
        $page           = "post_news";
        $url            = "cms/post_page/" . $post;
        $contentRow     = engine::api("GET", $url);

        $this->data["Page"] = $contentRow['page'];
        $this->data["Post"] = $contentRow['post'];

        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "ข่าวสาร",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "news-detail" . $code, $meta, $this->data);
      }
      else 
      {
        $url        = "cms/page/news";
        $postRow    = engine::api("GET", $url);
        $this->data["Page"] = $postRow;
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "ข่าวสาร",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "news", $meta, $this->data);
      }
    }

    public function calendar($args)
    {
      $item = $args[0];

      if(isset($item))
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "การประชุม",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "calendar-detail", $meta, $this->data);
      }
      else 
      {
        $url        = "contact/meeting";
        $meeting    = engine::api("GET", $url);
        $this->data["meeting"] = $meeting;

        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "การประชุม",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "calendar", $meta, $this->data);
      }
    }

    public function events($args)
    {
      $item = $args[0];

      if(isset($item))
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "ข่าวสารและกิจกรรม",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "events-detail", $meta, $this->data);
      }
      else 
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "ข่าวสารและกิจกรรม",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "events", $meta, $this->data);
      }
    }

    public function course($args)
    {
      $item = $args[0];

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

      if(isset($item))
      {
        //รายละเอียดคอร์ส
        //--------------------- ini ------------------
        $course    = $args[0];
        $topic     = $args[1];
        $external  = $args[2];
        $student   = engine::student("id");

        //---------------- get data -----------------//
        $url    = 'lesson/detail/' . $course . "/" . $student;
        $lesson = engine::api("GET", $url);
        $this->data["Lesson"]					      = $lesson;
        $this->data["Lesson"]['additional']	= $lesson['additional'];
        $this->data["Course"]					      = $lesson['course'];
        $this->data["enroll"]					      = $lesson['enroll'];
        $this->data["player"]					      = $lesson['player'];
        //$this->data["Lesson"]['tags']		= $lesson['tags'];

        //รายละเอียดผู้สอน
        //--------------------------------------------
        $this->data["Teacher"]	= $lesson['teacher'];

        //รายละเอียดเอกสาร
        //--------------------- ini ------------------
        $url2     = 'lesson/document/' . $this->data["Lesson"]['lesson_id'];
        $document = engine::api("GET", $url2);
        $this->data["Document"]	= $document;
        //--------------------------------------------

        $mode = $this->data["Lesson"]['lesson_mode'];

        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "แหล่งความรู้ออนไลน์",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "course-detail", $meta, $this->data);
      }
      else 
      {
        // Meta
        $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "แหล่งความรู้ออนไลน์",
          'theme'     => "custom",
          'page'      => "",
          'seo'       => "",
        );

        $this->theme("app", "remote", "course", $meta, $this->data);
      }
    }

    public function contact($args)
    {
      // Meta
      $meta = array(
        'title'     => $this->data["title"],
        'subtitle'  => "ติดต่อสอบถาม",
        'theme'     => "custom",
        'page'      => "",
        'seo'       => "",
      );

      $this->theme("app", "remote", "contact", $meta, $this->data);
    }

    public function action($args)
    {
      $action     = $args[0];
      $apiKey     = $GLOBALS["LEARNING"]['key'];
      $secretKey  = $GLOBALS["LEARNING"]['secret'];

      switch ($action)
      {
        case "get-lesson":

          $url      = $GLOBALS["LEARNING"]['server'] . 'lesson';
          $header   = array();
          $header[] = 'Content-length: 0';
          $header[] = 'Content-type: application/json';
          $header[] = "api-key: {$apiKey}";
          $header[] = "secret-key: {$secretKey}";

          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
          $response_json = curl_exec($ch);
          curl_close($ch);

          $trace = json_decode($response_json, true);
          echo json_encode($trace, JSON_UNESCAPED_UNICODE);

        break;
      }
    }
}
?>
