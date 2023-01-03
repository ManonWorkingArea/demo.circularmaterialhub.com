<?php

class page extends fw_controller
{
  public $m_core;
  public function __construct()
  {
    $this->m_core = new m_core();
    $this->initial();
    engine::ini();
    $this->data["title"] = "เนื้อหา";
  }

  public function index($args)
  {
    $meta = array
    (
      'title' 		=> $this->data["title"],
      'subtitle' 	=> "หน้า",
      'page' 		  => "",
      'seo' 			=> "",
    );
    $this->theme("default", "page", "index", $meta, $this->data);
  }

  public function view($args)
  {
    $page = $args[0];
    $post = $args[1];

    switch ($page)
    {
      case "guidelines":

        $page_title = "หลักเกณฑ์ Eco Factory";

        $url        = "cms/post/" . $page;
        $postRow    = engine::api("GET", $url);
        $this->data["Post"] = $postRow;

      break;

      case "benefits":

        $page_title = "สิทธิประโยชน์";

        $url        = "cms/post/" . $page;
        $postRow    = engine::api("GET", $url);
        $this->data["Post"] = $postRow;

      break;

      case "procedure":

        $page_title = "ขั้นตอนและตารางกาiประชุม";

        $url        = "contact/meeting";
        $meeting    = engine::api("GET", $url);
        $this->data["meeting"] = $meeting;

        $url        = "cms/post/" . $page;
        $postRow    = engine::api("GET", $url);
        $this->data["Post"] = $postRow;

      break;

      case "certified_factory":

        if(!isset($_GET["page"]))
        {
          $pageNUm = 1;
        }
        else
        {
          $pageNUm = $_GET["page"];
        }

        $is_search = (isset($_GET['search'])) ? true : false;

        if($is_search)
        {
          $search       = "&search=true";
          $reg_code_old = (isset($_GET['reg_code_old'])) ? "&reg_code_old=" . $_GET['reg_code_old'] : "&reg_code_old=all";
          $reg_code_new = (isset($_GET['reg_code_new'])) ? "&reg_code_new=" . $_GET['reg_code_new'] : "&reg_code_new=all";
          $reg_code_fti = (isset($_GET['reg_code_fti'])) ? "&reg_code_fti=" . $_GET['reg_code_fti'] : "&reg_code_fti=all";
          $name         = (isset($_GET['name'])) ? "&name=" . $_GET['name'] : "&name=all";
          $province     = (isset($_GET['province'])) ? "&province=" . $_GET['province'] : "&province=all";
          $year         = (isset($_GET['year'])) ? "&year=" . $_GET['year'] : "&year=all";
          $type         = (isset($_GET['type'])) ? "&type=" . $_GET['type'] : "&type=all";
          $area         = (isset($_GET['area'])) ? "&area=" . $_GET['area'] : "&area=all";
          $estate       = (isset($_GET['estate'])) ? "&estate=" . $_GET['estate'] : "&estate=all";
        }

        $page_title = "รายชื่อโรงงานที่ได้รับการรับรอง";
        $url        = "contact/factory?page=" . $pageNUm . $search . $reg_code_old . $reg_code_new . $reg_code_fti . $name . $province . $year . $type . $area . $estate;
        $factory    = engine::api("GET", $url);
        $this->data["factory"] = $factory;

      break;

      case "certified_verifier":

        if(!isset($_GET["page"]))
        {
          $pageNUm = 1;
        }
        else
        {
          $pageNUm = $_GET["page"];
        }

        $is_search = (isset($_GET['search'])) ? true : false;

        if($is_search)
        {
          $search       = "&search=true";
          $name         = (isset($_GET['name'])) ? "&name=" . $_GET['name'] : "&name=all";
          $company      = (isset($_GET['company'])) ? "&company=" . $_GET['company'] : "&company=all";
          $specializes  = (isset($_GET['specializes'])) ? "&specializes=" . $_GET['specializes'] : "&specializes=all";
        }

        $page_title     = "รายชื่อmujปรึกษา";

        $url            = "contact/verifier?page=" . $pageNUm . $search . $name . $company . $specializes;
        $verifier        = engine::api("GET", $url);
        $this->data["verifier"] = $verifier;

      break;

      case "certified_auditor":

        if(!isset($_GET["page"]))
        {
          $pageNUm = 1;
        }
        else
        {
          $pageNUm = $_GET["page"];
        }

        $is_search = (isset($_GET['search'])) ? true : false;

        if($is_search)
        {
          $search       = "&search=true";
          $name         = (isset($_GET['name'])) ? "&name=" . $_GET['name'] : "&name=all";
          $company      = (isset($_GET['company'])) ? "&company=" . $_GET['company'] : "&company=all";
          $specializes  = (isset($_GET['specializes'])) ? "&specializes=" . $_GET['specializes'] : "&specializes=all";
        }

        $page_title     = "รายชื่อผู้ตรวจประเมิน";

        $url            = "contact/auditor?page=" . $pageNUm . $search . $name . $company . $specializes;
        $auditor        = engine::api("GET", $url);
        $this->data["auditor"] = $auditor;

      break;

      case "news":

        if(isset($post))
        {
          $page           = "post_news";
          $url            = "cms/post_page/" . $post;
          $contentRow     = engine::api("GET", $url);

          $this->data["Page"] = $contentRow['page'];
          $this->data["Post"] = $contentRow['post'];

          $page_title = "ข่าวสารประชาสัมพันธ์ / " . $this->data["Post"]['post_name'];
        }
        else 
        {
          $url        = "cms/page/" . $page;
          $postRow    = engine::api("GET", $url);

          $this->data["Page"] = $postRow;

          $page_title = "ข่าวสารประชาสัมพันธ์";
        }
        
      break;

      case "download":

        $page_title = "เอกสารดาวน์โหลด";
        $url        = "cms/page/" . $page;
        $postRow    = engine::api("GET", $url);
        $this->data["Page"] = $postRow;

      break;

      default:
      header('Location: /home');
    }

    $meta = array
    (
      'title' 		=> $this->data["title"],
      'subtitle' 	=> $page_title,
      'page' 		  => "",
      'seo' 			=> "",
    );
    $this->theme("default", "page", $page, $meta, $this->data);
  }


