<?PHP
include_once('master.php');
header('Content-Type: application/json; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	// Compile Data	
	foreach ($_POST as $key => $value)
	{
		if (substr($key,0,8) != 'question')
		{
			if ($key == 'exam_no') $value;
			$schema .= '"'.$key.'": "'.$value.'",';
		}
		else
			$table .= '"'.$key.'": "'.$value.'",';
	}
	$schema = substr($schema,0,-1);
	$table = substr($table,0,-1);	
	$obj = '{"schema": {'.$schema.'}, "table":{'.$table.'}}';

	// Create File
	$filename = '../uploads/'.con_togglmt($_POST['exam_no']).'.json';	
	$fopen = fopen($filename,'w') or die('Unable to open file!');
	fwrite($fopen,$obj);
	fclose($fopen);

	//var_dump($_POST,$obj,$filename);
}

?>