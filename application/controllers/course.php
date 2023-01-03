<?php

class course extends fw_controller
{
  public $m_core;

  public function __construct()
  {
    $this->m_core = new m_core();
    $this->initial();

    engine::ini();
    //--------------------------------------------
    $this->data["title"] = "รายวิชา";
    //--------------------------------------------
  }

  public function index()
  {
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

		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "หลักสูตรของ ส.อ.ท",
			'page' 		  => "",
			'seo' 			=> "",
		);

		$this->theme("default", "course", "index", $meta, $this->data);
  }

	public function detail($args)
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

		if($this->data["Lesson"]['lesson_status']=="2")
		{
			header( 'Location: /course');
		}
		else
		{
			switch ($mode)
			{
				case "1"://single

          if($topic=="" || $topic==NULL)
          {
            $meta = array
  					(
  						'title' 		=> $this->data["title"],
  						'subtitle' 	=> $this->data["Lesson"]['lesson_name'] . " (" . $this->data["Lesson"]['lesson_code'] . ")",
  						'page' 		  => "",
  						'seo' 			=> "",
  						'share' 		=> $this->data["Lesson"]['lesson_cover'],
  					);
  					//--------------------- ini ----------------------//
  					$this->theme("default", "course", "detail-grid", $meta, $this->data);
          }

				break;
			}
		}

		//---------------------------------------------------------------------------------------------------------------------------------------------------
  }

  public function play($args)
	{
		//รายละเอียดคอร์ส
		//--------------------- ini ------------------
    $lesson_code  = $args[0];
    $topic_code   = $args[1];
    $student      = engine::student("id");

    engine::session();

    //รายละเอียดคอร์ส
    //---------------- get data -----------------//
    $url    = 'lesson/player/' . $lesson_code . "/" . $topic_code . "/" . $student;
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
    $url2     = 'lesson/document/' . $this->data["Lesson"]['lesson_id'];
    $document = engine::api("GET", $url2);
    $this->data["Document"]	= $document;
    //--------------------------------------------
    $mode = $this->data["Lesson"]['lesson_mode'];

    if($args[2]=="" | $args[2] ==NULL)
    {
      $page_tab = "detail";
    }
    else
    {
      $page_tab = $args[2];
    }
    $mode = $this->data["Pager"]['active_tab'] = $page_tab;

    //THEME
    //--------------------------------------------------------------------
    $meta = array
    (
      'title' => $this->data["title"],
      'subtitle' => "เข้าเรียน คอร์ส " . $this->data["Lesson"]['lesson_name'] . " เรื่อง " . $this->data["Topic"]['topic_name'],
      'page' => "",
      'type' => "",
      'seo' => "",
    );

    $this->theme("player", "course", "play", $meta, $this->data);
		//---------------------------------------------------------------------------------------------------------------------------------------------------
  }

  	public function test($args)
	{
		$meta = array
		(
			'title' 	=> $this->data["title"],
			'subtitle' 	=> "เข้าเรียน คอร์ส " . $this->data["Lesson"]['lesson_name'] . " เรื่อง " . $this->data["Topic"]['topic_name'],
			'page' 		=> "",
			'type' 		=> "",
			'seo' 		=> "",
		);
		$this->theme("blank", "course", "test", $meta, $this->data);
  	}

  	public function quiz($args)
	{
    $lesson_code  = $args[0];
    $topic_code   = $args[1];
    $student      = engine::student("id");
    engine::session();
    //รายละเอียดคอร์ส
    //---------------- get data -----------------//
    $url    = 'lesson/quiz/' . $lesson_code . "/" . $topic_code;
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
    $url2     = 'lesson/document/' . $this->data["Lesson"]['lesson_id'];
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
      $question_prev_btn  = "<a href='javascript:void(0);' class='theme-btn theme-btn-light mr-2'><span class='pagi-text'> ข้อแรก</span><span class='nav-title'></span></a>";
    }
    else
    {
      $question_prev_btn  = "
      <a href='javascript:void(0);' class='theme-btn theme-btn-light mr-2' onclick='sendAnswer(\"" . $_SESSION["Quiz"]['token'] . "\",\"".$_SESSION["Quiz"]['question'][$question_number-1]['quiz_id']."\",\"". $question_prev ."\",\"seven_wastes\");' >
      <span class='pagi-text'> ข้อก่อนหน้า</span>
      <span class='nav-title'>ข้อที่ {$question_prev}</span>
      </a>";
    }

    if($question_next>$total_question)
    {
      $question_next      = $total_question;
      $question_next_btn  =
      "<a href='javascript:void(0);' class='theme-btn theme-btn-light bg-color-1 text-white' onclick='sendAnswer(\"" . $_SESSION["Quiz"]['token'] . "\",\"".$_SESSION["Quiz"]['question'][$question_number-1]['quiz_id']."\",\"submit\",\"seven_wastes\");'>
      <span class='nav-title'>บันทึกคะแนน</span>
      <span class='pagi-text'>ส่งคำตอบ</span>
      </a>";
    }
    else
    {
      $question_next_btn  =
      "<a href='javascript:void(0);' class='theme-btn theme-btn-light bg-color-1 text-white' onclick='sendAnswer(\"" . $_SESSION["Quiz"]['token'] . "\",\"".$_SESSION["Quiz"]['question'][$question_number-1]['quiz_id']."\",\"". $question_next ."\",\"seven_wastes\");' >
      <span class='nav-title'>ข้อที่ {$question_next}</span>
      <span class='pagi-text'>ข้อถัดไป</span><i class='la la-angle-right ml-1'></i>
      </a>
      ";
    }

    $_SESSION["Quiz"]['total_question']     = $total_question;
    $_SESSION["Quiz"]['current_question']   = $question_number;
    $_SESSION["Quiz"]['current_index']      = $question_number-1;
    $_SESSION["Quiz"]['question_stage']     = $question_stage;
    $_SESSION["Quiz"]['next']               = $question_next_btn;
    $_SESSION["Quiz"]['prev']               = $question_prev_btn;

    //---------------- get data -----------------//
    $url    = 'lesson/take_quiz/' . $this->data["Quiz"]['contest_id'] . "/" .  $this->data["Lesson"]['lesson_id'] . "/" . $this->data["Lesson"]['quiz']['contest_aligment'] . "/" . $student;
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
    $this->theme("default", "course", "quiz-take", $meta, $this->data);
  }

  public function result($args)
  {
    $contest  = $args[0];
    $student  = engine::student("id");

    $url      = 'lesson/result_quiz/' . $contest . "/" . $student;
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
    $this->theme("default", "course", "quiz-result", $meta, $this->data);
  }










  public function assign($args)
	{
		//--------------------------------------------
		$course = $args[0];
		$url = 'lessondetail/' . $course;
		//---------------- get data -----------------//
		$lesson = engine::api("GET", $url);
		$this->data["Lesson"]	= $lesson;
		//----------------------------------------------//

		//---------------------------------------------------------------------------------------------------------------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "ลงทะเบียนหลักสูตร " . $lesson['lesson_name'],
			'page' 		  => "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//

		$this->theme("default", "course", "buy", $meta, $this->data);
  }

	public function buy($args)
	{
		//--------------------------------------------
		$course = $args[0];
		$url = 'lessondetail/' . $course;
		//---------------- get data -----------------//
		$lesson = engine::api("GET", $url);
		$this->data["Lesson"]	= $lesson;
		//----------------------------------------------//

		//---------------------------------------------------------------------------------------------------------------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "สั่งซื้อคอร์ส",
			'page' 		=> "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//

		$this->theme("default", "course", "buy", $meta, $this->data);
  }

	public function checkout($args)
	{
		//--------------------------------------------
		$url = 'getbank/';
		//---------------- get data -----------------//
		$bank = engine::api("GET", $url);
		$this->data["Bank"]	= $bank['table'];
		//----------------------------------------------//

		$url2 = 'address/';
		//---------------- get data -----------------//
		$output = engine::api("GET", $url2);
		//------------------------- Return -------------------------------------------
		$this->data["Districts"]		= $output['districts'];
		$this->data["Amphures"]	= $output['amphures'];
		$this->data["Provinces"]	= $output['provinces'];
		$this->data["Zipcode"]	= $output['zipcode'];

		//---------------------------------------------------------------------------------------------------------------------------------------------------
		if(!empty($_SESSION["cart_item"]))
		{
			$meta = array
			(
				'title' 		=> $this->data["title"],
				'subtitle' 	=> "จ่ายค่าเรียน",
				'page' 		=> "",
				'seo' 			=> "",
			);
			//--------------------- ini ----------------------//
			$this->theme("default", "course", "checkout", $meta, $this->data);
		}
		else
		{
			header( 'Location: /course');
		}
  }

	public function overview($args)
	{
		//--------------------------------------------
		engine::session();
		engine::admin("7,1");
		//--------------------- ini ----------------------//
		//----------------------------------------------//
		$url = "lesson";
		//---------------- get data -----------------//
		$course = engine::api("GET", $url);
		$this->data["Course"]	= $course;

		//---------------------------------------------------------------------------------------------------------------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "เข้าเรียน",
			'page' 		=> "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//
		$this->theme("player", "course", "view", $meta, $this->data);
    }

	public function signle($args)
	{
		//--------------------------------------------
		engine::session();
		engine::admin("7,1");

    // API
    //--------------------------------------------------------------------------
		$callback = engine::api("GET", "lesson");
		$this->data["Course"]	= $callback0;

		//---------------------------------------------------------------------------------------------------------------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "เข้าเรียน",
			'page' 		=> "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//
		$this->theme("player", "course", "view", $meta, $this->data);
    }

	public function complete($args)
	{
		//--------------------------------------------
		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

		$invoice = $args[0];
		$url = $GLOBALS["API"]['server'] . 'invoice/' . $invoice;
		//------------------------- Return -------------------------------------------
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
		$trace = json_decode($response_json, true);
		//-------------------------------------------------------------------------------
		$this->data["Invoice"] 	= $trace['invoice'];
		$this->data["Lesson"] 		= $trace['lesson'];
		$this->data["School"] 		= $trace['school'];
		$this->data["Student"] 	= $trace['student'];
		$this->data["Bank"]			= $trace['bank'];

		$this->data["School"]['address'] 	= engine::cleanString($this->data["School"]['school_address']);
		$this->data["School"]['logo'] 		= engine::base64img($this->data["School"]['template_document_logo']);
		$this->data["School"]['sign'] 		= engine::base64img($this->data["School"]['template_document_sign']);

		$price		= $this->data["Invoice"]['order_price'];
		$discount	= "0";
		$total		= $price-$discount;

		$this->data["Invoice"]['price'] 		= engine::baht($price, "บ.");
		$this->data["Invoice"]['discount'] 	= engine::baht($discount, "บ.");
		$this->data["Invoice"]['total'] 		= engine::baht($total, "บ.");

		$this->data["Invoice"]['adddate'] 		= engine::thaidate($this->data["Invoice"]['order_adddate']);
		$this->data["Invoice"]['duedate'] 		= engine::thaidate($this->data["Invoice"]['order_expire']);
		//------------------------- Return -------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "การสั่งซื้อสำเร็จ",
			'page' 		=> "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//
		$this->theme("default", "course", "complete", $meta, $this->data);
    }

	public function order($args)
	{
		//--------------------------------------------
		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

		$invoice = $args[0];
		$url = $GLOBALS["API"]['server'] . 'invoice/' . $invoice;
		//------------------------- Return -------------------------------------------
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
		$trace = json_decode($response_json, true);
		//-------------------------------------------------------------------------------
		$this->data["Invoice"] 	= $trace['invoice'];
		$this->data["Item"] 		= $trace['item'];
		$this->data["Lesson"] 		= $trace['lesson'];
		$this->data["School"] 		= $trace['school'];
		$this->data["Student"] 	= $trace['student'];
		$this->data["Bank"]			= $trace['bank'];

		$this->data["School"]['address'] 	= engine::cleanString($this->data["School"]['school_address']);
		$this->data["School"]['logo'] 		= engine::base64img($this->data["School"]['template_document_logo']);
		$this->data["School"]['sign'] 		= engine::base64img($this->data["School"]['template_document_sign']);

		$price		= $this->data["Invoice"]['order_price'];
		$discount	= "0";
		$total		= $price-$discount;

		$this->data["Invoice"]['price'] 		= engine::baht($price, "บ.");
		$this->data["Invoice"]['discount'] 	= engine::baht($discount, "บ.");
		$this->data["Invoice"]['total'] 		= engine::baht($total, "บ.");

		$this->data["Invoice"]['adddate'] 		= engine::thaidate($this->data["Invoice"]['order_adddate'],"date");
		$this->data["Invoice"]['duedate'] 		= engine::thaidate($this->data["Invoice"]['order_expire'],"date");
		//------------------------- Return -------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "ยืนยันการชำระเงิน",
			'page' 		=> "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//
		$this->theme("default", "course", "order", $meta, $this->data);
    }

	public function invoice($args)
	{
		//--------------------------------------------
		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

		$invoice = $args[0];
		$url = $GLOBALS["API"]['server'] . 'invoice/' . $invoice;
		//------------------------- Return -------------------------------------------
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
		$trace = json_decode($response_json, true);
		//-------------------------------------------------------------------------------
		$this->data["Invoice"] 	= $trace['invoice'];
		$this->data["Item"] 		= $trace['item'];
		$this->data["School"] 		= $trace['school'];
		$this->data["Student"] 	= $trace['student'];
		$this->data["Bank"]			= $trace['bank'];

		$this->data["School"]['address'] 	= engine::cleanString($this->data["School"]['school_address']);
		$this->data["School"]['logo'] 		= engine::base64img($this->data["School"]['template_document_logo']);
		$this->data["School"]['sign'] 		= engine::base64img($this->data["School"]['template_document_sign']);

		$price		= $this->data["Invoice"]['order_price'];
		$discount	= "0";
		$total		= $price-$discount;

		$this->data["Invoice"]['price'] 		= engine::baht($price, "บ.");
		$this->data["Invoice"]['discount'] 	= engine::baht($discount, "บ.");
		$this->data["Invoice"]['total'] 		= engine::baht($total, "บ.");

		$this->data["Invoice"]['adddate'] 		= engine::thaidate($this->data["Invoice"]['order_adddate']);
		$this->data["Invoice"]['duedate'] 		= engine::thaidate($this->data["Invoice"]['order_expire']);
		//------------------------- Return -------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "ใบแจ้งหนี้",
			'page' 		=> "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//
		$this->theme("blank", "course", "invoice", $meta, $this->data);
    }

	public function receipt($args)
	{
		//--------------------------------------------
		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

		$invoice = $args[0];
		$url = $GLOBALS["API"]['server'] . 'invoice/' . $invoice;
		//------------------------- Return -------------------------------------------
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
		$trace = json_decode($response_json, true);
		//-------------------------------------------------------------------------------
		$this->data["Invoice"] 	= $trace['invoice'];
		$this->data["Item"] 		= $trace['item'];
		$this->data["School"] 		= $trace['school'];
		$this->data["Student"] 	= $trace['student'];
		$this->data["Bank"]			= $trace['bank'];

		$this->data["School"]['address'] 	= engine::cleanString($this->data["School"]['school_address']);
		$this->data["School"]['logo'] 		= engine::base64img($this->data["School"]['template_document_logo']);
		$this->data["School"]['sign'] 		= engine::base64img($this->data["School"]['template_document_sign']);

		$price		= $this->data["Invoice"]['order_price'];
		$discount	= "0";
		$total		= $price-$discount;

		$this->data["Invoice"]['price'] 		= engine::baht($price, "บ.");
		$this->data["Invoice"]['discount'] 	= engine::baht($discount, "บ.");
		$this->data["Invoice"]['total'] 		= engine::baht($total, "บ.");

		$this->data["Invoice"]['adddate'] 		= engine::thaidate($this->data["Invoice"]['order_adddate']);
		$this->data["Invoice"]['duedate'] 		= engine::thaidate($this->data["Invoice"]['order_expire']);
		//------------------------- Return -------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "ใบเสร็จรับเงิน",
			'page' 		=> "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//
		$this->theme("blank", "course", "receipt", $meta, $this->data);
    }

	public function redeem($args)
	{
		//--------------------------------------------
		$mtitle 		= $this->data["title"];
		$subtitle 	= "แลกคูปอง";
		//--------------------------------------------

		$this->data["Voucher"]['code'] = $args[0];
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "แลกคูปอง",
			'page' 		=> "",
			'seo' 			=> "",
		);
		//--------------------- ini ----------------------//

		$this->theme("default", "course", "redeem", $meta, $this->data);
    }

    public function view($args)
	{
		//
		if(!isset($args[0])){$page = "";}else{$page = $args[0];}
		//
		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

        switch ($page)
        {
			case "api-get":

				//------------------------- API -------------------------------------------
				$url = $GLOBALS["API"]['server'] . 'course';
				//------------------------- Return -------------------------------------------
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
				$response = json_decode($response_json, true);
				print_r($response);
				//------------------------- Return -------------------------------------------

			break;

			default:
			header( 'Location: /home');
		}
	}

    public function action($args)
	{
        $action = $args[0];

		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

        switch ($action)
        {
			case "subtitle.txt":

			header("Content-Type: text/plain");
			echo
			"1
			00:00:20,000 --> 00:01:00,000
			คำอธิบายศัพท์ ( SEIKO : คือ ยี่ห้อนาฬิกา)
			ทดสอบ
			บรรทัดที่ 3

			2
			00:01:10,000 --> 00:02:00,000
			คำอธิบายศัพท์ ( NIKY : คือ ยี่ห้อเสื้อผ้า)

			3
			00:02:10,000 --> 00:03:00,000
			คำอธิบายศัพท์ ( Microsoft : คือ บริษัทผลิตโปรแกรม)

			4
			00:03:10,000 --> 00:04:00,000
			คำอธิบายศัพท์ ( Apple : คือ บริษัทขายไอเดีย)

			4
			00:10:10,000 --> 00:15:00,000
			ขอบคุณที่รับชม....";
			break;

      case "assign-lesson":

        $student  = engine::student("id");
        $token    = $_POST["token"];
        $url      = 'lesson/token/' . $token;
    		$lesson   = engine::api("GET", $url);

    		$this->data["Lesson"] = $lesson;
        $course_budget = $lesson['lesson_sale_price'];

        if($student=="")
        {
          $status = false;
          $return = "กรุณาสมัครสมาชิกหรือเข้าสู่ระบบก่อนลงทะเบียนหลักสูตรนี้ค่ะ";
          $mode   = "login";
          $page   = "auth/register";
        }
        else
        {
          if($course_budget>0)
          {
            //-----------------------------------
            $course_type = "paid"; // Paid Course
            //-----------------------------------
            // Buy
            //-----------------------------------
            $status = false;
            $mode   = "buy";
            $return = "หลักสูตรนี้มีราคา บาท ระบบจะนำทางคุณไปสู่กระบวนการสั่งซื้อค่ะ";
            $page   = "course/buy/" . $lesson['lesson_code'];
          }
          else
          {
            //-----------------------------------
            $course_type = "free"; // Free Course
            //-----------------------------------
            // Assign
            //-----------------------------------
            $data = array
    				(
    					'student' => $student,
    					'lesson' 	=> $lesson['lesson_id'],
    				);
    				//---------------- get data -----------------//
    				$assign = engine::api("POST", 'lesson/assign/', $data);
            //
            $status = $assign['status'];
            $return = $assign['return'];
            $course = $assign['course'];
            $mode   = $assign['mode'];
            $page   = $assign['page'];
          }
        }

        $trace = array
        (
          "status" 	  => $status,
          "course" 	  => $course,
          "return" 	  => $return,
          "mode" 	    => $mode,
          "callpage" 	=> $page,
        );

        echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

      break;

			case "get-course":

				//------------------------- API -------------------------------------------
				$url = $GLOBALS["API"]['server'] . 'course';
				//------------------------- Return -------------------------------------------
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
				$trace = json_decode($response_json, true);
				//-------------------------------------------------------------------------------
				echo json_encode($trace, JSON_UNESCAPED_UNICODE);
				//------------------------- Return -------------------------------------------

			break;

			case "get-topic":

				$tid = $_POST['topic'];
				$url = $GLOBALS["API"]['server'] . 'topicdetail/' . $tid;
				//---------------- get data -----------------//
				$topic = engine::api("GET", $url);
				$this->data["Topic"]	= $topic;
				$this->data["Topic"]['status']	= "true";

				echo json_encode($this->data["Topic"], JSON_UNESCAPED_UNICODE);

			break;

			case "update-profile":
				//
				ob_end_clean();

				$student = engine::student("id");
				$data = array
				(
					'student' 		=> $student,
					'firstname' 		=> $_POST['firstname'],
					'lastname' 		=> $_POST['lastname'],
					'email' 			=> $_POST['email'],
					'phone' 			=> $_POST['phone'],
					'address' 		=> $_POST['address'],
					'district' 		=> $_POST['district'],
					'amphures' 	=> $_POST['amphures'],
					'province' 		=> $_POST['province'],
					'zipcode' 		=> $_POST['zipcode'],
				);

				$url = 'updateprofile/';
				//---------------- get data -----------------//
				$signup = engine::api("POST", $url, $data);

				$status 	= $signup['status'];
				$title 	= $signup['title'];
				$return 	= $signup['return'];

				if($status)
				{
					$_SESSION["Student"]["firstname"] 	= $_POST['firstname'];
					$_SESSION["Student"]["lastname"] 	= $_POST['lastname'];
					$_SESSION["Student"]["email"] 		= $_POST['email'];
					$_SESSION["Student"]["phone"] 		= $_POST['phone'];

					$_SESSION["Student"]["address"] 		= $_POST['address'];
					$_SESSION["Student"]["district"] 			= $_POST['district'];
					$_SESSION["Student"]["amphures"] 		= $_POST['amphures'];
					$_SESSION["Student"]["province"] 		= $_POST['province'];
					$_SESSION["Student"]["zipcode"] 		= $_POST['zipcode'];
				}

				$trace = array
				(
					"status" 	=> $status,
					"title" 		=> $title,
					"return"	 	=> $return,
				);

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "confirm-order":
				//
				ob_end_clean();

				$student = engine::student("id");

				$itemArray = array();
				$itemArray['product'] = $_SESSION["cart_item"];

				$total = 0;
				$discount = 0;
				$totalprice = 0;

				foreach ($itemArray['product'] as $item)
				{

					if($item['type'] == "code-fix")
					{
						$discount += $item['price'];
						$discounttype = "fix";
						$discounttext = "";
					}
					else if($item['type'] == "code-cal")
					{
						$discount = $item['price'];
						$discounttype = "cal";
						$discounttext = "%";
					}
					else
					{
						$total += $item['price'];
						$discounttype = "none";
						$discounttext = "";
					}

				}

				if($discounttype == "fix")
				{
					$discountSum =  $discount;
					$totalprice 	= $total - $discount;
				}
				else if($discounttype == "cal")
				{
					$discountSum = ($total/100)*$discount;
					$totalprice 	= $total - $discountSum;
				}
				else
				{
					$totalprice = $total - $discount;
				}

				$itemArray['payment']	= $_POST['payments'];
				$itemArray['voucher']	= $_POST['voucher'];
				$itemArray['price']		= $totalprice;
				$itemArray['discount']	= $discountSum;
				$itemArray['student']	= $student;

				$url = 'addorder';
				//---------------- get data -----------------//
				$addOrder = engine::api("POST", $url, $itemArray);

				if($addOrder['status']=="true")
				{
					unset($_SESSION["cart_item"]);
				}

				echo json_encode($addOrder, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "confirm-transfer":
				//
				ob_end_clean();

				$slipimg 		= $_POST['slipimg'];
				$order 			= $_POST['order'];
				$amount 		= $_POST['amount'];
				$transferdate = $_POST['transferdate'];
				$transfertime 	= $_POST['transfertime'];
				$banktransfer = $_POST['banktransfer'];
				$comment 	= $_POST['comment'];

				$check = "";

				if($slipimg=="" || $order=="" ||$amount=="" ||$transfertime=="" || $transferdate=="" || $banktransfer=="")
				{
					$check = "กรุณากรอกข้อมูลให้ครบถ้วน";
				}

				if($check=="")
				{
					$data = array
					(
						'slipimg' 			=> $slipimg,
						'order' 			=> $order,
						'amount' 		=> $amount,
						'transfertime' 	=> $transfertime,
						'transferdate' 	=> $transferdate,
						'banktransfer' => $banktransfer,
						'comment' 	=> $comment,
					);

					$url = 'confirmorder';
					//---------------- get data -----------------//
					$signup = engine::api("POST", $url, $data);

					$status 	= $signup['status'];
					$title 	= $signup['title'];
					$return 	= $signup['return'];
					$code 	= $signup['code'];
					$order 	= $signup['order'];

					$trace = array
					(
						"status" 	=> $status,
						"title" 		=> $title,
						"return"	 	=> $return,
						"code"	 	=> $code,
						"order"	 	=> $order,
					);
				}
				else
				{
					$trace = array
					(
						"status" 	=> "false",
						"return"	 	=> $check,
					);
				}

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "cancel-order":
				//
				ob_end_clean();

				if(isset($_SESSION["cart_item"]))
				{
					unset($_SESSION["cart_item"]);
				}

				$trace = array
				(
					"status" 	=> "true",
					"return" 	=> "ยกเลิกเรียบร้อย",
				);

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "timer":
				//
				ob_end_clean();

				$student = engine::student("id");

				$url = 'updatetimer/SNG-E6FGC';
				//---------------- get data -----------------//
				$signup = engine::api("GET", $url, $data);

				$status 	= $signup['status'];
				$time 	= $signup['time'];

				$trace = array
				(
					"status" 	=> $status,
					"time" 		=> engine::secondToTimestamp($time),
				);

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "redeem-voucher":
				//
				ob_end_clean();

				$student 			= engine::student("id");
				$vouchercode 	= $_POST['voucher'];

				$url = 'voucher/redeem/' . $student . "/" . $vouchercode;
				//---------------- get data -----------------//
				$Voucher = engine::api("GET", $url, $data);

				$status 		= $Voucher['status'];
				$return 		= $Voucher['return'];

				if($status=="true")
				{
					$detail = $Voucher['detail'];
					$trace = array
					(
						"status" 	=> $status,
						"return" 	=> $return,

						"voucher_name" 	=> $detail['voucher_name'],
						"voucher_type" 		=> $detail['type_name'],
						"voucher_value" 		=> $detail['value'],
					);
				}
				else
				{
					$trace = array
					(
						"status" 	=> $status,
						"return" 	=> $return,
					);
				}
				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "check-voucher":
				//
				ob_end_clean();

				$student 			= engine::student("id");
				$vouchercode 	= $_POST['voucher'];

				$url = 'voucher/check/' . $vouchercode;
				//---------------- get data -----------------//
				$Voucher = engine::api("GET", $url, $data);

				$status 		= $Voucher['status'];
				$return 		= $Voucher['return'];
				$name 		= $Voucher['name'];
				$code 		= $Voucher['code'];
				$price 		= $Voucher['price'];
				$type 		= $Voucher['type'];

				if($status=="true")
				{
					$detail = $Voucher['detail'];
					$trace = array
					(
						"status" 	=> $status,
						"return" 	=> $return,
						"name" 		=> $name,
						"code" 		=> $code,
						"price" 		=> $price,
						"type" 		=> $type,
					);
				}
				else
				{
					$trace = array
					(
						"status" 	=> $status,
						"return" 	=> $return,
					);
				}
				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "cart":
				//
				ob_end_clean();
				$case = $args[1];

				switch ($case)
				{
					case "add":

						$quantity 	= $_POST["quantity"];
						$type 		= $_POST["type"];
						$item 		= $_POST["item"];

						if(!empty($quantity))
						{
							//Get Lesson Detail
							$url = 'cart/' . $type . '/' . $item;
							//---------------- get data -----------------//
							$Cart = engine::api("GET", $url, $data);

							$itemArray = array
							(
								$Cart["code"]=>array
								(
									'name'		=>$Cart["name"],
									'cover'		=>$Cart["cover"],
									'code'		=>$Cart["code"],
									'price'		=>$Cart["price"],
									'type'		=>$_POST["type"],
									'quantity'	=>$_POST["quantity"]
								)
							);

							if(!empty($_SESSION["cart_item"]))
							{
								if(in_array($Cart["code"],array_keys($_SESSION["cart_item"])))
								{
									foreach($_SESSION["cart_item"] as $k => $v)
									{
											if($Cart["code"] == $k)
											{
												if(empty($_SESSION["cart_item"][$k]["quantity"]))
												{
													$_SESSION["cart_item"][$k]["quantity"] = 0;
												}
												$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
											}
									}

									$trace = array
									(
										"status" 	=> "false",
										"return" 	=> "มีรหัสนี้แล้ว",
									);
								}
								else
								{
									$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
									//engine::sortArrayByKey($_SESSION["cart_item"],"type",true);
									$trace = array
									(
										"status" 	=> "true",
										"return" 	=> "เพิ่มเรียบร้อย",
										'name'		=>$Cart["name"],
										'code'		=>$Cart["code"],
										'cover'		=>$Cart["cover"],
										'price'		=>$Cart["price"],
										'type'		=>$_POST["type"],
										'quantity'	=>$_POST["quantity"],
									);
								}

							}
							else
							{
								$_SESSION["cart_item"] = $itemArray;
								//engine::sortArrayByKey($_SESSION["cart_item"],"type",true);
								$trace = array
								(
									"status" 	=> "true",
									"return" 	=> "เพิ่มแล้ว",
									'name'		=>$Cart["name"],
									'code'		=>$Cart["code"],
									'cover'		=>$Cart["cover"],
									'price'		=>$Cart["price"],
									'type'		=>$_POST["type"],
									'quantity'	=>$_POST["quantity"],

								);
							}

						}
						echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

					break;

					case "remove":

						$item = $_POST["item"];

						$out = "";

						if(!empty($_SESSION["cart_item"]))
						{
							foreach($_SESSION["cart_item"] as $k => $v)
							{
								if($item == $k)
								{
									unset($_SESSION["cart_item"][$k]);
								}

								if(empty($_SESSION["cart_item"]))
								{
									unset($_SESSION["cart_item"]);
								}

								$out .= $item;
							}
							//engine::sortArrayByKey($_SESSION["cart_item"],"type",true);
							$trace = array
							(
								"status" 	=> "true",
								"return" 	=> "ลบแล้ว - " . $item,
							);
						}

						echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

					break;

					case "empty":
						unset($_SESSION["cart_item"]);
					break;

				}

			break;

      case "generate-certification":

        ob_end_clean();
        $student  = engine::user("elearning");
        $token    = $_POST["token"];

        $data = array
        (
          'student'  => $student,
          'lesson'   => $token,
        );

        $url    = 'certification/add/';
    		$cert   = engine::api("POST", $url, $data);

        $trace = array
        (
          "status" 	  => $cert['status'],
          "return" 	  => $cert['return'],
          "student" 	=> $student,
        );

        echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

      break;

      case "add-message":

        ob_end_clean();

        $student  = engine::student("id");
        $lesson   = $_POST["post_lesson"];
        $topic    = $_POST["post_topic"];
        $message  = $_POST["post_message"];
        $timer    = $_POST["post_topic_timer"];

        $data = array
        (
          'student'  => $student,
          'lesson'   => $lesson,
          'topic'    => $topic,
          'timer'    => $timer,
          'message'  => $message,
          'action'   => "1",
          'sender'   => "student",
        );

        $url    = 'discussion/add/';
    		$cert   = engine::api("POST", $url, $data);

        $trace = array
        (
          "status" 	  => $cert['status'],
          "return" 	  => $cert['return'],
        );

        echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

      break;

      case "add-reply":

        ob_end_clean();

        $student      = engine::student("id");
        $lesson       = $_POST["reply_lesson"];
        $topic        = $_POST["reply_topic"];
        $message_id   = $_POST["reply_message_id"];
        $message      = $_POST["reply_message"];

        $data = array
        (
          'student'     => $student,
          'lesson'      => $lesson,
          'topic'       => $topic,
          'message'     => $message,
          'message_id'  => $message_id,
          'action'      => "2",
          'sender'      => "student",
        );

        $url    = 'discussion/reply/';
    		$cert   = engine::api("POST", $url, $data);

        $trace = array
        (
          "status" 	  => $cert['status'],
          "return" 	  => $cert['return'] . " - " . $_POST["reply_message_id"],
        );

        echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

      break;

		}
	}
}
?>
