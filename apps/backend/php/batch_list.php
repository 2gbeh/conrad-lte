<?PHP
header('Content-Type:application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');
include_once('../../../web/php/Model.php');

//$_GET['ajax'] = true;
if (isset($_GET['ajax']) == true)
{
	$table = 'register';
	$sql = 'SELECT DISTINCT course_id FROM '.$table.' ORDER BY id ASC';	
	$resultSet = $BEAN->Execute($sql);
	
	$limit = 0;	
	$buffer = '';
	foreach ($resultSet as $obj)
	{
		$sql = 'SELECT DISTINCT batch FROM '.$table.' WHERE course_id="'.$obj->course_id.'" ORDER BY batch ASC';	
		$batch_list = $BEAN->Execute($sql);	

		foreach ($batch_list as $each)
		{
			$sql = 'SELECT * FROM '.$table.' WHERE course_id="'.$obj->course_id.'" AND batch="'.$each->batch.'" ORDER BY id ASC';
			$resultSet_2 = $BEAN->Execute($sql);
			
			$thead_course = _transCourse($obj->course_id);
			$thead_batch = $resultSet_2[0]->batch;
			
			$thead = "<tr class='section'><td colspan='5'>".strtoupper($thead_course)." | BATCH: ".$thead_batch." | TOTAL: ".count($resultSet_2)."</td></tr>";
			$thead .= '<tr><th>S/N</th><th>Full Name</th><th>Gender</th><th>Phone Number</th><th>Registration Date</th></tr>';
			
			$sn = 1;
			$tbody = '';
			foreach ($resultSet_2 as $obj_2)
			{			
				$MODEL->setId($obj_2->student_id);
				$td = '<td>'.$sn.'</td>';
				$td .= '<td>'.strtoupper($MODEL->getName()).'</td>';
				$td .= '<td>'.$MODEL->getGender().'</td>';
				$td .= '<td>'.$MODEL->getPhone().'</td>';
				$td .= '<td>'.$MODEL->getDate().'</td>';
				$tbody .= '<tr>'.$td.'</tr>';
				$sn++;
				$limit++;
			}			
			$buffer .= $thead.$tbody;
		}
	}
	echo '{"numrows": "'.$limit.'", "buffer": "'.$buffer.'", "extra": "'.count($resultSet).' IN TOTAL"}';
}

?>


