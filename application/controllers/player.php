<?php

class player extends fw_controller
{
    public $m_core;

    public function __construct()
	{
        $this->m_core = new m_core();
        $this->initial();
		//--------------------------------------------
		$this->data["title"] = "รายวิชา";
		//--------------------------------------------
    }

    public function index()
	{
		//--------------------------------------------
		engine::session();
		engine::admin("7,1");
		//--------------------- ini ----------------------//
		//----------------------------------------------//

		$student = engine::student("id");

		//--------------------- ini ----------------------//
		$url = "studentpermission/" . $student;
		//---------------- get data -----------------//
		$course = engine::api("GET", $url);
		$this->data["Lesson"]	= $course;

		//--------------------- ini ----------------------//
		$getOrder = "studentinvoice/" . $student;
		//---------------- get data -----------------//
		$order = engine::api("GET", $getOrder);
		$this->data["Order"]	= $order;

		//---------------------------------------------------------------------------------------------------------------------------------------------------

		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "ห้องเรียน",
			'page' 		=> "",
			'seo' 			=> "",
		);

		$this->theme("player", "player", "dashboard", $meta, $this->data);
    }

	public function show($args)
	{
		//--------------------------------------------
		engine::session();
		engine::admin("7,1");
		//--------------------- ini ----------------------//
		//----------------------------------------------//
		$permission = $args[0];

		//--------------------- ini ----------------------//
		$url = "lessonpermission/" . $permission;
		//---------------- get data -----------------//
		$course = engine::api("GET", $url);
		$this->data["Lesson"]	= $course;

		$this->data["Lesson"]['invoice'] = $course['invoice'];
		$this->data["Lesson"]['price'] 		= engine::baht($course['invoice']['order_price']);
		$this->data["Lesson"]['adddate'] 	= engine::thaidate($course['invoice']['order_adddate']);

		$mode = $this->data["Lesson"]['mode'];

		$_SESSION["Permission"] = $permission;

		switch ($mode)
		{
			case "1": //คอร์สธรรมดา
				$meta = array
				(
					'title' 		=> $this->data["title"],
					'subtitle' 	=> "ห้องเรียน",
					'page' 		=> "",
					'seo' 			=> "",
				);
				$this->theme("player", "player", "show-single", $meta, $this->data);

			break;

			case "2": //คอร์สรวม
				$meta = array
				(
					'title' 		=> $this->data["title"],
					'subtitle' 	=> "ห้องเรียน",
					'page' 		=> "",
					'seo' 			=> "",
				);
				$this->theme("player", "player", "show-combine", $meta, $this->data);

			break;

			case "3": //คอร์สบุฟเฟต์
				$meta = array
				(
					'title' 		=> $this->data["title"],
					'subtitle' 	=> "ห้องเรียน",
					'page' 		=> "",
					'seo' 			=> "",
				);
				$this->theme("player", "player", "show-buffet", $meta, $this->data);

			break;
		}

    }

	public function play($args)
	{
		//--------------------------------------------
		engine::session();
		engine::admin("7,1");
		//--------------------- ini ----------------------//

		$student 		= engine::student("id");
		$course = $args[0];

		$url = 'lessondetail/' . $course;
		//---------------- get data -----------------//
		$lesson = engine::api("GET", $url);
		$this->data["Lesson"]	= $lesson;
		//----------------------------------------------//

		engine::permission("check-lesson", $this->data["Lesson"]['lesson_id']);

		$school = $this->data["Lesson"]['school_id'];
		//
		$bank = engine::school("bank", $school);
		$this->data["Bank"] = $bank['table'];

		$url2 = 'document/' . $this->data["Lesson"]['lesson_id'];
		//---------------- get data -----------------//
		$document = engine::api("GET", $url2);
		$this->data["Document"]	= $document;

		$url3 = 'firsttopic/' . $this->data["Lesson"]['lesson_id'] . "/" . $student;
		$firsttopic = engine::api("GET", $url3);
		$this->data["FirstTopic"]	= $firsttopic;

		$url4 = 'contest/' . $this->data["Lesson"]['lesson_id'] . "/" . $student;
		//---------------- get data -----------------//
		$contest = engine::api("GET", $url4);
		$this->data["Contest"]	= $contest;
		//----------------------------------------------//

		$url5 = 'quiz/first/' . $this->data["Lesson"]['lesson_id'] . "/" . $student;
		//---------------- get data -----------------//
		$firstquiz = engine::api("GET", $url5);
		$this->data["firstQuiz"]	= $firstquiz;
		//----------------------------------------------//

		$request	= $this->data["firstQuiz"]['request'];
		$contest	= $this->data["firstQuiz"]['first'];
		$code		= $this->data["firstQuiz"]['code'];
		$do			= $this->data["firstQuiz"]['do'];

		$lessoncode = $this->data["Lesson"]['lesson_code'];

		if($request=="1" && $do=="false")
		{
			$this->data["firstQuiz"]['output'] = "1";
			$pageQuiz = "player/quiz/{$lessoncode}/{$code}";
			header( "Location: /{$pageQuiz}");
		}
		else
		{
			$this->data["firstQuiz"]['output'] = "0";
			$meta = array
			(
				'title' 		=> $this->data["title"],
				'subtitle' 	=> "เข้าเรียน",
				'page' 		=> "",
				'seo' 			=> "",
			);
			$this->theme("player", "player", "play", $meta, $this->data);
		}

		//---------------------------------------------------------------------------------------------------------------------------------------------------

    }

	public function quiz($args)
	{
		//--------------------------------------------
		engine::session();
		engine::admin("7,1");
		//--------------------- ini ----------------------//

		$student 			= engine::student("id");
		$course 			= $args[0];
		$contestcode 	= $args[1];

		$url = 'lessondetail/' . $course;
		//---------------- get data -----------------//
		$lesson = engine::api("GET", $url);
		$this->data["Lesson"]	= $lesson;
		//----------------------------------------------//

		engine::permission("check-lesson", $this->data["Lesson"]['lesson_id']);

		$school = $this->data["Lesson"]['school_id'];
		//
		$bank = engine::school("bank", $school);
		$this->data["Bank"] = $bank['table'];

		$url2 = 'document/' . $this->data["Lesson"]['lesson_id'];
		//---------------- get data -----------------//
		$document = engine::api("GET", $url2);
		$this->data["Document"]	= $document;

		$url3 = 'firsttopic/' . $this->data["Lesson"]['lesson_id'] . "/" . $student;
		$firsttopic = engine::api("GET", $url3);
		$this->data["FirstTopic"]	= $firsttopic;

		$url4 = 'contest/' . $this->data["Lesson"]['lesson_id'];
		//---------------- get data -----------------//
		$contest = engine::api("GET", $url4);
		$this->data["Contest"]	= $contest;

		$url5 = 'quiz/detail/' . $contestcode;
		//---------------- get data -----------------//
		$contestrow = engine::api("GET", $url5);
		$this->data["ContestRow"]	= $contestrow;
		//----------------------------------------------//

		//---------------------------------------------------------------------------------------------------------------------------------------------------
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "ข้อสอบ",
			'page' 		=> "",
			'seo' 			=> "",
		);
		$this->theme("player", "player", "quiz", $meta, $this->data);
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

			case "get-topic":

				$student = engine::student("id");
				$tid = $_POST['topic'];

				if($student!="" || $tid!="")
				{
					$url = 'checkplayer/' . $tid . "/" . $student;
					//---------------- get data -----------------//
					$topic = engine::api("GET", $url);

					$topicPlayer	= $topic["code"];
					$topicRow		= $topic["topic"];

          if($topicRow['topic_poster']=="" || $topicRow['topic_poster']==NULL)
          {
            $topicRow['topic_poster'] = "CDN1/academy//lesson/lesson-11.jpg";
          }
          else {
            $topicRow['topic_poster'] = $topicRow['topic_poster'];
          }

					if(!empty($topic['message']))
					{
						foreach ($topic['message'] as $Message)
						{
							$date = engine::Ago($Message['question_adddate']);

							$time = $Message['question_playertime'];

							if (strlen($time)==5)
							{
								if($time!=NULL || $time!="")
								{
									$timeresume = "00:" . $time;
								}
								else
								{
									$timeresume = $time;
								}
							}
							else if(strlen($time)==7)
							{
								if($time!=NULL || $time!="")
								{
									$timeresume = "0" . $time;
								}
								else
								{
									$timeresume = $time;
								}
							}
							else
							{
								$timeresume = $time;
							}


							$messagelist .=
							"<li>
								<div class='list-body'>
									<div class='list-content'>
										<cite class='name-author'><a href='javascript:void(0);'>{$Message['question_subject']}</a></cite>
										<p>{$Message['question_detail']}</p>
										<div class='comment-meta'>
										<a href='#'>{$date}</a>
										<a href='javascript:void(0);' onclick='playFromMessage(\"{$timeresume}\");'><i class='fa fa-play-circle-o'></i> เล่น {$Message['question_playertime']}</a>
										</div>
									</div>
								</div>
							</li>";
						}
					}
					else
					{
						$messagelist .=
						"<li>
							<div class='list-body'>
								<div class='list-content'>
									<p>ไม่มีคำถาม</p>
								</div>
							</div>
						</li>";
					}

					$trace = array
					(
						"status" 	=> "true",
						"code" 		=> $topicPlayer,
						"resume" 	=> $topic["resume"],
						"note" 		=> $topic["note"],
						"message" 	=> $messagelist,
						"messagecount" 	=> $topic["messagecount"],
						"vdo" 		=> $topicRow['topic_video'],
						"name" 		=> $topicRow['topic_name'],
						"poster" 	=> $topicRow['topic_poster'],
					);

					echo json_encode($trace, JSON_UNESCAPED_UNICODE);
				}

			break;

			case "timer":
				//
				ob_end_clean();

				$student 		= engine::student("id");
				$player 	  = $_SESSION["Player"]['player_code'];
				$time			  = $_POST["time"];
				$url        = 'player/timer/' . $student . "/" . $player . "/" . $time;

				//---------------- get data -----------------//

				$timer     = engine::api("GET", $url, $data);
				$status 	 = $timer['status'];
				$time 	   = $timer['time'];
				$return 	 = $timer['return'];

				$trace = array
				(
					"status" 	=> $status,
					"return" 	=> $url,
					"time" 		=> engine::secondToTimestamp($time),
				);

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

      		case "stop":
				//
				ob_end_clean();

				$student 	  = engine::student("id");
				$player 	  = $_SESSION["Player"]['player_code'];
				$time		  = $_POST["time"];
				$url          = 'player/stop/' . $student . "/" . $player . "/" . $time;

				// API Return
				$timer        = engine::api("GET", $url, $data);
				$status 	    = $timer['status'];
				$time 	      = $timer['time'];
				$return 	    = $timer['return'];

				$trace = array
				(
					"status" 	=> $status,
					"player" 	=> $player,
					"student" 	=> $student,
					"return" 	=> $return,
					"time" 		=> engine::secondToTimestamp($time),
				);

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "submit-score":
				//
				ob_end_clean();

				$student 		= engine::student("id");

				$contest 		= $_POST["contest"];
				$lesson 		= $_POST["lesson"];

				$time			  = $_POST["timer"];
				$score			= $_POST["score"];

				$check = "";

				if($time=="" || $score=="")
				{
					$check = "กรอกข้อมูลให้ครบถ้วน";
				}

				if($check=="")
				{
					$url = 'quiz/submit/' . $student . "/" . $lesson . "/" . $contest . "/" . $time . "/" . $score;
					//---------------- get data -----------------//
					$update = engine::api("GET", $url, $data);

					$status 	= $update['status'];
					$return 	= $update['return'];

					$trace = array
					(
						"status" 	=> $status,
						"return" 	=> $return,
					);
				}
				else
				{
					$trace = array
					(
						"status" 	=> "false",
						"return" 	=> $check,
					);
				}

				unset($_SESSION["Contest"]);

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "change-avatar":
				//
				ob_end_clean();

				$avatar 		= $_POST['avatar'];
				$student 	= engine::student("id");

				$check = "";

				if($avatar=="")
				{
					$check = "กรุณากรอกข้อมูลให้ครบถ้วน";
				}

				if($check=="")
				{
					$data = array
					(
						'avatar' 		=> $avatar,
						'student' 	=> $student,
					);

					$url = 'changeavartar';
					//---------------- get data -----------------//
					$change = engine::api("POST", $url, $data);

					$status 	= $change['status'];

					$trace = array
					(
						"status" 	=> $change,
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

			case "update-note":
				//
				ob_end_clean();

				$player 		= $_POST['topic'];
				$note 		= $_POST['note'];

				$check = "";

				if($player=="" || $note=="")
				{
					$check = "กรุณากรอกข้อมูลให้ครบถ้วน";
				}

				if($check=="")
				{
					$data = array
					(
						'player' 	=> $player,
						'note' 	=> $note,
					);

					$url = 'theplayer/updatenote';
					//---------------- get data -----------------//
					$change = engine::api("POST", $url, $data);

					$status 	= $change['status'];

					$trace = array
					(
						"status" 	=> $change,
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

			case "send-message":
				//
				ob_end_clean();

				$player 		= $_POST['player'];
				$subject 	= $_POST['subject'];
				$playtimer 	= $_POST['playtimer'];
				$message 	= $_POST['message'];

				$check = "";

				if($player=="" || $subject=="" || $message=="")
				{
					$check = "กรุณากรอกข้อมูลให้ครบถ้วน";
				}

				if($check=="")
				{
					$data = array
					(
						'player' 		=> $player,
						'subject' 	=> $subject,
						'message' 	=> $message,
						'playtimer' 	=> $playtimer,
					);

					$url = 'theplayer/sendmessage';
					//---------------- get data -----------------//
					$send = engine::api("POST", $url, $data);

					$status 		= $send['status'];
					$message 	= $send['message'];

					if(!empty($send['message']))
					{
						foreach ($send['message'] as $Message)
						{
							$date = engine::Ago($Message['question_adddate']);
							$time = $Message['question_playertime'];

							if (strlen($time)==5)
							{
								if($time!=NULL || $time!="")
								{
									$timeresume = "00:" . $time;
								}
								else
								{
									$timeresume = $time;
								}
							}
							else if(strlen($time)==7)
							{
								if($time!=NULL || $time!="")
								{
									$timeresume = "0" . $time;
								}
								else
								{
									$timeresume = $time;
								}
							}
							else
							{
								$timeresume = $time;
							}
							$messagelist .=
							"<li>
								<div class='list-body'>
									<div class='list-content'>
										<cite class='name-author'><a href='javascript:void(0);'>{$Message['question_subject']}</a></cite>
										<p>{$Message['question_detail']}</p>
										<div class='comment-meta'>
										<a href='#'>{$date}</a>
										<a href='javascript:void(0);' onclick='playFromMessage(\"{$timeresume}\");'><i class='fa fa-play-circle-o'></i> เล่น {$Message['question_playertime']}</a>
										</div>
									</div>
								</div>
							</li>";
						}
					}
					else
					{
						$messagelist .=
						"<li>
							<div class='list-body'>
								<div class='list-content'>
									<p>ไม่มีคำถาม</p>
								</div>
							</div>
						</li>";
					}

					$trace = array
					(
						"status" 	=> $status,
						"message" 	=> $messagelist,
						"messagecount" 	=> $send["messagecount"],
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

		}
	}
}
?>
