<?php
class discussion extends fw_controller
{
    public $m_core;

    public function __construct()
    {
        $this->m_core = new m_core();
        $this->initial();
        //--------------------------------------------
        $this->data["title"] = "พูดคุย";
        //--------------------------------------------
    }

    public function index()
    {
        $meta = array(
            'title' => $this->data["title"],
            'subtitle' => "Access Denied",
            'page' => "",
            'seo' => "",
            'type' => "sub-layout",
        );

        $this->theme("luma", "discussion", "chat", $meta, $this->data);
    }

    public function instructor()
    {
        $meta = array(
            'title' => $this->data["title"],
            'subtitle' => "เข้าสู่ระบบ",
            'page' => "",
            'seo' => "",
            'type' => "sub-layout",
        );

        $this->theme("luma", "discussion", "chat", $meta, $this->data);
    }

    public function student()
    {
        $meta = array(
            'title' => $this->data["title"],
            'subtitle' => "ลงทะเบียน",
            'page' => "",
            'seo' => "",
            'type' => "sub-layout",
        );

        $this->theme("luma", "discussion", "chat", $meta, $this->data);
    }

    public function forgot_password()
    {
        $meta = array(
            'title' => $this->data["title"],
            'subtitle' => "ลืมรหัสผ่าน",
            'page' => "",
            'type' => "login",
            'seo' => "",
        );

        $this->theme("luma-login", "auth", "forgot", $meta, $this->data);
    }

    public function action($args)
    {
        header('Content-Type: application/json');

        $action = $args[0];

        switch ($action)
        {
            case "login":
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

            case "logout":
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

        }
    }
}
?>
