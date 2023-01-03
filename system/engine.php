<?php

class engine
{
    private $dbo;
    private $table_container;

    function __construct()
	{
        $this->table_container = new table_container();
    }

	public static function html($get, $condition="false",$var1="false")
	{
		switch ($get)
        {
			//
			case "body":

        $type = $GLOBALS["meta"]['type'];

        if($type=="" || $type ==NULL)
        {
          $layout = "<body class='layout-compact layout-compact'>";
        }
        if($type=="sub-layout")
        {
          $layout = "<body class='layout-compact sub-layout'>";
        }
        else if($type=="login")
        {
          $layout = "<body class='layout-default layout-login-centered-boxed'>";
        }
				echo $layout;

			break;

			//
			case "title":

				if(isset($GLOBALS['title']))
				{
					echo
					"<meta charset=\"utf-8\">
					<base href=\"" . $GLOBALS["href"] . "\">
					<title>" . $_SESSION["School"]['name'] . " (" . $_SESSION["School"]['code'] . ")" . " / " . $GLOBALS['title'] . "</title>";
				}
				else
				{
					echo
					"<!-- Update your html tag to include the itemscope and itemtype attributes. -->
					<html itemscope itemtype='http://schema.org/Article'>
					<meta charset=\"utf-8\">
					<base href=\"" . $GLOBALS["href"] . "\">
					<title>" . $_SESSION["School"]['name'] . " (" . $_SESSION["School"]['code'] . ")" .  " / " . $GLOBALS['title'] . "</title>";
				}

			break;

			//
			case "seo":

				if(isset($GLOBALS["seo"]))
				{
					echo
					"<meta name=\"keywords\" content=\"" . $GLOBALS["seo"]['keyword'] . "\" >
					<meta name=\"description\" content=\"" . $GLOBALS["seo"]['description'] . "\" >";
				}
				else
				{
					echo
					"<meta name=\"keywords\" content=\"" . $GLOBALS["seo"]['keyword'] . "\" >
					<meta name=\"description\" content=\"" . $GLOBALS["seo"]['description'] . "\" >";
				}

			break;

			case "social":

				echo
				"<!-- sample fb meta -->
				<meta property='fb:app_id' content='1589769877748991'>
				<meta property='og:title' content='{$GLOBALS['title']} by {$_SESSION["School"]['name']}' />
				<meta property='og:type' content='website' />
				<meta property='og:url' content='{$GLOBALS["share"]['url']}' />
				<meta property='og:image' content='{$GLOBALS["share"]['img']}' />
				<meta property='og:description' content='{$GLOBALS["seo"]['description']}'/>
				<!-- Open Graph data -->
				<meta property='og:title' content='{$GLOBALS['title']} by {$_SESSION["School"]['name']}' />
				<meta property='og:site_name' content='{$_SESSION["School"]['name']}' />
				<meta property='fb:admins' content='1589769877748991' />
				<!-- Twitter Card data -->
				<meta name='twitter:card' content='summary_large_image'>
				<meta name='twitter:site' content='@publisher_handle'>
				<meta name='twitter:title' content='{$GLOBALS['title']} by {$_SESSION["School"]['name']}'>
				<meta name='twitter:description' content='{$GLOBALS["seo"]['description']}'>
				<meta name='twitter:creator' content='@author_handle'>
				<!-- Twitter summary card with large image must be at least 280x150px -->
				<meta name='twitter:image:src' content='{$GLOBALS["share"]['img']}'>";

			break;

			//
			case "iehack":

				echo
				'
				<!-- CSS for IE --><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --><!--[if lt IE 9]><script type="text/javascript" src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script><![endif]-->
				';

			break;

			//
			case "css":

				if($GLOBALS['css']!=false)
				{
					echo "<link href=\"{$GLOBALS['css']}?" . time() . "\" rel='stylesheet' type='text/css'/>";
				}

			break;

			//
			case "js":

				if($GLOBALS['js']!=false)
				{
					include "application/js/js_{$GLOBALS['name']}.php";
				}
				else
				{
					include "application/js/js_{$GLOBALS['name']}.php";
				}

			break;

			case "global-js":

					include "application/js/js_global.php";

			break;

			case "theme":

        		$theme = $GLOBALS["theme"];

				switch ($condition)
				{
					case "css":
					echo "<link href=\"theme/{$theme}/assets/{$var1}?" . time() .  "\" rel='stylesheet' type='text/css'/>";
					break;

					case "js":
					echo "<script type=\"text/javascript\" src=\"theme/{$theme}/assets/{$var1}?" . time() .  "\"></script>";
					break;
				}

			break;

			case "app-theme":

				switch ($condition)
				{
					case "css":
					echo "<link href=\"theme/skin/app/assets/{$var1}?" . time() .  "\" rel='stylesheet' type='text/css'/>";
					break;

					case "js":
					echo "<script type=\"text/javascript\" src=\"theme/skin/app/assets/{$var1}?" . time() .  "\"></script>";
					break;
				}

			break;

      case "img":

        $theme = $GLOBALS["theme"];
				echo "theme/{$theme}/assets/{$condition}?" . time();

			break;

			//
			case "thai":

				echo "<link href=\"theme/demo/assets/css/thai.css\" rel='stylesheet' type='text/css'/>";

			break;

			//
			case "copyright":

				echo $_SESSION["School"]['skin_footer_text'];

			break;
			//

			case "watermark":

				echo "© สงวนสิทธิ์โดย" . $GLOBALS["School"]["engine"];

			break;

			case "activenav":

				if(isset($GLOBALS["menu"]['main']))
				{
					echo "<script>$('#{$GLOBALS["menu"]['main']}-main-menu').addClass('active'); $('#{$GLOBALS["menu"]['main']}-{$GLOBALS["menu"]['sub']}-menu').addClass('active');</script>";
				}
				else
				{
					echo "<script>$('#{$GLOBALS["menu"]['main']}-main-menu').addClass('active'); $('#{$GLOBALS["menu"]['main']}-{$GLOBALS["menu"]['sub']}-menu').addClass('active');</script>";
				}

			break;
		}
	}

	public function ini()
	{
		// ini
		$getMenu = "lesson/list";

		// Get Data
		$coursemenu = engine::api("GET", $getMenu);
		$_SESSION['Menu']['department']	= $coursemenu['department'];
		$_SESSION['Menu']['class']			= $coursemenu['class'];
		$_SESSION['Menu']['type']				= $coursemenu['type'];
    $_SESSION['Menu']['network']	  = $coursemenu['network'];

		// ini
		$siteMenu = "sitemenu";

		// Get Data
		$mainmenu = engine::api("GET", $siteMenu);
		$_SESSION['Menu']['main']				= $mainmenu;

		if(!isset($_SESSION["Menu"]))
		{

		}
	}

	public function session()
	{
		if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"])
		{
			$status = $_SESSION["Student"]["status"];
			$complete = engine::student("complete");

			if($status == "1")
			{
				//ยังไม่ได้ยืนยันบัญชี
				//header( 'Location: /student/locked');
			}
			elseif($status == "2")
			{
				//ยืนยันบัญชีแล้ว
				if($complete['status'] == "false")
				{
					//ยังแก้ไขข้อมูลไม่สมบูรณ์
					//header( 'Location: /student/edit');
				}
			}
			elseif($status == "3")
			{
				//ยกเลิก
				//header( 'Location: /student/locked');
			}
		}
		else
		{
			header( 'Location: /home');
		}
	}

	public function appSession()
	{
		if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"])
		{
			$status = $_SESSION["Student"]["status"];
			$complete = engine::student("complete");

			if($status == "1")
			{
				//ยังไม่ได้ยืนยันบัญชี
				//header( 'Location: /student/locked');
			}
			elseif($status == "2")
			{
				//ยืนยันบัญชีแล้ว
				if($complete['status'] == "false")
				{
					//ยังแก้ไขข้อมูลไม่สมบูรณ์
					//header( 'Location: /student/edit');
				}
			}
			elseif($status == "3")
			{
				//ยกเลิก
				//header( 'Location: /student/locked');
			}
		}
		else
		{
			header( 'Location: /remote/login');
		}
	}

