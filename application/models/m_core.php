<?php

class table_container
{
    public $table	=	array();
    public $numRow; 
}

class m_core
{
    private $dbo;
    private $table_container;

    function __construct()
	{
        $this->table_container = new table_container();
    }

	function getData($table,$cond,$post,$data) 
	{
		$sql ="SELECT {$data} FROM {$table} WHERE {$cond}='{$post}'";

		$results = $this->dbo->sql_query($sql);
		$result = $results->fetch_array();
		$DB = $result["{$data}"];
		return $DB;
   }
   
   function checkMember_email($data)
	{
		$numrow = $this->dbo->numRow("member", "mem_email", $data);

		if ($numrow > 0)
		{
            return "0";
        }
        else
        {
	        return "1";
        }

	}
	
	function checkMember_phone($data)
	{
		$numrow = $this->dbo->numRow("member", "mem_phone", $data);

		if ($numrow > 0)
		{
            return "0";
        }
        else
        {
	        return "1";
        }

	}

	function checkMember_username($data)
	{
		$numrow = $this->dbo->numRow("member", "mem_username", $data);

		if ($numrow > 0)
		{
            return "0";
        }
        else
        {
	        return "1";
        }
	}
	
	function checkMember_changepasswd($data)
	{
		$numrow = $this->dbo->numRow("member_resetpassword", "mrw_member", $data);

		if ($numrow > 0)
		{
            return "0";
        }
        else
        {
	        return "1";
        }

	}

	function checkMember_validemail($data)
	{
    	return filter_var($data, FILTER_VALIDATE_EMAIL)
        && preg_match('/@.+\./', $data);
	}
	
	function checkMember_code($data)
	{
		$numrow = $this->dbo->numRow("member", "mem_code", $data);

		if ($numrow > 0)
		{
            return "0";
        }
        else
        {
	        return "1";
        }
	}
	
	function checknumber($input)
	{
		if(is_numeric($input))
		{ 
			return "1";
		}
		else
		{
			return "0";
		}
	}
	
	function checknumberLimit($input,$limit)
	{
		
		if (strlen($input)<$limit) 
		{
		  return "0";
		}
		else if (strlen($input)>$limit) 
		{	
		  return "0";
		}
		else  if (strlen($input)==$limit) 
		{
		  return "1";
		}
	}
   
}

?>