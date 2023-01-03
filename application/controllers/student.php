<?php
class student extends fw_controller
{
    public $m_core;

    public function __construct()
    {
      // INI
      $this->m_core = new m_core();
      $this->initial();
      $this->data["title"] = "ผู้ใช้งาน";
    }

    public function index()
    {
      engine::session();
      $student = engine::student("id");

      // Student Overview
      $overview = engine::api("GET", "user/dashboard/" . $student);
  		$this->data["Overview"] = $overview;

      // Student Invoice
  		$order = engine::api("GET", "user/invoice/" . $student);
  		$this->data["Order"]	= $order;

      // Student Course
  		$course = engine::api("GET", "user/permission/" . $student);
  		$this->data["Lesson"]	= $course;

      $this->data["Student"] = engine::student("profile");

      // THEME
      $meta = array
      (
        'title'     => $this->data["title"],
        'subtitle'  => "ภาพรวม",
        'page'      => "",
        'seo'       => "",
      );
      $this->theme("default", "student", "index", $meta, $this->data);
    }

    public function course($args)
    {
      engine::session();
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

      // THEME
      $meta = array
      (
        'title'     => $this->data["title"],
        'subtitle'  => "ภาพรวม",
        'page'      => "",
        'seo'       => "",
      );
      $this->theme("default", "student", "course", $meta, $this->data);
    }

    public function certification($args)
    {
      engine::session();
      $student = engine::student("id");

      // Student Overview
      $overview = engine::api("GET", "user/dashboard/" . $student);
  		$this->data["Overview"] = $overview;

      $cert = engine::api("GET", "user/certification/" . $student);
  		$this->data["Certification"] = $cert['certification'];

      $this->data["Student"]       = engine::student("profile");

      // THEME
      $meta = array
      (
        'title'     => $this->data["title"],
        'subtitle'  => "ภาพรวม",
        'page'      => "",
        'seo'       => "",
      );
      $this->theme("default", "student", "certification", $meta, $this->data);
    }

    public function profile($args)
    {
      engine::session();
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

      // THEME
      $meta = array
      (
        'title'     => $this->data["title"],
        'subtitle'  => "ภาพรวม",
        'page'      => "",
        'seo'       => "",
      );
      $this->theme("default", "student", "profile", $meta, $this->data);
    }

    /*public function course($args)
    {
      $lesson_code  = $args[0];
      $topic_code   = $args[1];
      $student      = engine::student("id");

      engine::session();

      if($lesson_code == NULL && $topic_code==NULL) //รายการคอร์ส
      {
        // Student Course
    		$course = engine::api("GET", "student_permission/" . $student);

        // Lesson Data
    		$this->data["Lesson"]['list']	        = $course['list'];
        $this->data["Lesson"]['instructor']	  = $course['instructor'];
        $this->data["Lesson"]['Root']	        = $course['lesson_detail'];
        $this->data["Lesson"]['Course']	      = $course['course_detail'];
        $this->data["Lesson"]['Topic']	      = $course['topic_detail'];
        $this->data["Lesson"]['Lastplay']	    = $course['lastplayer'];

        // Student Invoice
    		$order = engine::api("GET", "studentinvoice/" . $student);
    		$this->data["Order"]	= $order;

        //THEME
        $meta = array
        (
          'title'     => $this->data["title"],
          'subtitle'  => "หลักสูตรของฉัน",
          'page'      => "",
          'type'      => "",
          'seo'       => "",
        );
        $this->theme("default", "student", "course", $meta, $this->data);
      }
      else if ($lesson_code != NULL && $topic_code==NULL) // รายละเอียดคอร์ส
      {
        //รายละเอียดคอร์ส
        //---------------- get data -----------------//
    		$url    = 'lesson_detail/' . $lesson_code;
    		$lesson = engine::api("GET", $url);
    		$this->data["Lesson"]					      = $lesson;
    		$this->data["Lesson"]['additional']	= $lesson['additional'];
        $this->data["Course"]					      = $lesson['course'];
    		//$this->data["Lesson"]['tags']		= $lesson['tags'];

    		//รายละเอียดผู้สอน
        //--------------------------------------------
    		$this->data["Teacher"]	= $lesson['teacher'];

        //รายละเอียดเอกสาร
    		//--------------------- ini ------------------
    		$url2     = 'document/' . $this->data["Lesson"]['lesson_id'];
    		$document = engine::api("GET", $url2);
    		$this->data["Document"]	= $document;
        //--------------------------------------------
    		$mode = $this->data["Lesson"]['lesson_mode'];

        //THEME
        //--------------------------------------------------------------------
        $meta = array
        (
        'title' => $this->data["title"],
        'subtitle' => "หลักสูตร",
        'page' => "",
        'type' => "",
        'seo' => "",
        );
        $this->theme("default", "student", "course-detail", $meta, $this->data);
      }
      else if ($lesson_code != NULL && $topic_code!=NULL) // รายละเอียดคอร์ส
      {
        //รายละเอียดคอร์ส
        //---------------- get data -----------------//
    		$url    = 'lesson_player/' . $lesson_code . "/" . $topic_code . "/" . $student;
    		$lesson = engine::api("GET", $url);
    		$this->data["Lesson"]					      = $lesson;
    		$this->data["Lesson"]['additional']	= $lesson['additional'];
        $this->data["Course"]					      = $lesson['course'];
        $this->data["Topic"]					      = $lesson['topic'];
        $this->data["Player"]					      = $lesson['player'];
        // Player
        $_SESSION["Player"]                 = $lesson['player'];

    		//$this->data["Lesson"]['tags']		= $lesson['tags'];

    		//รายละเอียดผู้สอน
        //--------------------------------------------
    		$this->data["Teacher"]	= $lesson['teacher'];

        //รายละเอียดเอกสาร
    		//--------------------- ini ------------------
    		$url2     = 'document/' . $this->data["Lesson"]['lesson_id'];
    		$document = engine::api("GET", $url2);
    		$this->data["Document"]	= $document;
        //--------------------------------------------
    		$mode = $this->data["Lesson"]['lesson_mode'];

        //THEME
        //--------------------------------------------------------------------
        $meta = array
        (
        'title' => $this->data["title"],
        'subtitle' => "เข้าเรียน - " . $topic_code,
        'page' => "",
        'type' => "",
        'seo' => "",
        );
        $this->theme("player", "student", "course-play", $meta, $this->data);
      }
    }*/

