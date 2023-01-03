<?php

class school extends fw_controller
{
    public $m_core;

    public function __construct()
	{
        $this->m_core = new m_core();
        $this->initial();
		//--------------------------------------------
		$this->data["title"] = "หน้าหลัก";
		//--------------------------------------------
    }

	public function index()
	{
		//--------------------------------------------
		$mtitle 		= $this->data["title"];
		$subtitle 	= "บทเรียน";
		//--------------------------------------------

		$this->theme("default", "course", "index", $meta, $this->data);
    }

    public function view($args)
	{
		$mtitle 		= $this->data["title"];
		$subtitle 	= "โรงเรียน";

		//รายละเอียดโรงเรียน
		//--------------------- ini ----------------------
		$school_id = $args[0];
		$url = $GLOBALS["API"]['server'] . 'schooldetail/' . $school_id;
		//---------------- get data -----------------
		$school = engine::api("GET", $url);
		$this->data["School"] = $school;

		$page = $args[1];

		if($page!="")
		{
			$this->theme("blank", "school", "page", $meta, $this->data);
		}
		else
		{
			$this->theme("blank", "school", "detail", $meta, $this->data);
		}
    }

	public function detail($args)
	{
		//--------------------------------------------
		$mtitle 		= $this->data["title"];
		$subtitle 	= "รายละเอียด";
		//--------------------------------------------
		$course = $args[0];

		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

		//------------------------- API -------------------------------------------
		$url = $GLOBALS["API"]['server'] . 'coursedetail/' . $course;
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
		$this->data["Course"] = $trace;
		//------------------------- Return -------------------------------------------

		$this->theme("default", "course", "detail", $meta, $this->data);
    }

    public function view2($args)
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

			case "api-post":

				//------------------------- API -------------------------------------------
				$data = array
				(
					'nickname' 			=> $_POST['nickname'],
					'username' 		=> $_POST['username'],
					'password' 			=> $_POST['password'],
					'cpassword' 		=> $_POST['cpassword'],
					'email' 				=> $_POST['email'],
					'phone' 				=> $_POST['phone'],
					'upline' 				=> engine::partner("member"),
					'bankid' 				=> $_POST['bankid'],
					'banknumber' 	=> $_POST['banknumber'],
					'bankname' 		=> $_POST['bankname'],
				);

				$data_json = json_encode($data);

				//------------------------- API -------------------------------------------
				$url = 'https://www.we-lotto.com/api/member';
				//------------------------- API -------------------------------------------
				$header = array();
				$header[] = 'Content-type: application/json';
				$header[] = 'Content-Length: ' . strlen($data_json);
				$header[] = "api-key: {$apiKey}";
				$header[] = "secret-key: {$secretKey}";
				$header[] = "partner-key: {$partnerKey}";
				//------------------------- API -------------------------------------------
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$response_json = curl_exec($ch);
				curl_close($ch);
				//------------------------- Return -------------------------------------------
				$response = json_decode($response_json, true);
				//print_r($response);
				//echo $response;

				echo json_encode($response_json, JSON_UNESCAPED_UNICODE);
				//------------------------- Return -------------------------------------------

			break;

			case "api-put":

				//------------------------- API -------------------------------------------

				$data = array('username'=>'dog','password'=>'tall');
				$data_json = json_encode($data);

				//------------------------- API -------------------------------------------
				$url = 'https://www.we-lotto.com/api/member/2';
				//------------------------- API -------------------------------------------
				$header = array();
				$header[] = 'Content-type: application/json';
				$header[] = 'Content-Length: ' . strlen($data_json);
				$header[] = "api-key: {$apiKey}";
				$header[] = "secret-key: {$secretKey}";
				$header[] = "partner-key: {$partnerKey}";
				//------------------------- API -------------------------------------------
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$response_json = curl_exec($ch);
				curl_close($ch);
				//------------------------- Return -------------------------------------------
				$response = json_decode($response_json, true);
				print_r($response);

				//return $response;
				//------------------------- Return -------------------------------------------

			break;

			case "api-delete":

				//------------------------- API -------------------------------------------
				$url = 'https://www.we-lotto.com/api/member/3';
				//------------------------- API -------------------------------------------
				$header = array();
				$header[] = 'Content-length: 0';
				$header[] = 'Content-type: application/json';
				$header[] = "api-key: {$apiKey}";
				$header[] = "secret-key: {$secretKey}";
				$header[] = "partner-key: {$partnerKey}";
				//------------------------- API -------------------------------------------
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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
			case "user-signup":
				//
				ob_end_clean();

				//------------------------- API -------------------------------------------
				$data = array
				(
					'nickname' 			=> $_POST['nickname'],
					'username' 		=> $_POST['username'],
					'password' 			=> $_POST['password'],
					'cpassword' 		=> $_POST['cpassword'],
					'email' 				=> $_POST['email'],
					'phone' 				=> $_POST['phone'],
					'upline' 				=> $_POST['upline'],
					'bankid	' 			=> $_POST['bankid'],
					'banknumber' 	=> $_POST['banknumber'],
					'bankname' 		=> $_POST['bankname'],
				);
				//------------------------- API -------------------------------------------
				$url = 'https://www.we-lotto.com/api/member';
				//------------------------- API -------------------------------------------
				$header = array();
				$header[] = 'Content-length: 0';
				$header[] = 'Content-type: application/json';
				$header[] = "api-key: {$apiKey}";
				$header[] = "secret-key: {$secretKey}";
				$header[] = "partner-key: {$partnerKey}";
				//------------------------- API -------------------------------------------
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$response_json = curl_exec($ch);
				curl_close($ch);
				//------------------------- Return -------------------------------------------
				$response = json_decode($response_json, true);

				return $response;
				//------------------------- Return -------------------------------------------

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

		}
	}
}
?>
