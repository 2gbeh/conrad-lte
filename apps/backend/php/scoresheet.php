<?PHP
header('Content-Type: application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');

if (isset($_GET['ajax']) == true)
{
	$files = con_stream($MANIFEST->root.'/web/uploads/');
	if (!$files) {echo '{"numrows": "0", "buffer": ""}';}
	else
	{
		foreach ($files as $key => $source)
		{
			$filename = $source;
			$fopen = fopen($filename,'r') or die('Unable to open file!');
			$obj = fread($fopen,filesize($filename));
			fclose($fopen);
			
			$json = json_decode($obj);
			$username = __getName($json->schema->user_id);
			
			$row[$key][] = $key + 1;
			$row[$key][] = _transDate($json->schema->{'date'});
			$row[$key][] = strtoupper($json->schema->course_id);
			$row[$key][] = strtoupper($username);
			$row[$key][] = $json->schema->time_in;
			$row[$key][] = $json->schema->time_out;
			$row[$key][] = __getEffort($json->table);
			$row[$key][] = __getScore($json);
		}
		$buffer = '';
		foreach ($row as $assoc_array)
		{
			$tbody = '';
			foreach ($assoc_array as $cell)
				$tbody .= '<td>'.$cell.'</td>';
			$buffer .= '<tr>'.$tbody.'</tr>';
		}
		{echo '{"numrows": "'.count($row).'", "buffer": "'.$buffer.'"}';}
//		var_dump($ini,$files,$row);
	}
}
function __getName ($var) 
{
	$fname = strtoupper($var[0]);
	$lname = ucwords(substr($var,1));
	return $fname.'. '.$lname;
}
function __getEffort ($var) 
{
	$total = count((array)$var);	
	$attempt = 0;
	foreach ($var as $ans)
		if ($ans != 'option0') $attempt += 1;
	$effort = ($attempt * 100) / $total;
	return $effort.'%';
}
function __getScore ($var) 
{
	foreach ($var->table as $ans)
		$ansArray[] = $ans;	
	$total = count($ansArray);
	
	$src = __getSource($var->schema->course_id);
	foreach ($src->table as $assoc)
		$okArray[] = $assoc->answer;
	
	$score = 0;	
	for ($i = 0; $i < $total; $i++) 
	{
		if ($ansArray[$i] == $okArray[$i])
			$score += 1;
	}
	return '<b>'.$score.'</b> / '.$total;
}
function __getSource ($var)
{
	$root = $GLOBALS['MANIFEST']->root;
	$folder = con_stream($root.'/data/json/',1);	
	foreach ($folder as $file)
	{
		if (con_exist($var,$file))
			$source = $file;
	}
	$filename = '../../../data/json/'.$source;
	$fopen = fopen($filename,'r') or die('Unable to open file! '.$filename);
	$obj = fread($fopen,filesize($filename));
	fclose($fopen);
	return json_decode($obj);
}

?>