    public function quiz($args)
    {
      $lesson_code  = $args[0];
      $topic_code   = $args[1];
      $student      = engine::student("id");
      engine::session();

      if($lesson_code == NULL && $topic_code==NULL) //รายการคอร์ส
      {
        //Student Course
        //--------------------------------------------------------------------
    		$course = engine::api("GET", "student_permission/" . $student);
        //Lesson Data
        //--------------------------------------------------------------------
    		$this->data["Lesson"]['list']	        = $course['list'];
        $this->data["Lesson"]['instructor']	  = $course['instructor'];
        $this->data["Lesson"]['Root']	        = $course['lesson_detail'];
        $this->data["Lesson"]['Course']	      = $course['course_detail'];
        $this->data["Lesson"]['Topic']	      = $course['topic_detail'];

        //Student Invoice
        //--------------------------------------------------------------------
    		$order = engine::api("GET", "studentinvoice/" . $student);
    		$this->data["Order"]	= $order;

        //THEME
        //--------------------------------------------------------------------
        $meta = array
        (
          'title'     => $this->data["title"],
          'subtitle'  => "หลักสูตรของฉัน",
          'page'      => "",
          'type'      => "",
          'seo'       => "",
        );
        $this->theme("default", "student", "quiz", $meta, $this->data);
      }
      else if ($lesson_code != NULL && $topic_code==NULL) // รายละเอียดคอร์ส
      {
        //รายละเอียดคอร์ส
        //---------------- get data -----------------//
    		$url    = 'lesson_detail/' . $lesson_code;
    		$lesson = engine::api("GET", $url);
    		$this->data["Lesson"]					      = $lesson;
    		$this->data["Lesson"]['additional']	= $lesson['additional'];
        $this->data["Course"]					      = $lesson['course'];
    		//$this->data["Lesson"]['tags']		= $lesson['tags'];

    		//รายละเอียดผู้สอน
        //--------------------------------------------
    		$this->data["Teacher"]	= $lesson['teacher'];

        //รายละเอียดเอกสาร
    		//--------------------- ini ------------------
    		$url2     = 'document/' . $this->data["Lesson"]['lesson_id'];
    		$document = engine::api("GET", $url2);
    		$this->data["Document"]	= $document;
        //--------------------------------------------
    		$mode = $this->data["Lesson"]['lesson_mode'];

        //THEME
        //--------------------------------------------------------------------
        $meta = array
        (
        'title' => $this->data["title"],
        'subtitle' => "หลักสูตร",
        'page' => "",
        'type' => "",
        'seo' => "",
        );
        $this->theme("default", "student", "quiz-detail", $meta, $this->data);
      }
      else if ($lesson_code != NULL && $topic_code!=NULL) // รายละเอียดคอร์ส
      {
        //รายละเอียดคอร์ส
        //---------------- get data -----------------//
    		$url    = 'lesson_quiz/' . $lesson_code . "/" . $topic_code;
    		$lesson = engine::api("GET", $url);
    		$this->data["Lesson"]					      = $lesson;
    		$this->data["Lesson"]['additional']	= $lesson['additional'];
        $this->data["Quiz"]					        = $lesson['quiz'];

        //unset($_SESSION["Quiz"]);
        //unset($_SESSION["QuizProgress"]);

        if(!isset($_SESSION["Quiz"]))
        {
          $_SESSION["Quiz"]['question'] = $this->data["Quiz"]['question'];
          $_SESSION["Quiz"]['token']    = $this->data["Quiz"]['contest_token'];
          //shuffle($_SESSION["Quiz"]);

          $q = 0;
          $arrayQuestionLength = count($_SESSION["Quiz"]['question']);
          //-------------------
          while ($q < $arrayQuestionLength)
          {
            $_SESSION["QuizProgress"][$_SESSION["Quiz"]['token']][$_SESSION["Quiz"]['question'][$q]['quiz_id']]['answer']  = "";
            $_SESSION["QuizProgress"][$_SESSION["Quiz"]['token']][$_SESSION["Quiz"]['question'][$q]['quiz_id']]['timer']   = "";
            $q++;
          }
        }

    		//รายละเอียดผู้สอน
        //--------------------------------------------
    		$this->data["Teacher"]	= $lesson['teacher'];

        //รายละเอียดเอกสาร
    		//--------------------- ini ------------------
    		$url2     = 'document/' . $this->data["Lesson"]['lesson_id'];
    		$document = engine::api("GET", $url2);
    		$this->data["Document"]	= $document;
        //--------------------------------------------
    		$mode = $this->data["Lesson"]['lesson_mode'];

        $question_number = $args[2];

        if($question_number=="" || $question_number ==NULL)
        {
          $question_number = "1";
        }

        $total_question = count($_SESSION["Quiz"]['question']);

        if($total_question==$question_number)
        {
          $question_stage = "last";
        }
        else if($question_number=="1")
        {
          $question_stage = "first";
        }
        else
        {
          $question_stage = "progress";
        }

        $question_next  = $question_number+1;
        $question_prev  = $question_number-1;

        if($question_prev<=0)
        {
          $question_prev      = "0";
          $question_prev_btn  = "<a href='javascript:void(0);'><span class='pagi-text'> ข้อแรก</span><span class='nav-title'></span></a>";
        }
        else
        {
          $question_prev_btn  = "
          <a href='javascript:void(0);' onclick='sendAnswer(\"" . $_SESSION["Quiz"]['token'] . "\",\"".$_SESSION["Quiz"]['question'][$question_number-1]['quiz_id']."\",\"". $question_prev ."\",\"seven_wastes\");' ><span class='pagi-text'> ข้อก่อนหน้า</span><span class='nav-title'>ข้อที่ {$question_prev}</span></a>";
        }

        if($question_next>$total_question)
        {
          $question_next      = $total_question;
          $question_next_btn  = "<a href='javascript:void(0);' onclick='sendAnswer(\"" . $_SESSION["Quiz"]['token'] . "\",\"".$_SESSION["Quiz"]['question'][$question_number-1]['quiz_id']."\",\"submit\",\"seven_wastes\");'><span class='nav-title'>บันทึกคะแนน</span> <span class='pagi-text'>ส่งคำตอบ</span></a>";
        }
        else
        {
          $question_next_btn  = "<a href='javascript:void(0);' onclick='sendAnswer(\"" . $_SESSION["Quiz"]['token'] . "\",\"".$_SESSION["Quiz"]['question'][$question_number-1]['quiz_id']."\",\"". $question_next ."\",\"seven_wastes\");' ><span class='nav-title'>ข้อที่ {$question_next}</span> <span class='pagi-text'>ข้อถัดไป</span></a>";
        }

        $_SESSION["Quiz"]['total_question']     = $total_question;
        $_SESSION["Quiz"]['current_question']   = $question_number;
        $_SESSION["Quiz"]['current_index']      = $question_number-1;
        $_SESSION["Quiz"]['question_stage']     = $question_stage;
        $_SESSION["Quiz"]['next']               = $question_next_btn;
        $_SESSION["Quiz"]['prev']               = $question_prev_btn;

        //---------------- get data -----------------//
    		$url    = 'take_quiz/' . $this->data["Quiz"]['contest_id'] . "/" .  $this->data["Lesson"]['lesson_id'] . "/" . $this->data["Lesson"]['quiz']['contest_aligment'] . "/" . $student;
    		$lesson = engine::api("GET", $url);
    		$this->data["Player"]	= $lesson;

        //THEME
        //--------------------------------------------------------------------
        $meta = array
        (
        'title'     => $this->data["title"],
        'subtitle'  => "ทำแบบทดสอบ",
        'page'      => "",
        'type'      => "",
        'seo'       => "",
        );
        $this->theme("default", "student", "quiz-take", $meta, $this->data);
      }
    }