  public function action($args)
  {
    $action = $args[0];
    switch ($action)
    {
      case "search":

      ob_end_clean();

      $data = array
      (
        'name'        => $_POST['name'],
        'company'     => $_POST['company'],
        'type'        => $_POST['type'],
        'specializes' => implode(',', $_POST['specializes']),
      );

      $url    = 'contact/search';
      $signup = engine::api("POST", $url, $data);

      $order = "0";
      foreach ($signup["table"] as $auditor)
      {
        $order++;

        $specializes = "";

        if($auditor['specializes_economies'] == "1")
        {
          $specializes .= "- เชี่ยวชาญด้านเศรษฐนิเวศ</br>";
        }
        else
        {
          $specializes .= "";
        }

        if($auditor['specializes_environmental'] == "1")
        {
          $specializes .= "- เชี่ยวชาญด้านสิ่งแวดล้อม</br>";
        }
        else
        {
          $specializes .= "";
        }

        if($auditor['specializes_csr'] == "1")
        {
          $specializes .= "- เชี่ยวชาญด้านสังคม CSR หรือ CSV</br>";
        }
        else
        {
          $specializes .= "";
        }

        $table .= "
        <tr>
          <td class='align-middle' width='30%'>
            <div><strong>{$order} {$auditor['contact_firstname']} {$auditor['contact_lastname']}</strong></div><span>{$auditor['contact_phone']} <br>{$auditor['contact_email']}</span>
          </td>
          <td class='align-middle' width='30%'>
            <div>{$specializes}</span>
          </td>
          <td class='align-middle' width='20%'>
            <div>{$auditor['contact_unit']}</div>
          </td>
        </tr>
        ";
      }

      $status = $signup['status'];
      $return = $table;

      $trace = array
      (
        "status" => "true",
        "return" => $return,
      );

      echo json_encode($trace, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

      break;

    }
  }
}

?>
