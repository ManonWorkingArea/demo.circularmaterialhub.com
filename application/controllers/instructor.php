<?php
class instructor extends fw_controller
{
    public $m_core;

    public function __construct()
    {
        $this->m_core = new m_core();
        $this->initial();
        //--------------------------------------------
        $this->data["title"] = "ผู้สอน";
        //--------------------------------------------
    }

    public function index($args)
    {
        $meta = array(
        'title'     => $this->data["title"],
        'subtitle'  => "ภาพรวมบัญชีผู้สอน",
        'page'      => "",
        'seo'       => "",
        );
        $this->theme("default", "instructor", "index", $meta, $this->data);
    }

    public function detail($args)
    {
        $meta = array(
        'title'     => $this->data["title"],
        'subtitle'  => "ภาพรวมบัญชีผู้สอน",
        'page'      => "",
        'seo'       => "",
        );
        $this->theme("default", "instructor", "index", $meta, $this->data);
    }
    //TODO:test
    public function course($args)
    {
        $course_code  = $args[0];
        $topic_code   = $args[1];

        if ($course_code == "add") //รายการคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "จัดการหลักสูตร",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "course-add", $meta, $this->data);
        }
        else if ($course_code == "edit") //รายการคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "จัดการหลักสูตร",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "course-add", $meta, $this->data);
        }
        else if ($course_code == NULL && $topic_code==NULL) //รายการคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "จัดการหลักสูตร",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "course", $meta, $this->data);
        }
        else if ($course_code != NULL && $topic_code==NULL) // รายละเอียดคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "รายละเอียดหลักสูตร",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "course-review", $meta, $this->data);
        }
        else if ($course_code != NULL && $topic_code!=NULL) // รายละเอียดคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "บทเรียน",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "course-topic", $meta, $this->data);
        }
    }

    public function quiz($args)
    {
        $quiz_code  = $args[0];
        $topic_code = $args[1];

        if ($quiz_code == "add") //รายการคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "จัดการแบบทดสอบ",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "quiz-add", $meta, $this->data);
        }
        else if ($quiz_code == "edit") //รายการคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "จัดการแบบทดสอบ",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "quiz-add", $meta, $this->data);
        }
        else if ($quiz_code == NULL && $topic_code==NULL) //รายการคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "จัดการแบบทดสอบ",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "quiz", $meta, $this->data);
        }
        else if ($quiz_code != NULL && $topic_code==NULL) // รายละเอียดคอร์ส
        {
            $meta       = array(
            'title'     => $this->data["title"],
            'subtitle'  => "หลักสูตร",
            'page'      => "",
            'type'      => "",
            'seo'       => "",
            );

            $this->theme("luma", "instructor", "quiz-review", $meta, $this->data);
        }
        else if ($quiz_code != NULL && $topic_code!=NULL) // รายละเอียดคอร์ส
        {
            $meta        = array(
            'title'      => $this->data["title"],
            'subtitle'   => "บทเรียน",
            'page'       => "",
            'type'       => "",
            'seo'        => "",
            );

            $this->theme("luma", "instructor", "quiz-play", $meta, $this->data);
        }
    }

    public function earnings($args)
    {
        $course_code = $args[0];
        $topic_code = $args[1];

        $meta       = array(
        'title'     => $this->data["title"],
        'subtitle'  => "รายได้",
        'page'      => "",
        'type'      => "",
        'seo'       => "",
        );

        $this->theme("luma", "instructor", "earnings", $meta, $this->data);
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

                $trace = array(
                    "status" => $status,
                    "title" => $title,
                    "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "edit-profile":
                //
                ob_end_clean();

                $student = engine::student("id");
                $data = array(
                    'student' => $student,
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'phone' => $_POST['phone'],
                );

                $url = 'editprofile/';
                //---------------- get data -----------------//
                $signup = engine::api("POST", $url, $data);

                $status = $signup['status'];
                $title = $signup['title'];
                $return = $signup['return'];

                if ($status)
                {
                    $_SESSION["Student"]["firstname"] = $_POST['firstname'];
                    $_SESSION["Student"]["lastname"] = $_POST['lastname'];
                    $_SESSION["Student"]["phone"] = $_POST['phone'];
                }

                $trace = array(
                    "status" => $status,
                    "title" => $title,
                    "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

            case "edit-password":
                //
                ob_end_clean();

                $student = engine::student("id");
                $data = array(
                    'student' => $student,
                    'old-password' => $_POST['old-password'],
                    'new-password-1' => $_POST['new-password-1'],
                    'new-password-2' => $_POST['new-password-2'],
                );

                $url = 'changepassword/';
                //---------------- get data -----------------//
                $signup = engine::api("POST", $url, $data);

                $status = $signup['status'];
                $title = $signup['title'];
                $return = $signup['return'];

                $trace = array(
                    "status" => $status,
                    "title" => $title,
                    "return" => $return,
                );

                echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            break;

        }
    }
}
?>
