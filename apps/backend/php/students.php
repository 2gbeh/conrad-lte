<?PHP
header('Content-Type: application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');
include_once('../../../web/php/Model.php');

#$_GET['ajax'] = true;
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
		$student_id = $obj->id;
		$MODEL->setId($student_id);
		
		$student_name_buf = strtoupper($MODEL->getName());
		$student_id_buf = '<b>('.$student_id.')</b>';
		$courseObject = $MODEL->getCourseObject();
		$course_title = $courseObject->title;
		$registerObject = $MODEL->getRegisterObject();
		$batch = $registerObject->batch;		
		
		$tbody = '<td>'.$sn.'</td>';
		$tbody .= '<td>'.$student_name_buf.' '.$student_id_buf.'</td>';
		$tbody .= '<td>'.$MODEL->getGender().'</td>';
		$tbody .= '<td>'.$MODEL->getPhone().'</td>';
		$tbody .= '<td>'.$course_title.'</td>';
		$tbody .= '<td>'.$batch.'</td>';
		$tbody .= '<td>'.$MODEL->getDate().'</td>';			
		$buffer .= '<tr>'.$tbody.'</tr>';
		$sn++;
	}
	echo '{"numrows": "'.count($resultSet).'", "buffer": "'.$buffer.'"}';
}

?>