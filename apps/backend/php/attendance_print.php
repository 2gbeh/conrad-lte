<?PHP
header('Content-Type: application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');
include_once('../../../web/php/Model.php');

//$_POST = array('course_id'=>1,'month'=>11,'year'=>2019);
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$_POST = con_validate($_POST);
	if (con_required($_POST,'course_id,month,year'))
	{	
		$table = 'attendance';
		$sql = 'SELECT * FROM '.$table.' WHERE course_id="'.$_POST['course_id'].'"';
		$sql .= ' AND MONTH(date)="'.$_POST['month'].'"';
		$sql .= ' AND YEAR(date)="'.$_POST['year'].'" ORDER BY id';
		$resultSet = $BEAN->Execute($sql);
		
		$group = array(); $sn = 1;
		foreach ($resultSet as $obj)
		{
			$MODEL->setId($obj->student_id);
			$JDate = _transJDate($obj->date);
			if (!in_array($JDate,$group))
			{
				$sn = 1;
				$buffer .= "<tr style='border-top:solid 5px #E6E6FA;'>";
				$group[] = $JDate;
			}
			else
			{
				$buffer .= '<tr>';				
			}
						
			$buffer .= '<td>'.$sn.'</td>';
			$buffer .= '<td>'.$JDate.'</td>';
			$buffer .= '<td>'.$MODEL->getName().'</td>';
			$buffer .= '<td>'.$MODEL->getGender().'</td>';
			$buffer .= '<td>'.$MODEL->getPhone().'</td>';
			$buffer .= '<td>'._transTimePlus($obj->date,1).'</td>';
			$buffer .= '<td>'._transTimePlus($obj->date,3).'</td>';
			$buffer .= '<td>&nbsp;</td>';
			$buffer .= '</tr>';
			$sn++;
		}
		echo '{"numrows": "'.count($resultSet).'", "buffer": "'.$buffer.'"}';
	}
	else 
	{
		$errno = 404; $error = 'ERROR: Required fields are empty.';
		echo '{"errno": "'.$errno.'", "error": "'.$error.'"}';
	}
}
//var_dump($resultSet);

?>