    public function quiz_result($args)
    {
      $contest  = $args[0];
      $student  = engine::student("id");

      $url      = 'result_quiz/' . $contest . "/" . $student;
      $result   = engine::api("GET", $url);

      $this->data["Result"]	  = $result;
      $this->data["Score"]    = $result['score'];
      $this->data["Contest"]  = $result['contest'];
      $this->data["Lesson"]	  = $result['lesson'];
      $this->data["Teacher"]  = $result['teacher'];


      $this->data["UserQuiz"]   = unserialize($this->data["Score"]['score_record']);
      $this->data["SystemQuiz"] = unserialize($this->data["Score"]['score_structor']);

      //THEME
      //--------------------------------------------------------------------
      $meta = array
      (
      'title'     => $this->data["title"],
      'subtitle'  => "ผลคะแนน - " . $contest,
      'page'      => "",
      'type'      => "",
      'seo'       => "",
      );
      $this->theme("default", "student", "quiz-result", $meta, $this->data);
    }

    public function document($args)
    {
      $lesson_code  = $args[0];
      $topic_code   = $args[1];
      $student      = engine::student("id");

      if($lesson_code == NULL && $topic_code==NULL) //รายการคอร์ส
      {
        //Student Course
        //--------------------------------------------------------------------
    		$course = engine::api("GET", "student_permission/" . $student);
        //Lesson Data
        //--------------------------------------------------------------------
    		$this->data["Lesson"]['list']	        = $course['list'];
        $this->data["Lesson"]['instructor']	  = $course['instructor'];
        $this->data["Lesson"]['Root']	        = $course['lesson_detail'];
        $this->data["Lesson"]['Course']	      = $course['course_detail'];
        $this->data["Lesson"]['Topic']	      = $course['topic_detail'];

        //Student Invoice
        //--------------------------------------------------------------------
    		$order = engine::api("GET", "studentinvoice/" . $student);
    		$this->data["Order"]	= $order;

        //THEME
        //--------------------------------------------------------------------
        $meta = array
        (
          'title'     => $this->data["title"],
          'subtitle'  => "หลักสูตรของฉัน",
          'page'      => "",
          'type'      => "",
          'seo'       => "",
        );
        $this->theme("default", "student", "document", $meta, $this->data);
      }
      else if ($lesson_code != NULL && $topic_code==NULL) // รายละเอียดคอร์ส
      {
        //รายละเอียดคอร์ส
        //---------------- get data -----------------//
    		$url    = 'lesson_detail/' . $lesson_code;
    		$lesson = engine::api("GET", $url);
    		$this->data["Lesson"]					      = $lesson;
    		$this->data["Lesson"]['additional']	= $lesson['additional'];
        $this->data["Course"]					      = $lesson['course'];
    		//$this->data["Lesson"]['tags']		= $lesson['tags'];

    		//รายละเอียดผู้สอน
        //--------------------------------------------
    		$this->data["Teacher"]	= $lesson['teacher'];

        //รายละเอียดเอกสาร
    		//--------------------- ini ------------------
    		$url2     = 'document/' . $this->data["Lesson"]['lesson_id'];
    		$document = engine::api("GET", $url2);
    		$this->data["Document"]	= $document;
        //--------------------------------------------
    		$mode = $this->data["Lesson"]['lesson_mode'];

        //THEME
        //--------------------------------------------------------------------
        $meta = array
        (
        'title' => $this->data["title"],
        'subtitle' => "หลักสูตร",
        'page' => "",
        'type' => "",
        'seo' => "",
        );
        $this->theme("default", "student", "document-detail", $meta, $this->data);
      }
      else if ($lesson_code != NULL && $topic_code!=NULL) // รายละเอียดคอร์ส
      {
        //รายละเอียดคอร์ส
        //---------------- get data -----------------//
    		$url    = 'lesson_detail/' . $lesson_code . "/" . $topic_code;
    		$lesson = engine::api("GET", $url);
    		$this->data["Lesson"]					      = $lesson;
    		$this->data["Lesson"]['additional']	= $lesson['additional'];
        $this->data["Course"]					      = $lesson['course'];
        $this->data["Topic"]					      = $lesson['topic'];
    		//$this->data["Lesson"]['tags']		= $lesson['tags'];

    		//รายละเอียดผู้สอน
        //--------------------------------------------
    		$this->data["Teacher"]	= $lesson['teacher'];

        //รายละเอียดเอกสาร
    		//--------------------- ini ------------------
    		$url2     = 'document/' . $this->data["Lesson"]['lesson_id'];
    		$document = engine::api("GET", $url2);
    		$this->data["Document"]	= $document;
        //--------------------------------------------
    		$mode = $this->data["Lesson"]['lesson_mode'];

        //THEME
        //--------------------------------------------------------------------
        $meta = array
        (
        'title' => $this->data["title"],
        'subtitle' => "บทเรียน",
        'page' => "",
        'type' => "",
        'seo' => "",
        );
        $this->theme("default", "student", "document-play", $meta, $this->data);
      }
    }

