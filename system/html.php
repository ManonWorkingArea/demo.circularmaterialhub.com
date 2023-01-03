<?php
class html
{
  private $dbo;
  private $table_container;

  function __construct()
  {
	  $this->dbo = new database($GLOBALS["dbhost"] , $GLOBALS["dbuser"] , $GLOBALS["dbpass"] , $GLOBALS["dbname"] );
    $this->table_container = new table_container();
  }

  public static function img($get, $condition="false",$var1="false")
	{
    echo "theme/{$GLOBALS["theme"]}/assets/{$get}?" . time();
  }

  public static function css($get, $condition="false",$var1="false")
	{
    echo "<link href=\"theme/{$GLOBALS["theme"]}/assets/{$var1}?" . time() .  "\" rel='stylesheet' type='text/css'/>";
  }

  public static function js($get, $condition="false",$var1="false")
	{
    echo "<script type=\"text/javascript\" src=\"theme/{$GLOBALS["theme"]}/assets/{$var1}?" . time() .  "\"></script>";
  }

  public static function body($get, $condition="false",$var1="false")
	{

  }
  public static function title($get, $condition="false",$var1="false")
	{
    if(isset($GLOBALS['title']))
    {
      echo "<meta charset='utf-8'><base href='" . $GLOBALS["href"] . "'><title>" . $GLOBALS["Setting"]["sc_title"] . " / " . $GLOBALS['title'] . "</title>";
    }
    else
    {
      echo "<meta charset='utf-8'><base href='" . $GLOBALS["href"] . "'><title>" . $this->data["Setting"]["sc_title"] . "</title>";
    }
  }

  public static function activenav($get, $condition="false",$var1="false")
	{
    if(isset($GLOBALS["menu"]['main']))
    {
      //Main Menu
      echo "<script>$('.{$GLOBALS["menu"]['main']}-menu').addClass('menu-open'); $('.{$GLOBALS["menu"]['main']}-menu-{$GLOBALS["menu"]['sub']}{$GLOBALS["menu"]['sub2']}').addClass('top-menu--active menu--active');</script>";
      //Sub Menu
      if($GLOBALS["menu"]['sub2'] != "")
      {
        echo "<script>$('.{$GLOBALS["menu"]['main']}-menu-{$GLOBALS["menu"]['sub2']}').addClass('menu-open');</script>";
      }
      else
      {
        echo "";
      }
    }
    else
    {
      //Main Menu
      echo "<script>$('.{$GLOBALS["menu"]['main']}-menu').addClass('active'); $('.{$GLOBALS["menu"]['main']}-menu-{$GLOBALS["menu"]['sub']}').addClass('active');</script>";
      //Sub Menu
      if($GLOBALS["menu"]['sub2'] != "")
      {
        echo "<script>$('.{$GLOBALS["menu"]['main']}-menu-{$GLOBALS["menu"]['sub2']}').addClass('active');</script>";
      }
      else
      {
        echo "";
      }
    }
  }

  public static function iehack($get, $condition="false",$var1="false")
	{
    echo '<!-- CSS for IE --><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --><!--[if lt IE 9]><script type="text/javascript" src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script><![endif]-->';
  }
}

?>
