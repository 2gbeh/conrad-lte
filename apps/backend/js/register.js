// JavaScript Document
function $_this_submit()
{
	var $query = $_formctrl();
	$_post('php/register.php',$query,$_fetch);
}
function $_fetch ($obj)
{
	var $data = JSON.parse($obj);
	var $errno = parseInt($data.errno);
	var $error = $data.error;
	if ($errno == 200) $_emptyForm();
	alert($error);
}
function $_getCourseList() {$_stream('php/list_course.php',$_setCourseList);}
function $_setCourseList($buffer) {$_setter("course_id",$buffer);}

function $_getBatchList() {$_stream('php/list_batch.php',$_setBatchList);}
function $_setBatchList($buffer) {$_setter("batch",$buffer);}