    public function play($args)
    {
      $course_code  = $args[0];
      $topic_code   = $args[1];

      //THEME
      //--------------------------------------------------------------------
      $meta = array
      (
        'title'     => $this->data["title"],
        'subtitle'  => "เข้าสู่ระบบ",
        'page'      => "",
        'type'      => "",
        'seo'       => "",
      );
      $this->theme("default", "student", "play", $meta, $this->data);
    }

    public function billing_history($args)
    {
      $course_code = $args[0];
      $topic_code = $args[1];

      $meta = array(
          'title' => $this->data["title"],
          'subtitle' => "เข้าสู่ระบบ",
          'page' => "",
          'type' => "",
          'seo' => "",
      );

      $this->theme("default", "student", "billing-history", $meta, $this->data);
    }

    public function certified($args)
    {
      $course_code = $args[0];
      $topic_code = $args[1];

      $meta = array(
          'title' => $this->data["title"],
          'subtitle' => "เข้าสู่ระบบ",
          'page' => "",
          'type' => "",
          'seo' => "",
      );

      $this->theme("default-printer", "student", "certified", $meta, $this->data);
    }

    public function billing($args)
    {
      $course_code = $args[0];
      $topic_code = $args[1];

      $meta = array(
          'title' => $this->data["title"],
          'subtitle' => "เข้าสู่ระบบ",
          'page' => "",
          'type' => "",
          'seo' => "",
      );

      $this->theme("default", "student", "billing", $meta, $this->data);
    }

