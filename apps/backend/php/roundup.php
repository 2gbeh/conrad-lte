<?PHP
header('Content-Type: application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');
include_once('../../../web/php/Model.php');

//$_GET['ajax'] = true;
if (isset($_GET['ajax']) == true)
{
	$table = 'students';
	$sql = 'SELECT * FROM '.$table.' ORDER BY id ASC';
	$resultSet = $BEAN->Execute($sql);
	
#	var_dump($resultSet);
	$sn = 1;
	$buffer = '';
	$end_date_arr = array();
	foreach ($resultSet as $obj)
	{
		$student_id = $obj->id;
		$MODEL->setId($student_id);
		
		$student_name_buf = strtoupper($MODEL->getName());
		$courseObject = $MODEL->getCourseObject();
		$course_title = $courseObject->title;
		$registerObject = $MODEL->getRegisterObject();
		$batch = $registerObject->batch;		
		$duration = $courseObject->duration;
		$reg_date = $MODEL->getDate();
		$end_date = _transMonthPlus($reg_date,$duration);

		$micro = strtotime($end_date); // Sun, Mar 3, 2019
		$caption = date('F Y',$micro); // March 2019

		if (!in_array($caption,$end_date_arr))
		{
			$i = $sn - 1; // save counter
			$sn = 1; // restart counter
		}

		$tbody = '<tr>';
			$tbody .= '<td>'.$sn.'</td>';
			$tbody .= '<td>'.$student_name_buf.'</td>';
			$tbody .= '<td>'.$MODEL->getGender().'</td>';
			$tbody .= '<td>'.$MODEL->getPhone().'</td>';
			$tbody .= '<td>'.$course_title.'</td>';
			$tbody .= '<td>'.$batch.'</td>';
			$tbody .= '<td>'.$MODEL->getDate().'</td>';		
			$tbody .= '<td>'.$end_date.'</td>';
		$tbody .= '</tr>';

		if (!in_array($caption,$end_date_arr))
		{
			array_push($end_date_arr,$caption);	
			$section = "<tr class='section'><td colspan='8'>".strtoupper($caption)." | TOTAL (".$i.")</td></tr>";
			$buffer .= $section;
		}
		
		$buffer .= $tbody;		
		$sn++;
	}
	echo '{"numrows": "'.count($resultSet).'", "buffer": "'.$buffer.'"}';
}

?>