	public function admin($pms,$action)
	{
		if (isset($_SESSION["Student"]))
		{
			$id = $_SESSION["Student"]["id"];
		}
		else
		{
			$id = $_SESSION["Student"]["id"];
		}
		//--------------------------------------------------------
		$level = $_SESSION["Student"]["level"];
    $array = explode(",",$pms);

    if (in_array($level, $array))
    {
      $check = true;
		}
		else
		{
			$check = false;
		}

		if(!$check)
		{
			header( 'Location: /home');
		}
	}

	public function permission($get, $condition = "")
	{
		$student		  = engine::student("id");
		$currentPMS 	= $_SESSION["Permission"];

		// ini
		$url          = 'checkpermission/' . $student . "/" . $currentPMS;

		// Get Data
		$permission	  = engine::api("GET", $url);
		$PMS			    = $permission['detail'];

		$today = engine::today();

		switch ($get)
		{
			case "code":

				return $PMS['permission_code'];

			break;

			case "timer":

				return engine::secondToTimestamp($PMS['permission_timer']);

			break;

			case "expire":

				return engine::thaidate($PMS['permission_expire']);

			break;

			case "days":

				return engine::howManyDays($today, $PMS['permission_expire']);

			break;

			case "lesson":

				return $this->data["Permission"]['lesson_id'];

			break;

			case "check-lesson":

				$lessonPMS = $permission['lesson'];
				if (count(array_intersect(array($condition), $lessonPMS))>0)
				{
					//echo "Lesson : " . $condition . " Status : 1 <br>";
				}
				else
				{
					//echo "Lesson : " . $condition . " Status : 0 <br>";
					header( 'Location: /home');
				}

			break;

			case "check-topic":

				return engine::howManyDays($today,$this->data["Permission"]['permission_expire']);

			break;
		}
	}

	public function cms($get, $mode, $condition="false", $var1="false", $var2="false")
	{

		$school = engine::school("id");

		if($mode=="page")
		{
			$this->data["Row"] =  $this->m_cms->getPageRow($school, $condition);
		}
		else if($mode=="post")
		{
			$this->data["Row"] =  $this->m_cms->getPostRow($school, $condition);
		}

		switch ($get)
        {
			case "id":
				return $this->data["Row"]['page_id'];
			break;

			case "name":
				return $this->data["Row"]['page_name'];
			break;

			case "code":
				return $this->data["Row"]['page_code'];
			break;

			case "cover":

				if($this->data["Row"]['page_cover'] != "")
				{
					$cover = $GLOBALS["School"]['cdn'] . "img.php?file=" . $this->data["Row"]['page_cover'];
				}
				else
				{
					$cover = "theme/assets/images/cover/default-post.jpg";
				}

				return $cover;

			break;

			case "comment":

				if($mode=="page")
				{
					$comment = $this->data["Row"]['page_comment'];

					if($comment=="1")
					{
						$commentStatus = "แสดงความเห็นได้";
					}
					else
					{
						$commentStatus = "ไม่สามารถแสดงความเห็นได้";
					}
				}
				else if($mode=="post")
				{
					$comment = $this->data["Row"]['post_comment'];

					if($comment=="1")
					{
						$commentStatus = "แสดงความเห็นได้";
					}
					else
					{
						$commentStatus = "ไม่สามารถแสดงความเห็นได้";
					}
				}

				return $commentStatus;

			break;
		}
	}

	public function student($get, $var1 = "")
	{
    $id 				   = $_SESSION["Student"]['id'];
    $code 			   = $_SESSION["Student"]['code'];
    $token 			   = $_SESSION["Student"]['token'];
    $username 	   = $_SESSION["Student"]['username'];
    $firstname     = $_SESSION["Student"]['firstname'];
    $lastname 	   = $_SESSION["Student"]['lastname'];

    $email 			   = $_SESSION["Student"]['email'];
    $phone 		     = $_SESSION["Student"]['phone'];
    $avatar 		   = $_SESSION["Student"]['avatar'];

    $address 		   = $_SESSION["Student"]['address'];
    $district 	   = $_SESSION["Student"]['district'];
    $districtName  = $_SESSION["Student"]['district-name'];
    $amphures 	   = $_SESSION["Student"]['amphures'];
    $amphuresName  = $_SESSION["Student"]['amphures-name'];
    $province 		 = $_SESSION["Student"]['province'];
    $provinceName  = $_SESSION["Student"]['province-name'];
    $zipcode 			 = $_SESSION["Student"]['zipcode'];
    $zipcodeName 	 = $_SESSION["Student"]['zipcode-name'];

    $type 			   = $_SESSION["Student"]['type'];
    $status 			 = $_SESSION["Student"]['status'];
    $level 			   = $_SESSION["Student"]['level'];
    $regdate 		   = $_SESSION["Student"]['regdate'];

		switch ($get)
		{
			case "profile":

				$trace = array
				(
					"id" 				  => $id,
					"code" 			  => $code,
					"username" 	  => $username,
					"firstname" 	=> $firstname,
					"lastname" 	  => $lastname,
					"fullname" 		=> $firstname . " " . $lastname,
					"email" 			=> $email,
					"phone" 		  => $phone,
					"avatar" 		  => $GLOBALS["School"]['cdn'] . "img.php?file=" . $avatar,
					"token" 		  => $token,
          "address" 		=> $address,
					"district" 		=> $district,
					"amphures" 	  => $amphures,
					"province" 		=> $province,
					"zipcode" 		=> $zipcode,
					"type" 			  => $type,
					"status" 		  => $status,
					"level" 			=> $level,
					"regdate" 		=> $regdate,
				);

				return $trace;

			break;


			case "id":

				$return = $id;
				return $return;

			break;


      case "token":

				$return = $token;
				return $return;

			break;

			case "code":

				$return = $code;
				return $return;

			break;

			case "status":

				$return = $status;
				return $return;

			break;

      case "avatar":

				if($avatar=="" || $avatar==NULL)
        {
          return "theme/interface/aduca/assets/images/team9.jpg";
        }
        else
        {
          return $_SESSION["School"]["endpoint"] . "/" . $avatar;
        }

			break;

			case "firstname":

				$return = $firstname;
				return $return;

			break;

			case "lastname":

				$return = $lastname;
				return $return;

			break;

			case "fullname":

				$return = $firstname . " " . $lastname;
				return $return;

			break;

			case "username":

				$return = $username;
				return $return;

			break;

			case "email":

				$return = $email;
				return $return;

			break;

			case "phone":

				$return = $phone;
				return $return;

			break;

			case "address":

				$return = $address;
				return $return;

			break;

			case "district":

				$return = $district;
				return $return;

			break;

			case "district-name":

				$return = $districtName;
				return $return;

			break;

			case "amphure":

				$return = $amphures;
				return $return;

			break;

			case "amphure-name":

				$return = $amphuresName;
				return $return;

			break;

			case "province":

				$return = $province;
				return $return;

			break;

			case "province-name":

				$return = $provinceName;
				return $return;

			break;

			case "zipcode":

				$return = $zipcode;
				return $return;

			break;

			case "zipcode-name":

				$return = $zipcodeName;
				return $return;

			break;

			case "fullladdress":


				$return = $address . " ต." . $districtName . " อ." . $amphuresName . " จ." . $provinceName . " " . $zipcodeName;

				return $return;

			break;

			case "complete":

				$check = "";

				if($id == "" || $code == "" || $username == "" || $firstname == "" || $lastname == "")
				{
					$check = "ข้อมูลส่วนตัวยังไม่สมบูรณ์";
				}
				elseif($email == "" || $phone == "")
				{
					$check = "ข้อมูลติดต่อยังไม่สมบูรณ์";
				}
				elseif($address == "" || $district == "" || $amphures == "" || $province == "" || $zipcode == "")
				{
					$check = "ข้อมูลที่อยู่ยังไม่สมบูรณ์";
				}
				elseif($type == "" || $status == "" || $level == "" || $regdate == "")
				{
					$check = "สถานะยังไม่สมบูรณ์";
				}

				if($check =="")
				{
					$trace = array
					(
						"status" => "true",
						"return" => "ข้อมูลของคุณสมบูรณ์แล้ว",
					);
				}
				else
				{
					$trace = array
					(
						"status" => "false",
						"return" => $check,
					);
				}

				return $trace;

			break;
		}
	}