    public function contest($args)
    {
      $course_code = $args[0];
      $topic_code = $args[1];

      $meta = array(
          'title' => $this->data["title"],
          'subtitle' => "เข้าสู่ระบบ",
          'page' => "",
          'type' => "",
          'seo' => "",
      );

      $this->theme("default", "student", "contest", $meta, $this->data);
    }

    public function login($args)
    {
      $meta = array(
          'title' => $this->data["title"],
          'subtitle' => "เข้าสู่ระบบ",
          'page' => "",
          'type' => "login",
          'seo' => "",
      );

      $this->theme("default-login", "student", "signin", $meta, $this->data);
    }

    public function register($args)
    {
      $meta = array(
          'title' => $this->data["title"],
          'subtitle' => "สมัครสมาชิกใหม่",
          'page' => "",
          'type' => "login",
          'seo' => "",
      );

      $this->theme("default-login", "student", "signup", $meta, $this->data);
    }

    public function forgot($args)
    {
      engine::session();

      $meta = array(
          'title' => $this->data["title"],
          'subtitle' => "แจ้งลืมรหัสผ่าน",
          'page' => "",
          'seo' => "",
      );

      $this->theme("default", "student", "forgot", $meta, $this->data);
    }

    public function edit($args)
    {
      engine::admin("7,1");

      $url = 'address/';
      $apiKey = $GLOBALS["API"]['key'];
      $secretKey = $GLOBALS["API"]['secret'];
      //------------------------- API -------------------------------------------
      $header = array();
      $header[] = 'Content-length: 0';
      $header[] = 'Content-type: application/json';
      $header[] = "api-key: {$apiKey}";
      $header[] = "secret-key: {$secretKey}";
      //------------------------- Return -------------------------------------------
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      $response_json = curl_exec($ch);
      curl_close($ch);
      //------------------------- Return -------------------------------------------
      $output = json_decode($response_json, true);
      //-------------------------------------------------------------------------------
      //------------------------- Return -------------------------------------------
      $this->data["Districts"] = $output['districts'];
      $this->data["Amphures"] = $output['amphures'];
      $this->data["Provinces"] = $output['provinces'];
      $this->data["Zipcode"] = $output['zipcode'];

      $page = $args[0];
      $uri  = $args[1];

      switch ($page)
      {
          case "profile":
            $page = "profile";
          break;

          case "account":
            $page = "account";
          break;

          case "password":
            $page = "password";
          break;

          default:
            $page = "index";
      }

      $meta = array(
          'title'     => $this->data["title"],
          'subtitle'  => "แก้ไขข้อมูลส่วนตัว",
          'page'      => "",
          'seo'       => "",
      );

      $this->theme("default", "student", "edit-" . $page, $meta, $this->data);
    }

