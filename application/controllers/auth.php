<?php
class auth extends fw_controller
{
    public $m_core;

    public function __construct()
    {
        $this->m_core = new m_core();
        $this->initial();
        //--------------------------------------------
        $this->data["title"] = "บัญชี";
        //--------------------------------------------
    }

    public function index()
    {
      $meta = array
      (
        'title' => $this->data["title"],
        'subtitle' => "Access Denied",
        'page' => "",
        'type' => "login",
        'seo' => "",
      );
      $this->theme("default", "auth", "login", $meta, $this->data);
    }

    public function login()
    {
      $meta = array
      (
        'title' => $this->data["title"],
        'subtitle' => "เข้าสู่ระบบ",
        'page' => "",
        'type' => "login",
        'seo' => "",
      );
      $this->theme("default", "auth", "login", $meta, $this->data);
    }

    public function reset()
    {
      $meta = array
      (
        'title' => $this->data["title"],
        'subtitle' => "ลืมรหัสผ่าน/ตั้งค่าบัญชีใหม่",
        'page' => "",
        'type' => "login",
        'seo' => "",
      );
      $this->theme("default", "auth", "reset", $meta, $this->data);
    }

    public function bypass()
    {
      $meta = array
      (
        'title' => $this->data["title"],
        'subtitle' => "เข้าสู่ระบบ",
        'page' => "",
        'type' => "login",
        'seo' => "",
      );
      $this->theme("default", "auth", "bypass", $meta, $this->data);
    }

    public function register()
    {
      $meta = array
      (
        'title' => $this->data["title"],
        'subtitle' => "ลงทะเบียน",
        'page' => "",
        'type' => "login",
        'seo' => "",
      );
      $this->theme("default", "auth", "register", $meta, $this->data);
    }

    public function forgot_password()
    {
      $meta = array
      (
        'title' => $this->data["title"],
        'subtitle' => "ลืมรหัสผ่าน",
        'page' => "",
        'type' => "login",
        'seo' => "",
      );
      $this->theme("login", "auth", "forgot", $meta, $this->data);
    }

    public function recovery($args)
    {
      $ref  = $args[0];
      $this->data["Auth"]['key'] = $ref;

      $meta = array
      (
        'title' => $this->data["title"],
        'subtitle' => "ตั้งรหัสผ่านใหม่",
        'page' => "",
        'type' => "login",
        'seo' => "",
      );
      $this->theme("default", "auth", "change", $meta, $this->data);
    }

    public function action($args)
    {
      $action = $args[0];
      switch ($action)
      {
        case "login":

        ob_end_clean();

        //** API
        $data = array
        (
          'username' => $_POST['username'],
          'password' => $_POST['password'],
        );
        $student  = engine::api("POST", 'user/login/', $data);

        //** RETURN
        $status   = $student['login'];
        $return   = $student['return'];

        //** LOGIN PROCESS
        if ($status == "true")
        {
          if (!isset($_SESSION["Student"]))
          {
            unset($_SESSION["Student"]);
          }

          $User                  = array();
          $User["id"]            = $student["student_id"];
          $User["code"]          = $student["student_code"];
          $User["username"]      = $student["student_username"];
          $User["firstname"]     = $student["student_firstname"];
          $User["lastname"]      = $student["student_lastname"];
          $User["token"]         = $student["student_token"];
          $User["email"]         = $student["student_email"];
          $User["phone"]         = $student["student_phone"];
          $User["avatar"]        = $student["student_avatar"];
          $User["address"]       = $student["student_address"];
          $User["district"]      = $student["student_district"];
          $User["district-name"] = $student["DISTRICT_NAME"];
          $User["amphures"]      = $student["student_amphures"];
          $User["amphures-name"] = $student["AMPHUR_NAME"];
          $User["province"]      = $student["student_province"];
          $User["province-name"] = $student["PROVINCE_NAME"];
          $User["zipcode"]       = $student["student_zipcode"];
          $User["zipcode-name"]  = $student["zipcode"];
          $User["type"]          = $student["access"]['type'];
          $User["status"]        = $student["student_status"];
          $User["level"]         = $student["student_level"];
          $User["regdate"]       = $student["student_regdate"];

          $User["access"]['token']     = $student["access"]['token'];
          $User["access"]['etracking'] = $student["access"]['etracking'];
          $User["access"]['elearning'] = $student["access"]['elearning'];

          $User["login"]         = true;
          $_SESSION["Student"]   = $User;
          $student_id            = $_SESSION["Student"]["student_id"];
        }

        $trace = array
        (
          "status" => $status,
          "return" => $return,
        );

        echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        break;

        case "logout":

        ob_end_clean();

        if (isset($_SESSION["Student"]))
        {
          unset($_SESSION["Student"]);
          unset($_SESSION["Quiz"]);
          unset($_SESSION["QuizProgress"]);
          unset($_SESSION["Player"]);

          $trace = array
          (
            "status" => "true",
            "return" => "ออกจากระบบเรียบร้อย",
          );

          echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

        break;

        case "signup":

        ob_end_clean();

        $check= "";
        if($_POST['password'] != $_POST['cpassword'])
        {
          $check = "รหัสผ่านที่กรอกไม่ตรงกัน";
        }

        if($_POST['cpassword']=="")
        {
          $check = "กรุณากรอกรหัสผ่านยืนยันก่อน";
        }

        if($check=="")
        {
          $data = array
          (
            'name'      => $_POST['name'],
            'lastname'  => $_POST['lastname'],
            'email'     => $_POST['email'],
            'password'  => $_POST['password'],
            'phone'     => $_POST['phone'],

            'title'       => $_POST['title'],
            'depart_type' => $_POST['depart_type'],
            'depart_name' => $_POST['depart_name'],
            'occupation'  => $_POST['occupation'],
            'age'         => $_POST['age'],
            'sex'         => $_POST['sex'],
          );

          $signup = engine::api("POST", 'user/add/', $data);

          $status = $signup['status'];
          $return = $signup['return'];

          $trace = array
          (
            "status" => $status,
            "return" => $return,
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

        echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        break;

        case "confirm":
        //
        ob_end_clean();

        $check = "";

        if ($_POST['code'] == "" | $_POST['key'] == "")
        {
          $check = "กรุณาตรวจสอบข้อมูลการยืนยันของคุณให้ถูกต้อง";
          $trace = array
          (
            "status" => "false",
            "return" => $check,
          );
        }
        else
        {
          $data = array
          (
            'code' => $_POST['code'],
            'key' => $_POST['key'],
          );

          $url    = 'confirmStudentAction/';
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

          $trace = array
          (
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

        ob_end_clean();

        $data = array
        (
          'email' => $_POST['email'],
        );

        $signup = engine::api("POST", 'user/forgotpassword/', $data);

        $status = $signup['status'];
        $return = $signup['return'];

        $trace = array
        (
          "status" => $status,
          "return" => $return,
        );

        echo json_encode($signup, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        break;

        case "recovery":

          ob_end_clean();

          $data = array
          (
            'token'     => $_POST['token'],
            'password'  => $_POST['password'],
            'cpassword' => $_POST['cpassword'],
          );

          $url = 'user/recovery/';
          //---------------- get data -----------------//
          $signup = engine::api("POST", $url, $data);

          $status = $signup['status'];
          $return = $signup['return'];

          $trace = array
          (
            "status" => $status,
            "return" => $return,
          );

          echo json_encode($signup, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        break;

      }
    }
}
?>
