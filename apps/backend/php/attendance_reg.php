<?PHP
header('Content-Type: application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');
include_once('../../../web/php/Model.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if (isset($_POST['checkbox']) && strlen($_POST['date']) == 19)
	{	
		$table = 'attendance'; 
		$total = count($_POST['checkbox']);
		$sql = '';
		$buffer = ''; 
		foreach ($_POST['checkbox'] as $id)
		{
			$MODEL->setId($id);
			$value_1 = $MODEL->getRegisterObject()->course_id;
			$value_2 = $id;
//			$value_3 = $_POST['date'];			
			$strtotime = strtotime($_POST['date'].' -1 hour');
			$value_3 = date('Y-m-d H:i:s',$strtotime);
			
			$buffer = 'INSERT INTO '.$table.' (course_id,student_id,date) VALUES ("'.$value_1.'","'.$value_2.'","'.$value_3.'");';
			$sql .= $buffer;
		}
		
		$result = $BEAN->Execute($sql,true);
		if ($result > 0) 
		{
			$errno = 200; 
			$error = 'Attendance record successful. Total of '.$total.' rows inserted.';
		}
		else 
		{
			$errno = 404; 
			$error = 'Attendance record failed.';
		}
	}
	else 
	{
		$errno = 404; 
		$error = 'ERROR: Required fields are empty.';
	}
	echo '{"errno": "'.$errno.'", "error": "'.$error.'"}';
}


if (isset($_GET['ajax']) == true)
{
	$table = 'students';
	$sql = 'SELECT * FROM '.$table.' ORDER BY id DESC';
	$resultSet = $BEAN->Execute($sql);
	
#	var_dump($resultSet);
	$sn = 1;
	$buffer = '';
	foreach ($resultSet as $obj)
	{
		$MODEL->setId($obj->id);
		$courseObject = $MODEL->getCourseObject();
		$course_title = $courseObject->title;
		$registerObject = $MODEL->getRegisterObject();
		$batch = $registerObject->batch;	
				
		$checkbox = "<input type='checkbox' name='checkbox[]' value='".$obj->id."' onclick=_focusThis(this,'target','".($sn-1)."') data-ajax />";
		
		$tbody = '<td>'.$checkbox.' '.$sn.'</td>';
		$tbody .= '<td>'.strtoupper($MODEL->getName()).'</td>';
		$tbody .= '<td>'.$MODEL->getGender().'</td>';
		$tbody .= '<td>'.$course_title.'</td>';
		$tbody .= '<td>'.$batch.'</td>';
		$tbody .= '<td>'.$MODEL->getDate().'</td>';			
		$buffer .= '<tr>'.$tbody.'</tr>';
		$sn++;
	}
	echo '{"numrows": "'.count($resultSet).'", "buffer": "'.$buffer.'"}';
}


?>