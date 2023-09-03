// JavaScript Document
function $_start ()
{
	$_get('php/batch_list.php',"ajax=true",$_fetch);
}
function $_fetch ($obj)
{
	var $avg = $_getTime('msec');
	if (isNaN($obj))
	{		
		var $data = JSON.parse($obj);
		var $numrows = parseInt($data.numrows);
		var $extra = $data.extra;		
		var $caption;
		if ($numrows > 0)
		{
			$index = $numrows - 1;
			$caption = "Showing rows 0 - "+$index+" ";
			$caption += "(~"+$numrows+" total, query took 0.0"+$avg+" sec)";
			//$caption += ". "+$extra;
			$_display("target",$data.buffer);			
		}
		else
		{
			$caption = "MySQL returned an empty result set ";
			$caption += "(i.e. zero rows, query took 0.0"+$avg+" sec)";
			$_style("target","display:none;")	
		}
		$_display("caption",$caption); 
	}
}

