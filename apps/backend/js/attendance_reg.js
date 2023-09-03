// JavaScript Document
function $_start ()
{
	$_get('php/attendance_reg.php',"ajax=true",$_fetch);
}
function $_fetch ($obj)
{
	var $avg = $_getTime('msec');
	if (isNaN($obj))
	{
		var $data = JSON.parse($obj);
		var $numrows = parseInt($data.numrows);
		var $caption;
		if ($numrows > 0)
		{
			$index = $numrows - 1;
			$caption = "Showing rows 0 - "+$index+" ";
			$caption += "(~"+$numrows+" total, query took 0.0"+$avg+" sec)";
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

function $_this_submit ()
{
	var $query = $_itemctrl();
	$_post('php/attendance_reg.php',$query,$_this_confirm);
}
function $_this_confirm ($obj)
{
	var $data = JSON.parse($obj);
	var $errno = parseInt($data.errno);
	var $error = $data.error;
	alert($error);	
	if ($errno == 200) window.location.reload();
}

function $_this_datetime ($attrib)
{
	if (!$attrib) var $attrib = 'date';
	var $target = document.getElementById($attrib);
	$target.value = $_getDate()+" "+$_getTime('hr')+":00:00";
}