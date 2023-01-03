<?php

class machine extends fw_controller
{
    public $m_core;

    public function __construct()
	{
        $this->m_core = new m_core();
        $this->initial();

		engine::ini();
		//--------------------------------------------
		$this->data["title"] = "ระบบเรียนรู้ด้วยตัวเอง";
		//--------------------------------------------
    }

    public function index($args)
	{
		$action = $args[0];
		//--------------------- ini ----------------------//
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "เลือกเครื่อง",
			'page' 		=> "",
			'seo' 			=> "",
		);

		$this->theme("machine", "machine", "index", $meta, $this->data);
    }

	public function code($args)
	{
		$code = $args[0];

		//--------------------- ini ----------------------//
		$url = "machine/list/" . $code;
		//---------------- get data -----------------//
		$private = engine::api("GET", $url);

		$this->data["Private"] = $private;
		//----------------------------------------------//

		//--------------------- ini ----------------------//
		$meta = array
		(
			'title' 		=> $this->data["title"],
			'subtitle' 	=> "เลือกเครื่อง",
			'page' 		=> "",
			'seo' 			=> "",
		);

		$this->theme("machine", "machine", "index", $meta, $this->data);
    }


    public function action($args)
	{
        $action = $args[0];

        switch ($action)
        {
			case "send-comment":

				ob_end_clean();

				$student		= engine::student("id");
				$post 			= $_POST['post'];
				$subject 		= $_POST['subject'];
				$comment 	= $_POST['comment'];
				$today			= engine::today();

				$data = array
				(
					'student' 		=> $student,
					'post' 			=> $post,
					'subject' 		=> $subject,
					'comment' 	=> $comment,
					'adddate' 		=> $today,
					'status' 			=> "1",
					'type' 			=> "1",
				);

				$url = 'page/addcomment';
				//---------------- get data -----------------//
				$addComment = engine::api("POST", $url, $data);

				$status 	= $addComment['status'];
				$title 	= $addComment['title'];
				$return 	= $addComment['return'];

				$trace = array
				(
					"status" 	=> $status,
					"title" 		=> $title,
					"return"	 	=> $return,
				);

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "check-status":

				ob_end_clean();

				$machine 			= $_POST['machine'];

				$url = 'machine/checkstatus/' . $machine;
				//---------------- get data -----------------//
				$machine = engine::api("GET", $url);

				$status 	= $machine['status'];
				$action	= $machine['action'];

				if($_SESSION["Machine"]['id'] == $machine['id'])
				{
					if($status !=$_SESSION["Machine"]['status'])
					{
						if($status!="3")
						{
							$matching = "true";
							unset($_SESSION["Machine"]);
						}
					}
					else
					{
						$matching = "false";
					}
				}
				else
				{
					$matching = "false";
				}

				if($_SESSION["Machine"]['id'] == $machine['id'])
				{

					if($status=="1")
					{
						$checkstatus = "offline";
					}
					else if($status=="2")
					{
						$checkstatus = "online";
					}
					else if($status=="3")
					{
						$checkstatus = "lock";
					}

				}

				if($_SESSION["Machine"]['id'] == $machine['action']['id'])
				{
					if($action == "false")
					{
						$action = "false";
					}
					else
					{
						if($action['action']=="1")
						{
							$main = "learn";
						}
						else if($action['action']=="2")
						{
							$main = "contest";
						}
						else if($action['action']=="3")
						{
							$main = "doc";
						}
						else if($action['action']=="4")
						{
							$main = "demo";
						}

						$action = $main;
					}
				}
				else
				{
					$action = "false";
				}

				$trace = array
				(
					"status" 				=> $status,
					"checkstatus" 		=> $checkstatus,
					"machine" 				=> $machine['id'],
					"session" 				=> $_SESSION["Machine"]['status'],
					"matching" 			=> $matching,
					"action" 				=> $action,
				);

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "online-machine":

				ob_end_clean();

				$machine 	= $_POST['machine'];
				$check		= "";

				if(isset($_SESSION["Machine"]))
				{
					if($_SESSION["Machine"]['id']!=$machine)
					{
						$check = "ไม่สามารถดำเนินการได้";
					}
				}

				if($check=="")
				{
					$url = 'machine/active/' . $machine;
					//---------------- get data -----------------//
					$machine = engine::api("GET", $url);

					$status 	= $machine['status'];
					$id 		= $machine['id'];
					$name 	= $machine['name'];

					if($status=="2")
					{
						if(!isset($_SESSION["Machine"]))
						{
							$_SESSION["Machine"]['status'] 	= $status;
							$_SESSION["Machine"]['id'] 			= $id;
							$_SESSION["Machine"]['name'] 	= $name;
						}
					}

					$trace = array
					(
						"status" 	=> $status,
					);

				}
				else
				{
					$trace = array
					(
						"status" => "false",
					);
				}

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

			case "action-machine":

				ob_end_clean();

				$machine 	= $_POST['machine'];
				$url = 'machine/action/' . $machine;
				//---------------- get data -----------------//
				$action = engine::api("GET", $url);

				if($_SESSION["Machine"]['id'] == $action['id'])
				{
					$action['matching'] = "true";

					$_SESSION["Machine"]['action'] = $action['action'];
				}
				else
				{
					$action['matching'] = "false";
				}

				$trace = $action;

				echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			break;

		}
	}
}

?>
