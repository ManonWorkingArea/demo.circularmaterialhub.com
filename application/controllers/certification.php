<?php
class certification extends fw_controller
{
    public $m_core;

    public function __construct()
    {
        $this->m_core = new m_core();
        $this->initial();
        //--------------------------------------------
        $this->data["title"] = "ผู้เรียน";
        //--------------------------------------------
    }

    public function index()
    {
      $meta = array(
          'title' => $this->data["title"],
          'subtitle' => "ภาพรวม",
          'page' => "",
          'seo' => "",
      );
      $this->theme("blank", "certified", "index", $meta, $this->data);
    }

    public function show($args)
    {
      $token = $args[0];

      $data = array
      (
        'token'  => $token,
      );

  		$this->data["Certification"] = engine::api("POST", 'certification/show/', $data);

      //*********************************************

      $meta = array
      (
        'title'     => $this->data["title"],
        'subtitle'  => "ใบรับรอง - " . $token,
        'page'      => "",
        'seo'       => "",
      );

      $this->theme("blank", "certified", "display", $meta, $this->data);
    }

    public function verify($args)
    {
        $meta = array(
            'title' => $this->data["title"],
            'subtitle' => "ภาพรวม",
            'page' => "",
            'seo' => "",
        );
        $this->theme("blank", "certified", "display", $meta, $this->data);
    }

    public function approve($args)
    {
      $meta = array
      (
        'title'     => $this->data["title"],
        'subtitle'  => "ภาพรวม",
        'page'      => "",
        'seo'       => "",
      );

      $this->theme("blank", "certified", "approve", $meta, $this->data);
    }

    public function learning($args)
    {
      $meta = array
      (
        'title'     => $this->data["title"],
        'subtitle'  => "ภาพรวม",
        'page'      => "",
        'seo'       => "",
      );

      $this->theme("blank", "certified", "display", $meta, $this->data);
    }
}
?>
