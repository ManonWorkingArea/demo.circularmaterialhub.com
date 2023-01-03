<?php

class fw
  {

  public function __construct()
  {
    $this->run();
  }

  private function run()
  {
    if ($GLOBALS["folder"] == "")
    {
      $GLOBALS["href"] = "/";
    }
    else
    {
      $base_folder      = $GLOBALS["folder"];
      $GLOBALS["href"]  = "/{$base_folder}/";
    }

    $base   = $GLOBALS["folder"];
    $uri    = $_SERVER['REQUEST_URI'];

    if ($base != "")
    {
      $base_pos = strpos($uri, $base);
      if ($base_pos != false)
      {
        $base_len   = strlen($base);
        $uri_len    = strlen($uri);
        $uri        = substr($uri, $base_len + 1, $uri_len);
      }
    }

    $index_pos = strpos($uri, 'index.php');

    if ($index_pos !== false)
    {
      $uri = substr($uri, $index_pos + 9);
    }

    $g_pos = strpos($uri, '?');

    if ($g_pos !== FALSE)
    {
      $uri = substr($uri, 0, $g_pos);
    }

    if (strlen($uri) > 0)
    {
      if ($uri[0] == "/")
      {
        $uri = substr($uri, 1);
      }
    }

    if (strlen($uri) > 0)
    {
      $uri_len = strlen($uri);

      if ($uri[$uri_len - 1] == "/")
      {
        $uri = substr($uri, 0, $uri_len - 1);
      }
    }

    $arr_uri  = explode("/", $uri);
    $class    = $GLOBALS["controller"];
    $method   = 'index';
    $args     = array();

    $arr_uri_len = count($arr_uri);
    if ($arr_uri_len > 0)
    {
      if (strlen($arr_uri[0]) > 0)
      {
        $class = $arr_uri[0];
      }
    }

    if ($arr_uri_len > 1)
    {
      $method = $arr_uri[1];
    }

    if ($arr_uri_len > 2)
    {
      for ($i = 2; $i < $arr_uri_len; $i++)
      {
        $args[] = $arr_uri[$i];
      }
    }

    $server_name = "http://" . $_SERVER['SERVER_NAME'] . "/";

    if ($GLOBALS["folder"] != "")
    {
      $server_name .=$GLOBALS["folder"] . "/";
      $GLOBALS["url"] = $server_name;
    }
    else
    {
      $GLOBALS["url"] = $server_name;
    }

    fw_data::$class   = $class;
    fw_data::$method  = $method;

    if (file_exists("application/controllers/{$class}.php"))
    {
      require_once("application/controllers/{$class}.php");
      if (class_exists($class))
      {
        $con = new $class();
        if (method_exists($con, $method))
        {
          $con->{$method}($args);
        }
        else
        {
          include "theme/404.php";
        }
      }
      else
      {
        include "theme/404.php";
      }
    }
    else
    {
      include "theme/404.php";
    }
  }
}

class fw_data
{
  static $class;
  static $method;
}

class fw_controller
{

  public $m_core;
  public $m_student;
  public $data;

  public function initial()
	{
    $data = array();
    $this->m_core = new m_core();

		if(!isset($_SESSION["School"]) || !isset($GLOBALS["School"]))
		{
      // API
			$apiKey 		= $GLOBALS["API"]['key'];
			$secretKey 	= $GLOBALS["API"]['secret'];
			$url        = $GLOBALS["API"]['server'] . 'website/detail';

			// Header
			$header 	  = array();
			$header[] 	= 'Content-length: 0';
			$header[] 	= 'Content-type: application/json';
			$header[] 	= "API-KEY: {$apiKey}";
			$header[] 	= "SECRET-KEY: {$secretKey}";

			// Return
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HTTPGET, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			$response_json = curl_exec($ch);
			curl_close($ch);

			// Return
			$school = json_decode($response_json, true);
			if($school['status'] === false)
			{
				//header( 'Location: /404');
        $GLOBALS["School"] 	= $school;
				$_SESSION["School"]	= $school;
			}
			else
			{
				$GLOBALS["School"] 	= $school;
				$_SESSION["School"]	= $school;
			}
		}
  }

  public function model($name)
	{
    require_once("application/models/{$name}.php");
    $model = new $name();
    return $model;
  }

