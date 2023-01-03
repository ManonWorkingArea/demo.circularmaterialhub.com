<?php

class home extends fw_controller
{
    public $m_core;

    public function __construct()
    {
      // Mcore
      $this->m_core = new m_core();

      // INI
      $this->initial();
      engine::ini();
      $this->data["title"] = "หน้าหลัก";
    }

    public function index()
    {
      // Title
      $mtitle   = $this->data["title"];
      $subtitle = "ยินดีต้อนรับ";

      $contentRow         = engine::api("GET", "cms/home");
      $this->data["Post"] = $contentRow['post'];

      // Meta
      $meta = array(
        'title'     => $this->data["title"],
        'subtitle'  => "ยินดีต้อนรับ",
        'theme'     => "custom",
        'page'      => "",
        'seo'       => "",
      );

      $this->theme("default", "home", "index", $meta, $this->data);
    }

    public function view($args)
    {
      if (!isset($args[0]))
      {
        $page = "";
      }
      else
      {
        $page = $args[0];
      }

      switch ($page)
      {
        case "page":
        break;

        default:
        header('Location: /home');
      }
    }

    public function action($args)
    {
      $action     = $args[0];
      $apiKey     = $GLOBALS["LEARNING"]['key'];
      $secretKey  = $GLOBALS["LEARNING"]['secret'];

      switch ($action)
      {
        case "get-lesson":

          $url      = $GLOBALS["LEARNING"]['server'] . 'lesson';
          $header   = array();
          $header[] = 'Content-length: 0';
          $header[] = 'Content-type: application/json';
          $header[] = "api-key: {$apiKey}";
          $header[] = "secret-key: {$secretKey}";

          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
          $response_json = curl_exec($ch);
          curl_close($ch);

          $trace = json_decode($response_json, true);
          echo json_encode($trace, JSON_UNESCAPED_UNICODE);

        break;
      }
    }
}
?>