  public function user($get, $var1 = "")
	{
    $token      = $_SESSION["Student"]['access']['token'];
    $etracking  = $_SESSION["Student"]['access']['etracking'];
    $elearning  = $_SESSION["Student"]['access']['elearning'];

		switch ($get)
		{
			case "access":
			$trace = array
			(
				"token" 		=> $token,
				"etracking" => $etracking,
				"elearning" => $elearning,
			);
			return $trace;
			break;

			case "token":
			return $token;
			break;

      case "etracking":
			return $etracking;
			break;

      case "elearning":
			return $elearning;
			break;

      case "profile":

        //** API
        $data = array
        (
          'token' => $etracking,
        );

        $Profile  = engine::api("POST", 'user/profile/', $data);

        if($var1=="get")
        {
          $_SESSION["Profile"] = $Profile['detail'];
        }
        else if($var1=="position")
        {
          return $Profile['detail']['position_code'];
        }
        else if($var1=="detail")
        {
          $trace = array
    			(
    				"username"  => $Profile['detail']['mem_username'],
    				"email"     => $Profile['detail']['mem_email'],
    				"phone"     => $Profile['detail']['mem_phone'],
            "position"  => $Profile['detail']['position_code'],
    			);
          return $trace;
        }

			break;
		}
	}

	public function site($get, $var1 = "")
	{
		switch ($get)
		{
			case "title":

				$return = $GLOBALS["School"]["title"];
				return $return;

			break;

			case "name":

				$return = $GLOBALS["School"]["name"];
				return $return;

			break;

			case "logo":

				$return = $GLOBALS["School"]["logo"];
				return $return;

			break;

			case "code":

				$return = $GLOBALS["School"]["code"];
				return $return;

			break;

			case "slogan":

				$return = $GLOBALS["School"]["slogan"];
				return $return;

			break;

			case "welcome-title":

				$return = $GLOBALS["School"]["wel_txt"];
				return $return;

			break;

			case "welcome-msg":

				$return = $GLOBALS["School"]["wel_msg"];
				return $return;

			break;

			case "domain":

				$return = $GLOBALS["School"]["domain"];
				return $return;

			break;

			case "adddate":

				$return = $GLOBALS["School"]["date"];
				return $return;

			break;

			case "member":

				$return = $GLOBALS["School"]["member"];
				return $return;

			break;

			case "api":

				$return = $GLOBALS["School"]["api"];
				return $return;

			break;

			case "secret":

				$return = $GLOBALS["School"]["member"];
				return $return;

			break;
		}
	}

	public function school($get, $var1 = "")
	{

		$school 			= $var1;
		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

		switch ($get)
		{
			case "detail":

				//------------------------- API -------------------------------------------
				$url = $GLOBALS["API"]['server'] . 'schooldetail/' . $school;
				//------------------------- Return -------------------------------------------
				$header = array();
				$header[] = 'Content-length: 0';
				$header[] = 'Content-type: application/json';
				$header[] = "API-KEY: {$apiKey}";
				$header[] = "SECRET-KEY: {$secretKey}";
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
				//------------------------- Return -------------------------------------------
				$data = array
				(
					'name' 		=> $trace['school_name'],
					'code' 		=> $trace['school_code'],
					'email' 		=> $trace['school_email'],
					'detail' 		=> $trace['school_detail'],
					'website' 	=> $trace['school_website'],
					'phone' 		=> $trace['school_frontphone'],
					'address' 	=> $trace['school_address'],
					'facebook' 	=> $trace['school_social_facebook'],
					'twitter' 	=> $trace['school_social_twitter'],
					'youtube' 	=> $trace['school_social_youtube'],
					'logo' 		=> $trace['school_logo'],
					'status' 		=> $trace['school_status'],
					'live-fb' 			=> $trace['live-fb'],
					'live-title' 		=> $trace['live-title'],
					'live-welcome' => $trace['live-welcome'],
					'live-btn' 		=> $trace['live-btn'],
				);

				return $data;

			break;

			case "bank":

				//------------------------- API -------------------------------------------
				$url = $GLOBALS["API"]['server'] . 'banktable/' . $school;
				//------------------------- Return -------------------------------------------
				$header = array();
				$header[] = 'Content-length: 0';
				$header[] = 'Content-type: application/json';
				$header[] = "API-KEY: {$apiKey}";
				$header[] = "SECRET-KEY: {$secretKey}";
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
				//------------------------- Return -------------------------------------------

				return $trace;

			break;

			case "teacher":

				//------------------------- API -------------------------------------------
				$url = $GLOBALS["API"]['server'] . 'schoolteacher/' . $school;
				//------------------------- Return -------------------------------------------
				$header = array();
				$header[] = 'Content-length: 0';
				$header[] = 'Content-type: application/json';
				$header[] = "API-KEY: {$apiKey}";
				$header[] = "SECRET-KEY: {$secretKey}";
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
				//------------------------- Return -------------------------------------------

				$data = array
				(
					'name' 		=> $trace['teacher_name'],
					'code' 		=> $trace['teacher_code'],
					'detail' 		=> $trace['teacher_detail'],
					'picture' 	=> $trace['teacher_picture'],
					'status' 		=> $trace['teacher_status'],
					'degree' 	=> $trace['teacher_degree'],
				);

				return $trace;

			break;

			case "package":



			break;
		}
	}

	public function course($get, $var1 = "")
	{
		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];