	public function theme($type ,$page, $file, $meta, $data)
	{
		ob_end_clean();

		$GLOBALS["subpage"] = $file;

		if($GLOBALS["School"]["status"] == 1)
		{
			//=========||  HEAD TITLE ||============//
			if(isset($meta['seo']))
			{
				$preparedstring = $meta['seo'];
				$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "https://";
				$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

				if($preparedstring!="" && $preparedstring!="|")
				{
					$multidimension_array=array();
					$parents = explode("|" , $preparedstring);

					// Create Array
					foreach ($parents as $parentvalue)
					{
						$multidimension_array[] = explode(",",$parentvalue);
					}
					// Create Item
					for($i=0;$i<count($multidimension_array[0]);$i++)
					{
						$keyword .=  $multidimension_array[0][$i] . ",";
					}
					$description = $parents[1];
				}

				if($keyword!="" || $parents[1]!="")
				{
					$GLOBALS["seo"]['keyword'] 	= $keyword;
					$GLOBALS["seo"]['description'] = $parents[1];
				}
				else
				{
					$GLOBALS["seo"]['keyword'] 	= $_SESSION["School"]['seo_keyword'];
					$GLOBALS["seo"]['description'] = $_SESSION["School"]['seo_description'];
				}

				$GLOBALS["share"]['url'] 	= $url;

				if($meta['share'] =="" || $meta['share'] == NULL)
				{
					$GLOBALS["share"]['img'] 	= $GLOBALS["School"]['social_img'];
				}
				else
				{
					$GLOBALS["share"]['img'] 	= $GLOBALS["School"]['cdn'] . "img.php?file=" . $meta['share'];
				}

				$GLOBALS["share"]['url'] = $url;
        $GLOBALS["meta"] = $meta;

				//print_r($GLOBALS["meta"]);
			}

			if(isset($meta['title']))
			{
				if($meta['subtitle']=="")
				{
					$GLOBALS["title"] 	= $meta['title'];
				}
				else
				{
					$GLOBALS["title"] 	= $meta['title'] . " / " . $meta['subtitle'];
				}

				$GLOBALS["pagetitle"] 		= $meta['title'];
				$GLOBALS["subtitle"] 			= $meta['subtitle'];
				$GLOBALS["currentpage"] 	= $meta['page'];

			}

			if(isset($page))
			{
				$GLOBALS["name"] = $page;
				$GLOBALS["page"] = $file;
				//----------------------------
				$GLOBALS["menu"]['main'] = $page;
				$GLOBALS["menu"]['sub'] = $file;
			}

      if(isset($meta['theme']))
      {
        if($meta['theme']=="custom")
				{
					$GLOBALS["theme"]  = "skin/" . $_SESSION["School"]['skin'];
          $GLOBALS["loader"] = $_SESSION["School"]['skin'];
				}
				else
				{
					$GLOBALS["theme"]  = "interface/" . $_SESSION["School"]['ui'];
          $GLOBALS["loader"] = "";
				}
      }
      else
      {
        $GLOBALS["theme"]  = "interface/" . $_SESSION["School"]['ui'];
        $GLOBALS["loader"] = "";
      }

			$GLOBALS["js"]   = "application/js/js_{$page}.php";
			$GLOBALS["css"]  = "application/css/css_{$page}.css";

			switch ($type)
			{
        case "default":
					ob_end_clean();
					include "theme/{$GLOBALS["theme"]}/view_header.php";

          if($GLOBALS["menu"]['main']=="home")
          {
            include "theme/{$GLOBALS["theme"]}/view_menu.php";
          }
          else
          {
            include "theme/{$GLOBALS["theme"]}/view_menu-inner.php";
          }
					include "application/views/{$page}/{$GLOBALS["loader"]}/v_{$file}.php";
					include "theme/{$GLOBALS["theme"]}/view_footer.php";

          echo "</body>
          </html>";
				break;

        case "app":
        
					ob_end_clean();
					include "theme/skin/app/view_header.php";
          include "theme/skin/app/view_menu.php";
					include "application/views/{$page}/v_{$file}.php";
					include "theme/skin/app/view_footer.php";
          echo "</body>
          </html>";

				break;

        case "player":
					ob_end_clean();
					include "theme/{$GLOBALS["theme"]}/view_header-player.php";
					include "application/views/{$page}/v_{$file}.php";
					include "theme/{$GLOBALS["theme"]}/view_footer-player.php";
				break;

        case "login":
					ob_end_clean();
					include "theme/{$GLOBALS["theme"]}/view_header-login.php";
					include "application/views/{$page}/v_{$file}.php";
					include "theme/{$GLOBALS["theme"]}/view_footer-login.php";
				break;

        case "blank":
					ob_end_clean();
					include "application/views/{$page}/v_{$file}.php";
				break;

			}
		}
	}
}

?>
