// JavaScript Document
var $EXAM_NO = $_getSession("exam_no");
var $COURSE_ID = $_getSession("course_id");
var $USER_ID = $_getSession("user_id");
var $TIME_IN = $_getSession("time_in");
var $SOURCE  = "../../data/json/"+$_getSession("source");
var $DATE = $_getDate();

function $_start ()
{
	$_stream($SOURCE,$_fetch);
}
function $_fetch ($obj)
{
	var $data = JSON.parse($obj);
	var $schema = $data.schema;
	var $table = $data.table;
	// Start Timer
	$_timein($schema.time);		
	// Display Meta
	$_display("examno",$EXAM_NO.toUpperCase());
	$_display("course",$schema.course);
	$_display("total",$schema.total+" Question(s)");
	$_display("time",$schema.time+" Mins");	
	$_display("date",$_setDate($schema.date));
	// Display Exam
	$_setExam($table);
}
function $_timein ($start)
{	
	var $save, $output, $speed;
	var $target = document.getElementById('countdown');
	var $btn = document.getElementById('submitBtn');
	var $now = $target.getAttribute("data-countdown");
	
	if (!$now)
		$save = parseInt($start);
	else
		$save = parseInt($now) - 1;

	if ($save < 1) $_timeout();
	else
	{
		$output = $save;
		if ($output < 10) $output = "0"+$output;
		if ($save <= 3) $btn.style.backgroundColor = "#EE1111";	
		$btn.setAttribute("title",$save+" Minute(s) Left");	
		$target.setAttribute("data-countdown",$save);
		$target.innerHTML = $output;
		if ($USER_ID == "jdoe")	$speed = 10000;
		else $speed = 60000;
		setTimeout($_timein,$speed);	
	}
}
function $_timeout ()
{
	alert("Time up!");	
	$_commit();
	$_end();
}
function $_submit ()
{
	var $confirm  = confirm("Submit Exam Paper?");
	if ($confirm == true)
	{
		$_commit();		
		$_end();
	}
}
function $_commit ()
{
	var $query = "exam_no="+$EXAM_NO+
	"&course_id="+$COURSE_ID+
	"&user_id="+$USER_ID+
	"&time_in="+$TIME_IN+
	"&time_out="+$_getTime('full')+		
	"&date="+$DATE+
	"&"+$_itemctrl();
	$_post('../../web/php/exam.php',$query,$_dummy);
}
function $_end ()
{
	$_clearSession();
	alert("Submitted!");	
	$_goto("../../index.html");		
}
function $_setExam ($obj)
{
	var $questionArray = $_getQuestion($obj);
	var $optionArray = $_getOption($obj);
	$buffer = "";
	for (var i = 0; i < $obj.length; i++)
	{
		$buffer += "<li>"+
			$questionArray[i]+
			"<ol class='option'>"+
				$optionArray[i]+
			"</ol>"+
		"</li>";
	}
	document.getElementById('target').innerHTML = "<ul class='cbt'>"+$buffer+"</ul>";
}
function $_getQuestion ($obj)
{
	var $array = [], $sn, $question;
	for (var i = 0; i < $obj.length; i++)
	{
		$sn = i + 1;
		$question  = $_escape($obj[i].question);
		$array[i] = "<label>Q" +$sn+". "+$question+ "</label>";
	}
	return $array;
}
function $_getOption ($obj)
{
	var $buffer, q, o, $array = [];
	var $optionArray = ["option1","option2","option3","option4","option5","option6"];	
	var $alphaArray = ["(A)","(B)","(C)","(D)","(E)","(F)"];
	q = 1;
	for (var x = 0; x < $obj.length; x++)
	{
		$buffer = "<li><input type='radio' name='question"+q+"' value='option0' class='none' data-ajax checked /></li>";
		var o = 0;		
		for (var y in $obj[x])
		{
			if ($_exist("option",y))
			{
				$option = $_escape($obj[x][y]);
				$buffer += "<li>";
				$buffer += "<input type='radio' name='question"+q+"' value='"+$optionArray[o]+"' data-ajax /> ";
				$buffer += $alphaArray[o]+" "+$option;
				$buffer += "</li>";
				o++;
			}
		}
		$array[x] = $buffer;
		q++;		
	}
	return $array;
}