		switch ($get)
		{
			case "table":

				//------------------------- API -------------------------------------------
				$url = $GLOBALS["API"]['server'] . 'lesson';
				//------------------------- Return -------------------------------------------
				$header = array();
				$header[] = 'Content-length: 0';
				$header[] = 'Content-type: application/json';
				$header[] = "API-KEY: {$apiKey}";
				$header[] = "SECRET-KEY: {$secretKey}";
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
				//------------------------- Return -------------------------------------------

				return $trace;

			break;

		}
	}

	public function api($get, $url, $data)
	{
		$apiKey 		= $GLOBALS["API"]['key'];
		$secretKey 	= $GLOBALS["API"]['secret'];
    $url        = $GLOBALS["API"]['server'] . $url;

		switch ($get)
		{
			case "GET": // เรียกข้อมูล

				//------------------------- API ----------------------------------------
				$header = array();
				$header[] = 'Content-length: 0';
				$header[] = 'Content-type: application/json';
				$header[] = "API-KEY: {$apiKey}";
				$header[] = "SECRET-KEY: {$secretKey}";

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$response_json = curl_exec($ch);
				curl_close($ch);

        //------------------------- DECODE -------------------------------------
				$output = json_decode($response_json, true);

				//------------------------- RETURN -------------------------------------
				return $output;

			break;

			case "POST": // เพิ่มข้อมูล

				//------------------------- API ----------------------------------------
				$data_json = json_encode($data);

				$header = array();
				$header[] = 'Content-type: application/json';
				$header[] = 'Content-Length: ' . strlen($data_json);
				$header[] = "API-KEY: {$apiKey}";
				$header[] = "SECRET-KEY: {$secretKey}";

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$response_json = curl_exec($ch);
				curl_close($ch);

				//------------------------- DECODE -------------------------------------
				$output = json_decode($response_json, true);

				//------------------------- RETURN -------------------------------------

				return $output;
			break;
		}
	}

  public function app($get, $url, $data)
	{
		$apiKey 		= $GLOBALS["APP"]['key'];
		$secretKey 	= $GLOBALS["APP"]['secret'];
    $url        = $GLOBALS["APP"]['server'] . $url;

		switch ($get)
		{
			case "GET": // เรียกข้อมูล

				//------------------------- API ----------------------------------------
				$header = array();
				$header[] = 'Content-length: 0';
				$header[] = 'Content-type: application/json';
				$header[] = "API-KEY: {$apiKey}";
				$header[] = "SECRET-KEY: {$secretKey}";

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$response_json = curl_exec($ch);
				curl_close($ch);

        //------------------------- DECODE -------------------------------------
				$output = json_decode($response_json, true);

				//------------------------- RETURN -------------------------------------
				return $output;

			break;

			case "POST": // เพิ่มข้อมูล

				//------------------------- API ----------------------------------------
				$data_json = json_encode($data);

				$header = array();
				$header[] = 'Content-type: application/json';
				$header[] = 'Content-Length: ' . strlen($data_json);
				$header[] = "API-KEY: {$apiKey}";
				$header[] = "SECRET-KEY: {$secretKey}";

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				$response_json = curl_exec($ch);
				curl_close($ch);

				//------------------------- DECODE -------------------------------------
				$output = json_decode($response_json, true);

				//------------------------- RETURN -------------------------------------

				return $output;
			break;
		}
	}

	public function createCourseTreeview($id,$mode)
	{
		if($mode == "lesson")
		{
			$url = 'course/' . $id;
			//---------------- get data -----------------//
			$course = engine::api("GET", $url);
			$data["Course"]	= $course;

			$url2 = 'skipcourse/' . $id;
			//---------------- get data -----------------//
			$skip = engine::api("GET", $url2);
			$data["CourseSkip"]	= $skip;

			$skipped 	= array();

			foreach ($data["CourseSkip"] as $CourseSkip)
			{
				array_push($skipped, $CourseSkip['course_sub']);
			}
		}
		else if($mode == "course")
		{
			//Course
			$url = 'subcourse/' . $id;
			//---------------- get data -----------------//
			$course = engine::api("GET", $url);
			$data["Course"]	= $course;
		}

		echo "<ul>";

		foreach ($data["Course"] as $Course)
		{
			if(!in_array($Course['course_id'], $skipped))
			{
				if($Course['course_type'] == "1")
				{
					echo "<li data-jstree='{\"icon\":\"foldertree\"}'>{$Course['course_name']}";
					echo engine::createCourseTopicTreeview($Course['course_id']);
					echo "</li>";
				}
				else if($Course['course_type'] == "2")
				{
					echo "<li data-jstree='{\"icon\":\"foldertree\"}'>{$Course['course_name']}";
					echo engine::createCourseTreeview($Course['course_id'],"course");
					echo "</li>";
				}
			}
			else
			{
				continue;
			}
		}
		echo "</ul>";

	}

	public function createCourseTopicTreeview($course)
	{
		$url = 'topic/' . $course;
		//---------------- get data -----------------//
		$topic = engine::api("GET", $url);
		$data["Topic"]	= $topic['topic'];

		$url3 = 'firsttopic_id/' . $this->data["Lesson"]['lesson_id'];
		$firsttopic = engine::api("GET", $url3);
		$this->data["FirstTopic"]	= $firsttopic;

		echo "<ul>";
		foreach ($data["Topic"] as $Topic)
		{
			if($this->data["FirstTopic"]==$Topic['topic_id'])
			{
				$active = ",\"opened\":true,\"selected\":true";
			}
			else
			{
				$active = "";
			}

			echo "<li data-jstree='{\"icon\":\"filetree\",\"id\":\"{$Topic['topic_id']}\"{$active}}'>{$Topic['topic_name']}</li>";

		}
		echo "</ul>";
	}

	public function createCourseTableview($id, $mode, $order="")
	{


		if($mode == "lesson")
		{
			$url = 'course/' . $id;
			//---------------- get data -----------------//
			$course = engine::api("GET", $url);
			$data["Course"]	= $course;

			$url2 = 'skipcourse/' . $id;
			//---------------- get data -----------------//
			$skip = engine::api("GET", $url2);
			$data["CourseSkip"]	= $skip;

			$skipped 	= array();

			foreach ($data["CourseSkip"] as $CourseSkip)
			{
				array_push($skipped, $CourseSkip['course_sub']);
			}

			$class="treetable";
			$first="course-hr";
		}
		else if($mode == "course")
		{
			//Course
			$url = 'subcourse/' . $id;
			//---------------- get data -----------------//
			$course = engine::api("GET", $url);
			$data["Course"]	= $course;

			$class="";
			$first="";
		}
		$main = 0;
		echo "<div class='accordion js-accordion accordion--boxed list-group-flush' id='parent'>";

		foreach ($data["Course"] as $Course)
		{

			if(!in_array($Course['course_id'], $skipped))
			{
				$main ++;

				if($Course['course_type'] == "1")
				{

					echo "<li><div class='course {$first}'><span><i class='ion-ios-paper'></i> {$main}. {$Course['course_name']}</span></div>";
					echo engine::createCourseTopicTableview($Course['course_id'], $main);
					echo "</li>";
				}
				else if($Course['course_type'] == "2")
				{
					echo "<li><div class='course {$first}'><span><i class='ion-ios-paper'></i> {$main}. {$Course['course_name']}</span></div>";
					echo engine::createCourseTableview($Course['course_id'],"course",$main);
					echo "</li>";
				}
				$itemorder +=1;
			}
			else
			{
				continue;
			}
		}
		echo "</div>";

	}

	public function createCourseTopicTableview($course, $order)
	{
		$url = 'topic/' . $course;
		//---------------- get data -----------------//
		$topic = engine::api("GET", $url);
		$data["Topic"]	= $topic;

		$url3 = 'firsttopic_id/' . $this->data["Lesson"]['lesson_id'];
		$firsttopic = engine::api("GET", $url3);
		$this->data["FirstTopic"]	= $firsttopic;

		$itemorder = 0;

		echo "<ul class='sub'>";
		foreach ($data["Topic"]['topic'] as $Topic)
		{
			if($this->data["FirstTopic"]==$Topic['topic_id'])
			{
				$active = ",\"opened\":true,\"selected\":true";
			}
			else
			{
				$active = "";
			}
			$itemorder ++;
			echo
			"<li class='division'>
				<div class='topic'>
					<i class='fa fa-video-camera'></i> {$itemorder}.{$Topic['topic_name']}<span class='detail'>{$Topic['topic_duration']}</span>
				</div>
			</li>
			";

		}
		echo "</ul>";
	}

  public function createCourseTableview_new($id, $mode, $order="")
	{
		if($mode == "lesson")
		{
			$url = 'course/' . $id;
			//---------------- get data -----------------//
			$course = engine::api("GET", $url);
			$data["Course"]	= $course['course']['table'];
			$url2 = 'skipcourse/' . $id;
			//---------------- get data -----------------//
			$skip = engine::api("GET", $url2);
			$data["CourseSkip"]	= $skip;
			$skipped 	= array();

      //print_r($course);

			foreach ($data["CourseSkip"] as $CourseSkip)
			{
				array_push($skipped, $CourseSkip['course_sub']);
			}
			$class = "treetable";
			$first = "course-hr";
		}
		else if($mode == "course")
		{
			//Course
			$url = 'subcourse/' . $id;
			//---------------- get data -----------------//
			$course = engine::api("GET", $url);
			$data["Course"]	= $course;

			$class = "";
			$first = "";
		}
		$main = 0;
		echo "<div class='accordion js-accordion accordion--boxed list-group-flush' id='parent'>";
		foreach ($data["Course"] as $Course)
		{
			if(!in_array($Course['course_id'], $skipped))
			{
				$main ++;

				if($Course['course_type'] == "1")
				{
          if($Course['demo'] > 0)
          {
            $stage = "show";
            echo "<div id='lesson-level-{$main}' class='accordion__item'><a href='#' class='accordion__toggle collapsed open' data-toggle='collapse' data-target='#lesson-toc-{$main}' data-parent='#parent'><span class='flex'>{$main}. {$Course['course_name']} </span><span class='accordion__toggle-icon material-icons'>keyboard_arrow_up</span></a>";
          }
          else
          {
            $stage = "hide";
            echo "<div id='lesson-level-{$main}' class='accordion__item'><a href='#' class='accordion__toggle collapsed' data-toggle='collapse' data-target='#lesson-toc-{$main}' data-parent='#parent'><span class='flex'>{$main}. {$Course['course_name']}</span><span class='accordion__toggle-icon material-icons'>keyboard_arrow_down</span></a>";
          }
					echo engine::createCourseTopicTableview_new($Course['course_id'], $main, $stage);
					echo "</div>";
				}
				else if($Course['course_type'] == "2")
				{
					echo "<div class='accordion__item'><div class='course {$first}'><span><i class='ion-ios-paper'></i> {$main}. {$Course['course_name']}</span></div>";
					echo engine::createCourseTableview_new($Course['course_id'],"course",$main);
					echo "</div>";
				}
				$itemorder +=1;
			}
			else
			{
				continue;
			}
		}
		echo "</div>";
	}

  public function studentCoursePermissionTable($id, $mode, $order="")
	{

    $student  = engine::student("id");

    if($mode == "lesson")
		{
      $url = 'course/' . $id . "/" . $student;

			//---------------- get data -----------------//
			$course = engine::api("GET", $url);
			$data["Course"]	= $course['course']['table'];
			$url2 = 'skipcourse/' . $id;
			//---------------- get data -----------------//

			$skip = engine::api("GET", $url2);
			$data["CourseSkip"]	= $skip;
			$skipped 	= array();

			foreach ($data["CourseSkip"] as $CourseSkip)
			{
				array_push($skipped, $CourseSkip['course_sub']);
			}

			$class = "treetable";
			$first = "course-hr";
    }
    else if($mode == "course")
		{
			//Course
			$url = 'subcourse/' . $id;
			//---------------- get data -----------------//
			$course = engine::api("GET", $url);
			$data["Course"]	= $course;

			$class = "";
			$first = "";
		}

	  $main = 0;

    print_r($data["Course"]);

    echo "<div class='border-left-2 page-section pl-32pt'>";

    foreach ($data["Course"] as $Course)
		{
      $main ++;

      if($Course['player_complete']=="1")
      {
        $open       = "open";
        $toggle     = "accordion__toggle";
        $expanded   = "true";
        $show       = "show";
      }
      else
      {
        $open       = "";
        $toggle     = "accordion__toggle collapsed";
        $expanded   = "false";
        $show       = "";
      }

      echo
      "<div class='d-flex align-items-center page-num-container'>
          <div class='page-num'>{$main}</div>
          <h5>{$Course['course_id']} - {$Course['course_name']}-{$Course['player_complete']}</h5>
      </div>

      <!--<p class='text-70 mb-24pt'>Body Text.</p>-->

      <div class='card mb-32pt mb-lg-32pt'>
          <ul class='accordion accordion--boxed js-accordion mb-0' id='toc-{$main}'>
              <li class='accordion__item {$open}'>
                  <a class='{$toggle}' data-toggle='collapse' data-parent='#toc-{$main}' href='#toc-content-{$main}'>
                      <span class='flex'>1/1</span>
                      <span class='accordion__toggle-icon material-icons'>keyboard_arrow_down</span>
                  </a>
                  <div class='accordion__menu'>
                      <ul class='list-unstyled collapse {$show}' id='toc-content-{$main}'>";

                        foreach ($Course['topic'] as $Topic)
                    		{
                          $key = array_search($Topic['topic_id'], array_column($Course['topic'], 'topic_id'));

                          if($key!="0")
                          {
                            $before               = $key-1;
                            $before_stage         = "topic";
                            $before_stage_id      = $Course['topic'][$before]['topic_id'];
                            $before_stage_player  = $Course['topic'][$before]['topic_player_finish'];
                          }
                          else
                          {
                            $course_key = array_search($Course['course_id'], array_column($data["Course"], 'course_id'));

                            if($course_key!="0")
                            {
                              $before               = $course_key-1;
                              $before_stage         = "course";
                              $before_stage_id      = $Course['topic'][$before]['topic_id'];
                              $before_stage_player  = $data["Course"][$before]['player_complete'];
                            }
                            else
                            {
                              $before_stage         = "first";
                              $before_stage_id      = "";
                              $before_stage_player  = "1";
                            }
                          }

                          if($before_stage=="first")
                          {
                            if($Topic['topic_player_finish'] =="0")
                            {
                              $topic_icon = "play_circle_outline";
                            }
                            else if($Topic['topic_player_finish'] =="1")
                            {
                              $topic_icon = "check_circle";
                            }
                            else
                            {
                              $topic_icon = "lock";
                            }
                          }
                          else if($before_stage=="topic")
                          {
                            if($before_stage_player=="1" && $Topic['topic_player_finish'] =="0")
                            {
                              $topic_icon = "play_circle_outline";
                            }
                            else if($before_stage_player=="1" && $Topic['topic_player_finish'] =="1")
                            {
                              $topic_icon = "check_circle";
                            }
                            else
                            {
                              $topic_icon = "lock";
                            }
                          }
                          else if($before_stage=="course")
                          {
                            if($before_stage_player=="1" && $Course['player_complete'] =="0")
                            {
                              $topic_icon = "play_circle_outline";
                            }
                            else if($before_stage_player=="1" && $Course['player_complete'] =="1")
                            {
                              $topic_icon = "check_circle";
                            }
                            else
                            {
                              $topic_icon = "lock";
                            }
                          }

                          echo
                          "<li class='accordion__menu-link'>
                              <span class='material-icons icon-16pt icon--left text-body'>{$topic_icon}</span>
                              <a class='flex' href='student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}'>

                              <strong class='bold'>
                              {$Topic['topic_id']} {$Topic['topic_name']} - {$Topic['topic_player_finish']}/{$before_stage_player}
                              </strong>
                              <!--Body Text.-->

                              </a>
                              <span class='text-muted text-time'>10 คะแนน</span>
                              <span class='d-none d-sm-block'>
                                <span class='survey-progress'>
                                  <span class='survey-progress-bg'>
                                    <span class='survey-progress-fg' style='width: 0%;'></span>
                                  </span>
                                </span>
                                <span class='text-muted text-percent'>0%</span>
                              </span>
                          </li>";
                        }

                        //echo engine::studentCourseTopicPermissionTable($Course['course_id'], $main, $stage);

                      echo
                      "</ul>
                  </div>
              </li>
          </ul>
      </div>";
    }
    echo "</div>";
	}

  public function studentCourseTopicPermissionTable($course, $order, $stage)
	{
		$url = 'topic/' . $course;
		//---------------- get data -----------------//
		$topic = engine::api("GET", $url);

		$data["Topic"]	= $topic;
    $data["Course"]	= $topic['course'];
    $data["Lesson"]	= $topic['lesson'];

		$itemorder = 0;

		foreach ($data["Topic"]['topic'] as $Topic)
		{
      echo
      "<li class='accordion__menu-link'>
          <span class='material-icons icon-16pt icon--left text-body'>check_circle</span>
          <a class='flex' href='student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}'><strong class='bold'>{$Topic['topic_name']}</strong> <!--Body Text.--></a>
          <span class='text-muted text-time'>10 คะแนน</span>
          <span class='d-none d-sm-block'>
            <span class='survey-progress'>
              <span class='survey-progress-bg'>
                <span class='survey-progress-fg' style='width: 0%;'></span>
              </span>
            </span>
            <span class='text-muted text-percent'>0%</span>
          </span>
      </li>";
    }
	}

  //Course Structure
  //----------------------------------------------------------------------------

  public function createCourseTopicTableview_lesson($course, $order, $stage)
	{
    echo
    "<div class='border-left-2 page-section pl-32pt'>

      <div class='d-flex align-items-center page-num-container'>
          <div class='page-num'>1</div>
          <h4>Lesson Header</h4>
      </div>

      <p class='text-70 mb-24pt'>Body Text.</p>

      <div class='card mb-32pt mb-lg-64pt'>
          <ul class='accordion accordion--boxed js-accordion mb-0' id='toc-1'>
              <li class='accordion__item open'>
                  <a class='accordion__toggle' data-toggle='collapse' data-parent='#toc-1' href='#toc-content-1'>
                      <span class='flex'>Course Title</span>
                      <span class='accordion__toggle-icon material-icons'>keyboard_arrow_down</span>
                  </a>
                  <div class='accordion__menu'>
                      <ul class='list-unstyled collapse show' id='toc-content-1'>
                        <li class='accordion__menu-link'>
                            <span class='material-icons icon-16pt icon--left text-body'>check_circle</span>
                            <a class='flex' href='compact-student-take-quiz.html'><strong class='bold'>Topic Title : </strong> Body Text.</a>
                            <span class='text-muted text-time'>10 คะแนน</span>
                            <span class='d-none d-sm-block'>
                              <span class='survey-progress'>
                                <span class='survey-progress-bg'>
                                  <span class='survey-progress-fg' style='width: 100%;'></span>
                                </span>
                              </span>
                              <span class='text-muted text-percent'>100%</span>
                            </span>
                        </li>
                      </ul>
                  </div>
              </li>
          </ul>
      </div>

      <div class='d-flex align-items-center page-num-container'>
          <div class='page-num'>2</div>
          <h4>Lesson Header</h4>
      </div>

      <p class='text-70 mb-24pt'>Body Text.</p>

      <div class='card mb-32pt mb-lg-64pt'>
          <ul class='accordion accordion--boxed js-accordion mb-0' id='toc-2'>
              <li class='accordion__item open'>
                  <a class='accordion__toggle' data-toggle='collapse' data-parent='#toc-2' href='#toc-content-2'>
                      <span class='flex'>Course Title</span>
                      <span class='accordion__toggle-icon material-icons'>keyboard_arrow_down</span>
                  </a>
                  <div class='accordion__menu'>
                      <ul class='list-unstyled collapse show' id='toc-content-2'>
                          <li class='accordion__menu-link'>
                              <span class='material-icons icon-16pt icon--left text-body'>check_circle</span>
                              <a class='flex' href='compact-student-take-lesson.html'><strong class='bold'>Topic Title : </strong> Body Text.</a>
                              <span class='text-muted text-time d-none d-sm-block'>8 นาที 42 วิ</span>
                              <span>
                                <span class='survey-progress'>
                                  <span class='survey-progress-bg'>
                                    <span class='survey-progress-fg' style='width: 100%;'></span>
                                  </span>
                                </span>
                                <span class='text-muted text-percent'>100%</span>
                              </span>
                          </li>
                      </ul>
                  </div>
              </li>
          </ul>
      </div>

      <div class='d-flex align-items-center page-num-container'>
          <div class='page-num'>3</div>
          <h4>Lesson Header</h4>
      </div>

      <p class='text-70 mb-24pt'>Body Text.</p>

      <div class='card mb-0'>
          <ul class='accordion accordion--boxed js-accordion mb-0' id='toc-3'>
              <li class='accordion__item'>
                  <a class='accordion__toggle' data-toggle='collapse' data-parent='#toc-3' href='#toc-content-3'>
                      <span class='flex'>6 หน่วย</span>
                      <span class='accordion__toggle-icon material-icons'>keyboard_arrow_down</span>
                  </a>
                  <div class='accordion__menu'>
                      <ul class='list-unstyled collapse' id='toc-content-3'>
                          <li class='accordion__menu-link'>
                              <span class='material-icons icon-16pt icon--left text-50'>hourglass_empty</span>
                              <a class='flex' href='compact-student-take-lesson.html'>Introduction</a>
                              <span class='text-muted text-time d-none d-sm-block'>8 นาที 42 วิ</span>
                              <span>
                                <span class='survey-progress'>
                                  <span class='survey-progress-bg'>
                                    <span class='survey-progress-fg' style='width: 0%;'></span>
                                  </span>
                                </span>
                                <span class='text-muted text-percent'>0%</span>
                              </span>
                          </li>
                      </ul>
                  </div>
              </li>
          </ul>
      </div>
  </div>";

  }
  //----------------------------------------------------------------------------

  public function createCourseTopicTableview_new($course, $order, $stage)
	{
		$url = 'topic/' . $course;
		//---------------- get data -----------------//
		$topic = engine::api("GET", $url);

		$data["Topic"]	= $topic;
    $data["Course"]	= $topic['course'];
    $data["Lesson"]	= $topic['lesson'];

		$url3 = 'firsttopic_id/' . $this->data["Lesson"]['lesson_id'];
		$firsttopic = engine::api("GET", $url3);
		$this->data["FirstTopic"]	= $firsttopic;

		$itemorder = 0;

		echo "<div class='accordion__menu collapse {$stage}' id='lesson-toc-{$order}'>";

		foreach ($data["Topic"]['topic'] as $Topic)
		{
			if($this->data["FirstTopic"]==$Topic['topic_id'])
			{
				$active = ",\"opened\":true,\"selected\":true";
			}
			else
			{
				$active = "";
			}
			$itemorder ++;

      if($Topic['topic_demo']=="1")
      {
        $topic_icon =
        "<span class='icon-holder icon-holder--small icon-holder--primary rounded-circle d-inline-flex icon--left'>
            <i class='material-icons icon-16pt'>play_circle_outline</i>
        </span>";

        $url = "<a class='flex' href='course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}'>{$Topic['topic_name']} <span class='speech-bubble'>ทดลองเรียน</span></a>";
      }
      else
      {
        $topic_icon =
        "<span class='icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left'>
            <i class='material-icons icon-16pt'>lock</i>
        </span>";

        $url = "<a class='flex' href='javascript:void(0);'>{$Topic['topic_name']}</a>";
      }
			echo
			"<div class='accordion__menu-link'>
          {$topic_icon} {$url} <span class='text-muted'>{$Topic['topic_duration']}</span>
			</div>";
		}
		echo "</div>";
	}

	public function createQuiz($quizcode)
	{
		//Get Contest Table || -------------------------------------------------------------------------
		$url = 'quiz/table/' . $quizcode;
		//---------------- get data -----------------//
		$quiz = engine::api("GET", $url);
		$data["Quiz"]	= $quiz;

		echo " var Questionstime = '{$data["Quiz"]['time']}';";
		echo " var allQuestions =  [";

		foreach ($data["Quiz"] as $Quiz)
		{
			$count = count($Quiz);

			if($count>1)
			{
				$type = $Quiz['quiz_type'];

				if($type=="1")
				{
					$content = $Quiz['quiz_content'];
				}
				else if($type=="2")
				{
					$content = "<img src=\"{$GLOBALS["School"]['cdn']}img.php?file={$Quiz['quiz_content']}\" alt=\"Barca\" class=\"img-responsive\">";
				}
				else if($type=="3")
				{
					$content = "<video poster=\"\" controls><source src=\"{$GLOBALS["School"]['cdn']}vdo.php?file={$Quiz['quiz_content']}\" type=\"video/mp4\"></video>";
				}

				echo " {question: '{$content}',";
				echo "answers: [";

				//Get Contest Table || -------------------------------------------------------------------------
				$answer_url 		= 'quiz/answer/' . $Quiz['quiz_id'];
				$answer 			  = engine::api("GET", $answer_url);
				$data["Answer"]	= $answer;
				//---------------- get data -----------------//

				$key = array_search($Quiz['quiz_anwser'], array_column($answer, 'answer_id'));
				foreach ($data["Answer"] as $Answer)
				{
					if($Quiz['quiz_anwser'] == $Answer['answer_id'])
					{
						$check = "*";
					}
					else
					{
						$check = "";
					}
					echo "'{$Answer['answer_name']} {$check}',";
				}
				//---------------- get data -----------------//
				echo "],";
				echo "correctAnswer:{$key}},";
			}
		}
		echo "],totalQuestions = allQuestions.length;";
	}

	public function arraySearch($array, $field, $search)
	{
		foreach($array as $key => $value){
			if ($value["data"][$field] === $search)
				return $key;
		}
		return false;
	}

	public function bitcoin($price,$type)
	{
		$url = "https://blockchain.info/ticker";
		$json = file_get_contents($url);
		$json_data = json_decode($json, true);

		return engine::baht($json_data[$price][$type],$json_data[$price]["symbol"]);
	}

	public function Ago($time_ago)
	{
		$time_ago = strtotime($time_ago);
		$cur_time   = time();
		$time_elapsed   = $cur_time - $time_ago;
		$seconds    = $time_elapsed ;
		$minutes    = round($time_elapsed / 60 );
		$hours      = round($time_elapsed / 3600);
		$days       = round($time_elapsed / 86400 );
		$weeks      = round($time_elapsed / 604800);
		$months     = round($time_elapsed / 2600640 );
		$years      = round($time_elapsed / 31207680 );
		// Seconds
		if($seconds <= 60){
			return "เดี๋ยวนี้";
		}
		//Minutes
		else if($minutes <=60){
			if($minutes==1){
				return "1 นาทีที่แล้ว";
			}
			else{
				return "$minutes นาทีที่ผ่านมา";
			}
		}
		//Hours
		else if($hours <=24){
			if($hours==1){
				return "ชั่วโมงที่แล้ว";
			}else{
				return "$hours ชั่วโมงที่ผ่านมา";
			}
		}
		//Days
		else if($days <= 7){
			if($days==1){
				return "เมื่อวาน";
			}else{
				return "$days วันที่ผ่านมา";
			}
		}
		//Weeks
		else if($weeks <= 4.3){
			if($weeks==1){
				return "สัปดาห์ที่แล้ว";
			}else{
				return "$weeks สัปดาห์ที่ผ่านมา";
			}
		}
		//Months
		else if($months <=12){
			if($months==1){
				return "เดือนที่แล้ว";
			}else{
				return "$months เดือนที่ผ่านมา";
			}
		}
		//Years
		else{
			if($years==1){
				return "ปีที่แล้ว";
			}else{
				return "$years ปีที่ผ่านมา";
			}
		}
	}

	public function baht($number,$txt="")
	{
		if($number =="0")
		{
			return $number;
		}
		else
		{
			$output = number_format($number, 0, '.', ',');
			return $output . " " . $txt;
		}
	}

	public function password($str1, $str3)
	{
		//---------------------------------------------------------------------------------------
		$str2 = "DA1jVgspSrzf5qEOHXKypVvZwrNsV8wIOz9Q4AcvJIozz9pkf3isRh1H9U94LOGox3eaGuukgA5QcBjqXg2awntGseGDyFCuO9OG9QR1QRNpNkJEX0OF4Abi365wjqxbtHTQT7j6VcUIvkDYRhKUi2oPAl1N6zhUmJESxG1NdUobVMJwzS3tUj0RfxORAmrU759IT5j0";
		//---------------------------------------------------------------------------------------
		$pwd = hash('sha512', $str1 . $str2 . $str3);
		//---------------------------------------------------------------------------------------
		return $pwd;
	}

	public function thaidate($strDate, $type="full")
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];

		if($type=="full")
		{
			return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		}
		else if($type=="date")
		{
			return "$strDay $strMonthThai $strYear";
		}
		if($type=="time")
		{
			return "$strHour:$strMinute";
		}

	}

	function num2wordsThai($num, $prefix="")
	{
		$num=str_replace(",","",$num);
		$num_decimal=explode(".",$num);
		$num=$num_decimal[0];
		$returnNumWord;
		$lenNumber=strlen($num);
		$lenNumber2=$lenNumber-1;
		$kaGroup=array("","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน");
		$kaDigit=array("","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ต","แปด","เก้า");
		$kaDigitDecimal=array("ศูนย์","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ต","แปด","เก้า");
		$ii=0;
		for($i=$lenNumber2;$i>=0;$i--){
			$kaNumWord[$i]=substr($num,$ii,1);
			$ii++;
		}
		$ii=0;
		for($i=$lenNumber2;$i>=0;$i--){
			if(($kaNumWord[$i]==2 && $i==1) || ($kaNumWord[$i]==2 && $i==7)){
				$kaDigit[$kaNumWord[$i]]="ยี่";
			}else{
				if($kaNumWord[$i]==2){
					$kaDigit[$kaNumWord[$i]]="สอง";
				}
				if(($kaNumWord[$i]==1 && $i<=2 && $i==0) || ($kaNumWord[$i]==1 && $lenNumber>6 && $i==6)){
					if($kaNumWord[$i+1]==0){
						$kaDigit[$kaNumWord[$i]]="หนึ่ง";
					}else{
						$kaDigit[$kaNumWord[$i]]="เอ็ด";
					}
				}elseif(($kaNumWord[$i]==1 && $i<=2 && $i==1) || ($kaNumWord[$i]==1 && $lenNumber>6 && $i==7)){
					$kaDigit[$kaNumWord[$i]]="";
				}else{
					if($kaNumWord[$i]==1){
						$kaDigit[$kaNumWord[$i]]="หนึ่ง";
					}
				}
			}
			if($kaNumWord[$i]==0){
				if($i!=6){
					$kaGroup[$i]="";
				}
			}
			$kaNumWord[$i]=substr($num,$ii,1);
			$ii++;
			$returnNumWord.=$kaDigit[$kaNumWord[$i]].$kaGroup[$i];
		}
		if(isset($num_decimal[1])){
			$returnNumWord.="จุด";
			for($i=0;$i<strlen($num_decimal[1]);$i++){
					$returnNumWord.=$kaDigitDecimal[substr($num_decimal[1],$i,1)];
			}
		}
		if($prefix!="")
		{
			return $returnNumWord . $prefix;
		}
		else
		{
			return $returnNumWord;
		}

	}

	public function sortArrayByKey(&$array,$key,$string = false,$asc = true)
	{
		if($string){
			usort($array,function ($a, $b) use(&$key,&$asc)
			{
				if($asc)    return strcmp(strtolower($a{$key}), strtolower($b{$key}));
				else        return strcmp(strtolower($b{$key}), strtolower($a{$key}));
			});
		}else{
			usort($array,function ($a, $b) use(&$key,&$asc)
			{
				if($a[$key] == $b{$key}){return 0;}
				if($asc) return ($a{$key} < $b{$key}) ? -1 : 1;
				else     return ($a{$key} > $b{$key}) ? -1 : 1;

			});
		}
	}

	public function shorttext($string, $max = 255)
	{
		 if(mb_strlen($string, 'utf-8') >= $max){
			   $string = mb_substr($string, 0, $max - 5, 'utf-8').'...';
		   } return $string;
	}

	public function cleanString($string)
	{
		$clear = strip_tags($string);
		return $clear;
	}

	public function base64img($img)
	{
		$url = $GLOBALS["School"]['cdn'] . 'storage/files/client/' . $img;
		$image = file_get_contents($url);
		if ($image !== false)
		{
			return 'data:image/png;base64,'.base64_encode($image);
		}
	}

	public function today()
	{
		return date('Y-m-d H:i:s');
	}

	public function howManyDays($startDate,$endDate)
	{

		$date1  = strtotime($startDate);
		$date2  = strtotime($endDate);
		$res    =  (int)(($date2-$date1)/86400);

		return $res;
	}

	public function daydiff($startDate, $endDate, $mode)
	{

		$date1  = strtotime($startDate);
		$date2  = strtotime($endDate);
		$res    	=  (int)(($date2-$date1)/86400);

		if($mode=="format")
		{
			if($res<0)
			{

				$diff = "หมดอายุแล้ว " . abs($res) . " วัน";
			}
			else
			{
				$diff = "เหลืออีก " . $res . " วัน";
			}

		}
		else if($mode=="raw")
		{
			$diff = $res;
		}

		return $diff;
	}

	public function secondToTimestamp($total_secs)
	{
		if($total_secs<3600)
		{
			$optional = "00:";
		}
		else if($total_secs<36000 && $total_secs>=3600)
		{
			$optional = "0";
		}
		else
		{
			$optional = "";
		}

		//time settings
		$hours = floor($total_secs / 3600);
		$mins = floor(($total_secs - ($hours*3600)) / 60);
		$secs = floor($total_secs % 60);

		//if hours zero, give for nothing like that (45:05)
		if ($hours<1) { $hours = ''; } else { $hours = $hours.':'; }
		if ($mins<10) { $mins = '0'.$mins.':'; } else { $mins = $mins.':'; }
		if ($secs<10) { $secs = '0'.$secs; } else { $secs = $secs; }

		return $output = $optional.$hours.$mins.$secs; //
	}

	public function mime2ext($mime){
		$all_mimes = '{"png":["image\/png","image\/x-png"],"bmp":["image\/bmp","image\/x-bmp",
		"image\/x-bitmap","image\/x-xbitmap","image\/x-win-bitmap","image\/x-windows-bmp",
		"image\/ms-bmp","image\/x-ms-bmp","application\/bmp","application\/x-bmp",
		"application\/x-win-bitmap"],"gif":["image\/gif"],"jpeg":["image\/jpeg",
		"image\/pjpeg"],"xspf":["application\/xspf+xml"],"vlc":["application\/videolan"],
		"wmv":["video\/x-ms-wmv","video\/x-ms-asf"],"au":["audio\/x-au"],
		"ac3":["audio\/ac3"],"flac":["audio\/x-flac"],"ogg":["audio\/ogg",
		"video\/ogg","application\/ogg"],"kmz":["application\/vnd.google-earth.kmz"],
		"kml":["application\/vnd.google-earth.kml+xml"],"rtx":["text\/richtext"],
		"rtf":["text\/rtf"],"jar":["application\/java-archive","application\/x-java-application",
		"application\/x-jar"],"zip":["application\/x-zip","application\/zip",
		"application\/x-zip-compressed","application\/s-compressed","multipart\/x-zip"],
		"7zip":["application\/x-compressed"],"xml":["application\/xml","text\/xml"],
		"svg":["image\/svg+xml"],"3g2":["video\/3gpp2"],"3gp":["video\/3gp","video\/3gpp"],
		"mp4":["video\/mp4"],"m4a":["audio\/x-m4a"],"f4v":["video\/x-f4v"],"flv":["video\/x-flv"],
		"webm":["video\/webm"],"aac":["audio\/x-acc"],"m4u":["application\/vnd.mpegurl"],
		"pdf":["application\/pdf","application\/octet-stream"],
		"pptx":["application\/vnd.openxmlformats-officedocument.presentationml.presentation"],
		"ppt":["application\/powerpoint","application\/vnd.ms-powerpoint","application\/vnd.ms-office",
		"application\/msword"],"docx":["application\/vnd.openxmlformats-officedocument.wordprocessingml.document"],
		"xlsx":["application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application\/vnd.ms-excel"],
		"xl":["application\/excel"],"xls":["application\/msexcel","application\/x-msexcel","application\/x-ms-excel",
		"application\/x-excel","application\/x-dos_ms_excel","application\/xls","application\/x-xls"],
		"xsl":["text\/xsl"],"mpeg":["video\/mpeg"],"mov":["video\/quicktime"],"avi":["video\/x-msvideo",
		"video\/msvideo","video\/avi","application\/x-troff-msvideo"],"movie":["video\/x-sgi-movie"],
		"log":["text\/x-log"],"txt":["text\/plain"],"css":["text\/css"],"html":["text\/html"],
		"wav":["audio\/x-wav","audio\/wave","audio\/wav"],"xhtml":["application\/xhtml+xml"],
		"tar":["application\/x-tar"],"tgz":["application\/x-gzip-compressed"],"psd":["application\/x-photoshop",
		"image\/vnd.adobe.photoshop"],"exe":["application\/x-msdownload"],"js":["application\/x-javascript"],
		"mp3":["audio\/mpeg","audio\/mpg","audio\/mpeg3","audio\/mp3"],"rar":["application\/x-rar","application\/rar",
		"application\/x-rar-compressed"],"gzip":["application\/x-gzip"],"hqx":["application\/mac-binhex40",
		"application\/mac-binhex","application\/x-binhex40","application\/x-mac-binhex40"],
		"cpt":["application\/mac-compactpro"],"bin":["application\/macbinary","application\/mac-binary",
		"application\/x-binary","application\/x-macbinary"],"oda":["application\/oda"],
		"ai":["application\/postscript"],"smil":["application\/smil"],"mif":["application\/vnd.mif"],
		"wbxml":["application\/wbxml"],"wmlc":["application\/wmlc"],"dcr":["application\/x-director"],
		"dvi":["application\/x-dvi"],"gtar":["application\/x-gtar"],"php":["application\/x-httpd-php",
		"application\/php","application\/x-php","text\/php","text\/x-php","application\/x-httpd-php-source"],
		"swf":["application\/x-shockwave-flash"],"sit":["application\/x-stuffit"],"z":["application\/x-compress"],
		"mid":["audio\/midi"],"aif":["audio\/x-aiff","audio\/aiff"],"ram":["audio\/x-pn-realaudio"],
		"rpm":["audio\/x-pn-realaudio-plugin"],"ra":["audio\/x-realaudio"],"rv":["video\/vnd.rn-realvideo"],
		"jp2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"tiff":["image\/tiff"],
		"eml":["message\/rfc822"],"pem":["application\/x-x509-user-cert","application\/x-pem-file"],
		"p10":["application\/x-pkcs10","application\/pkcs10"],"p12":["application\/x-pkcs12"],
		"p7a":["application\/x-pkcs7-signature"],"p7c":["application\/pkcs7-mime","application\/x-pkcs7-mime"],"p7r":["application\/x-pkcs7-certreqresp"],"p7s":["application\/pkcs7-signature"],"crt":["application\/x-x509-ca-cert","application\/pkix-cert"],"crl":["application\/pkix-crl","application\/pkcs-crl"],"pgp":["application\/pgp"],"gpg":["application\/gpg-keys"],"rsa":["application\/x-pkcs7"],"ics":["text\/calendar"],"zsh":["text\/x-scriptzsh"],"cdr":["application\/cdr","application\/coreldraw","application\/x-cdr","application\/x-coreldraw","image\/cdr","image\/x-cdr","zz-application\/zz-winassoc-cdr"],"wma":["audio\/x-ms-wma"],"vcf":["text\/x-vcard"],"srt":["text\/srt"],"vtt":["text\/vtt"],"ico":["image\/x-icon","image\/x-ico","image\/vnd.microsoft.icon"],"csv":["text\/x-comma-separated-values","text\/comma-separated-values","application\/vnd.msexcel"],"json":["application\/json","text\/json"]}';
		$all_mimes = json_decode($all_mimes,true);
		foreach ($all_mimes as $key => $value) {
			if(array_search($mime,$value) !== false) return $key;
		}
		return false;
	}

	function page_image($str)
	{
	  $output = preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $str, $matches);
	  return $matches[1][0];
	}

	public function currency($number)
	{
		$money_number = number_format($number,0,'.',',');
		return $money_number;
	}

}

?>