    public function page($args)
    {
        //
        if (!isset($args[0]))
        {
            $page = "";
        }
        else
        {
            $page = $args[0];
        }
        //
        switch ($page)
        {
            case "signin":
                $this->theme("blank", "student", "signin", $meta, $this->data);
            break;

            case "signup":
                $this->theme("blank", "student", "signup", $meta, $this->data);
            break;

            case "forgot":
                $this->theme("blank", "student", "forgot", $meta, $this->data);
            break;

            case "confirm":
                $this->theme("default", "student", "confirm", $meta, $this->data);
            break;

            default:
                header('Location: /home');
        }
    }

    public function confirm($args)
    {
        $code = $args[1];
        $key = $args[0];

        $url = 'confirmStudent/' . $code . "/" . $key;
        //---------------- get data -----------------//
        $confirm = engine::api("GET", $url, $data);

        $this->data['confirm']['key'] = $key;
        $this->data['confirm']['code'] = $code;
        $this->data['confirm']['status'] = $confirm['action'];

        switch ($confirm['action'])
        {
            case "1":

                $this->data['return']['icon'] = "<i class='ion-ios-checkmark-outline'></i>";
                $this->data['return']['title'] = "ข้อมูลของคุณพร้อมใช้งาน !";
                $this->data['return']['msg'] = "คลิ๊กปุ่ม <strong>\" ยืนยันบัญชี \" </strong> เพื่อดำเนินการในขั้นตอนต่อไปค่ะ";

            break;

            case "2":

                $this->data['return']['icon'] = "<i class='ion-information-circled text-warning'></i>";
                $this->data['return']['title'] = "บัญชีของคุณยืนยันไปแล้ว !";
                $this->data['return']['msg'] = "บัญชีของคุณได้ทำการยืนยันบัญชีไปแล้ว กรุณาตรวจสอบข้อมูลใหม่อีกครั้งค่ะ";

            break;

            case "3":

                $this->data['return']['icon'] = "<i class='ion-alert-circled text-danger'></i>";
                $this->data['return']['title'] = "ไม่พบข้อมูลของคุณ !";
                $this->data['return']['msg'] = "ระบบไม่พบข้อมูลการยืนยันบัญชีของคุณ กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนทำการยืนยันบัญชีค่ะ";

            break;

            case "4":

                $this->data['return']['icon'] = "<i class='ion-alert-circled text-warning'></i>";
                $this->data['return']['title'] = "เกิดข้อผิดพลาด !";
                $this->data['return']['msg'] = "ระบบตรวจผลความผิดพลาด กรุณาลองใหม่อีกครั้งค่ะ";

            break;
        }

        $meta = array(
            'title' => $this->data["title"],
            'subtitle' => "ยืนยันบัญชีของคุณ / " . $this->data['return']['title'],
            'page' => "",
            'seo' => "",
        );

        $this->theme("default", "student", "confirm", $meta, $this->data);
    }

    public function locked($args)
    {
        $meta = array(
            'title' => $this->data["title"],
            'subtitle' => "บัญชีของคุณยังไม่ได้ยืนยัน",
            'page' => "",
            'seo' => "",
        );

        $this->theme("default", "student", "lock", $meta, $this->data);
    }

