<?PHP
header('Content-Type: application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');

if (isset($_GET['ajax']) == true)
{
	$table = 'staff';
	$sql = 'SELECT * FROM '.$table.' ORDER BY id';
	$resultSet = $BEAN->Execute($sql);
	
#	var_dump($resultSet);
	$sn = 1;
	$buffer = '';
	foreach ($resultSet as $obj)
	{
		$status = $obj->status == 0? 'Employed':'Terminated';
		$color = $obj->status == 0? '':'#EE1111';
		
		$tbody = '<td>'.$sn.'</td>';
		$tbody .= '<td>'.strtoupper($obj->name).'</td>';
		$tbody .= '<td>'._transGender($obj->gender).'</td>';
		$tbody .= '<td>'.$obj->phone.'</td>';
		$tbody .= "<td style='color:".$color.";'>".$status."</td>";
		$tbody .= '<td>'._transDate($obj->{'date'}).'</td>';			
		$buffer .= '<tr>'.$tbody.'</tr>';
		$sn++;
	}
	echo '{"numrows": "'.count($resultSet).'", "buffer": "'.$buffer.'"}';
}



?>