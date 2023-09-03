// JavaScript Document
function $_start ()
{
	$_getCourseList();
	$_getMonthList();
	$_getYearList();
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
	var $query = $_formctrl();	
	$_post('php/attendance_print.php',$query,$_fetch);
}

function $_getCourseList() {$_stream('php/list_course.php',$_setCourseList);}
function $_setCourseList($buffer) {$_setter("course_id",$buffer);}

function $_getMonthList() {$_stream('php/list_month.php',$_setMonthList);}
function $_setMonthList($buffer) {$_setter("month",$buffer);}

function $_getYearList() {$_stream('php/list_year.php',$_setYearList);}
function $_setYearList($buffer) {$_setter("year",$buffer);}