    public function action($args)
    {
        header('Content-Type: application/json');

        $action = $args[0];

        switch ($action)
        {
            case "signin":
                //
                ob_end_clean();
                $data = array(
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                );

                $url = 'signin/';
                //---------------- get data -----------------//
                $student = engine::api("POST", $url, $data);

                $status = $student['login'];
                $return = $student['return'];

                if ($status == "true")
                {
                    if (!isset($_SESSION["Student"]))
                    {
                        unset($_SESSION["Student"]);
                    }

                    $User = array();

                    $User["id"] = $student["student_id"];
                    $User["code"] = $student["student_code"];
                    $User["username"] = $student["student_username"];
                    $User["firstname"] = $student["student_firstname"];
                    $User["lastname"] = $student["student_lastname"];

                    $User["email"] = $student["student_email"];
                    $User["phone"] = $student["student_phone"];
                    $User["avatar"] = $student["student_avatar"];

                    $User["address"] = $student["student_address"];
                    $User["district"] = $student["student_district"];
                    $User["district-name"] = $student["DISTRICT_NAME"];
                    $User["amphures"] = $student["student_amphures"];
                    $User["amphures-name"] = $student["AMPHUR_NAME"];
                    $User["province"] = $student["student_province"];
                    $User["province-name"] = $student["PROVINCE_NAME"];
                    $User["zipcode"] = $student["student_zipcode"];
                    $User["zipcode-name"] = $student["zipcode"];

                    $User["type"] = $student["student_type"];
                    $User["status"] = $student["student_status"];
                    $User["level"] = $student["student_level"];
                    $User["regdate"] = $student["student_regdate"];

                    $User["login"] = true;

                    $_SESSION["Student"] = $User;
                    $student_id = $_SESSION["Student"]["student_id"];
                }

                $trace = array(
                    "status" => $status,
                    "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "signout":
                //
                ob_end_clean();

                if (isset($_SESSION["Student"]))
                {
                    unset($_SESSION["Student"]);

                    $trace = array(
                        "status" => "true",
                        "return" => "ออกจากระบบเรียบร้อย",
                    );

                    echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                }

            break;

            case "signup":
                //
                ob_end_clean();

                $data = array(
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'cpassword' => $_POST['cpassword'],
                );

                $url = 'signup/';
                //---------------- get data -----------------//
                $signup = engine::api("POST", $url, $data);

                $status = $signup['status'];
                $return = $signup['return'];

                $trace = array(
                    "status" => $status,
                    "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "confirm":
                //
                ob_end_clean();

                $check = "";

                if ($_POST['code'] == "" | $_POST['key'] == "")
                {
                    $check = "กรุณาตรวจสอบข้อมูลการยืนยันของคุณให้ถูกต้อง";
                    $trace = array(
                        "status" => "false",
                        "return" => $check,
                    );
                }
                else
                {
                    $data = array(
                        'code' => $_POST['code'],
                        'key' => $_POST['key'],
                    );

                    $url = 'confirmStudentAction/';
                    //---------------- get data -----------------//
                    $signup = engine::api("POST", $url, $data);

                    $_SESSION["Student"]["status"] = "2";

                    $status = $signup['status'];
                    $action = $signup['action'];
                    $return = $signup['return'];
                    $title = $signup['title'];
                    $login = $_SESSION["Student"]["login"];

                    if (isset($_SESSION["Student"]) && $_SESSION["Student"]["login"])
                    {
                        $do = "profile";
                    }
                    else
                    {
                        $do = "login";
                    }

                    $trace = array(
                        "status" => $status,
                        "action" => $action,
                        "do" => $do,
                        "title" => $title,
                        "return" => $return,
                    );
                }

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "forgotpassword":
                //
                ob_end_clean();

                $data = array(
                    'email' => $_POST['email'],
                );

                $url = 'forgotpassword/';
                //---------------- get data -----------------//
                $signup = engine::api("POST", $url, $data);

                $status = $signup['status'];
                $return = $signup['return'];

                $trace = array(
                    "status" => $status,
                    "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "edit-address":
                //
                ob_end_clean();

                $student = engine::student("id");
                $data = array(
                    'student' => $student,
                    'address' => $_POST['address'],
                    'district' => $_POST['district'],
                    'amphures' => $_POST['amphures'],
                    'province' => $_POST['province'],
                    'zipcode' => $_POST['zipcode'],
                );

                $url = 'editaddress/';
                //---------------- get data -----------------//
                $signup = engine::api("POST", $url, $data);

                $status = $signup['status'];
                $title = $signup['title'];
                $return = $signup['return'];

                if ($status)
                {
                    $_SESSION["Student"]["address"] = $_POST['address'];
                    $_SESSION["Student"]["district"] = $_POST['district'];
                    $_SESSION["Student"]["amphures"] = $_POST['amphures'];
                    $_SESSION["Student"]["province"] = $_POST['province'];
                    $_SESSION["Student"]["zipcode"] = $_POST['zipcode'];
                }

                $trace = array
                (
                    "status" => $status,
                  "title"   => $title,
                  "return"  => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "edit-profile":
                //
                ob_end_clean();

                $student = engine::student("id");
                $data = array
                (
                  'student'   => $student,
                  'firstname' => $_POST['firstname'],
                  'lastname'  => $_POST['lastname'],
                  'email'     => $_POST['email'],
                  'phone'     => $_POST['phone'],
                  'avatar'    => $_POST['avatar'],
                );

                $url     = 'user/edit/profile/';
                $signup  = engine::api("POST", $url, $data);

                $status  = $signup['status'];
                $return  = $signup['return'];
                $avatar  = $signup['avatar'];

                if ($status)
                {
                  $_SESSION["Student"]["firstname"] = $_POST['firstname'];
                  $_SESSION["Student"]["lastname"]  = $_POST['lastname'];
                  $_SESSION["Student"]["phone"]     = $_POST['phone'];
                  $_SESSION["Student"]["email"]     = $_POST['email'];
                  $_SESSION["Student"]["avatar"]    = $avatar;
                }

                $trace = array
                (
                  "status" => $status,
                  "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "edit-password":
                //
                ob_end_clean();

                $student = engine::student("id");
                $data = array
                (
                  'student'               => $student,
                  'username'              => $_POST['username'],
                  'password'              => $_POST['password'],
                  'new_password'          => $_POST['new_password'],
                  'confirm_new_password'  => $_POST['confirm_new_password'],
                );

                $url      = 'user/edit/password/';
                $signup   = engine::api("POST", $url, $data);

                $status   = $signup['status'];
                $return   = $signup['return'];

                if ($status)
                {
                  unset($_SESSION["Student"]);
                  unset($_SESSION["Quiz"]);
                  unset($_SESSION["QuizProgress"]);
                  unset($_SESSION["Player"]);
                }

                $trace = array
                (
                  "status" => $status,
                  "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "save-answer":
                //
                ob_end_clean();

                $quiz     = $_POST['qid'];
                $contest  = $_POST['cid'];
                $answer   = $_POST['aid'];
                $timer    = $_POST['timer'];

                $_SESSION["QuizProgress"]["{$contest}"]["{$quiz}"]['answer'] = $answer;
                $_SESSION["QuizProgress"]["{$contest}"]["{$quiz}"]['timer'] = $timer;

                $trace = array
                (
                  "status" => "true",
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "submit-answer":
                //
                ob_end_clean();

                $contest  = $_POST['cid'];

                $q                    = 0;
                $correct_answer       = 0;
                $timer_answer         = 0;
                $arrayQuestionLength  = count($_SESSION["Quiz"]['question']);
                //-------------------
                while ($q < $arrayQuestionLength)
                {
                  $correct      = $_SESSION["Quiz"]['question'][$q]['quiz_anwser'];
                  $user_answer  = $_SESSION["QuizProgress"]["{$contest}"][$_SESSION["Quiz"]['question'][$q]['quiz_id']]['answer'];
                  $user_timer   = $_SESSION["QuizProgress"]["{$contest}"][$_SESSION["Quiz"]['question'][$q]['quiz_id']]['timer'];

                  $timer_answer = $timer_answer + $user_timer;

                  if($correct == $user_answer)
                  {
                    $correct_answer++;
                  }
                  $q++;
                }

                $student = engine::student("id");
                $data = array(
                    'student'     => $student,
                    'contest'     => $contest,
                    'score'       => $correct_answer,
                    'timer'       => $timer_answer,
                    'content'     => serialize($_SESSION["QuizProgress"]["{$contest}"]),
                    'structor'    => serialize($_SESSION["Quiz"]['question']),
                );

                $url = 'save_score/';
                //---------------- get data -----------------//
                $signup = engine::api("POST", $url, $data);

                $status   = $signup['status'];
                $return   = $signup['return'];

                //echo $correct_answer;
                unset($_SESSION["Quiz"]);
                unset($_SESSION["QuizProgress"]);

                $trace = array
                (
                  "status" => $status,
                  "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

        }
    }
}
?>
