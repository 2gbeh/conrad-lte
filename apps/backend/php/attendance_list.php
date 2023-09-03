<?PHP
header('Content-Type:application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');
include_once('../../../web/php/Model.php');

#$_GET['ajax'] = true;
if (isset($_GET['ajax']) == true)
{
	$table = 'attendance';
	$sql = 'SELECT DISTINCT date FROM '.$table.' ORDER BY id DESC';
	$resultSet = $BEAN->Execute($sql);
	
	$limit = 0;	
	$buffer = '';
	foreach ($resultSet as $obj)
	{
		if ($limit <= 125)  // 5 PAGES, 25 PER PAGE
		{
			$sql = 'SELECT * FROM '.$table.' WHERE date="'.$obj->date.'" ORDER BY id DESC';
			$resultSet_2 = $BEAN->Execute($sql);

			$thead_date = $obj->date;
			$thead_course = _transCourse($resultSet_2[0]->course_id);
			$thead_total = count($resultSet_2);
			
			$thead = "<tr class='section'><td colspan='4'>".
					strtoupper($thead_course)." (".$thead_total.") | ".
					"DATE: "._transDate($thead_date)." | ".
					"TIME: "._transTimePlus($thead_date).	
				"</td></tr>";
			$thead .= '<tr><th>S/N</th><th>Full Name</th><th>Gender</th><th>Phone Number</th></tr>';
			
			$sn = 1;
			$tbody = '';
			foreach ($resultSet_2 as $obj_2)
			{			
				$MODEL->setId($obj_2->student_id);
				$td = '<td>'.$sn.'</td>';
				$td .= '<td>'.strtoupper($MODEL->getName()).'</td>';
				$td .= '<td>'.$MODEL->getGender().'</td>';
				$td .= '<td>'.$MODEL->getPhone().'</td>';
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


