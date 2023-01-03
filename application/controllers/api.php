<?php
class api extends fw_controller
{
    public $m_core;

    public function __construct()
    {
        $this->m_core = new m_core();
        $this->initial();
        //--------------------------------------------
        $this->data["title"] = "สถาบันพันธมิตร";
        //--------------------------------------------
    }

    public function index()
    {

    }

    public function render($args)
    {
      $institution = $args[0];
      $callback    = $_GET;

      $this->data["callback"]	               = $callback;
      $this->data["callback"]['institution'] = $institution;

      $url    = 'qrcode/' . $callback['callback'];
  		$lesson = engine::api("GET", 'qrcode/' . $callback['callback']);
  		$this->data["Lesson"] = $lesson;

      if(strpos($_SERVER['HTTP_USER_AGENT'], 'LIFF') !== false)
      {
        $this->theme("external", "api", "display", $meta, $this->data);
      }
      else
      {
        //header( 'Location: /home');
        $this->theme("external", "api", "display", $meta, $this->data);
      }
    }
}
?>
