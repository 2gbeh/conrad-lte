<?PHP
header('Content-Type: application/json; charset=UTF-8');
include_once('../../config/@config.php');
include_once('../../lib/php/@php.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
//	$userid = 'niit/apex/jdoe';		
	$userid = $_POST['userid'];
	
	if ($userid == $MANIFEST->super || $userid == $MANIFEST->admin) {echo 1;}
	else if ($userid == $MANIFEST->demo) {echo 2;}
	else
	{
		$pattern = con_build($MANIFEST->pattern,'/');
		$regex = con_build($userid,'/');
		if 
		(
			count($pattern) != count($regex) || 
			strtolower($pattern[0]) != strtolower($regex[0])
		) {echo 3;}
		else
		{
			$exam_no = con_drop($regex,'/');
			$course_id = $regex[1];
			$user_id = $regex[2];		
			$files = con_stream($MANIFEST->root.'/data/json/',1);
			foreach ($files as $source)
			{
				if (strpos($source,$course_id))
				{
					$obj = '{
						"exam_no": "'.$exam_no.'",
						"course_id": "'.$course_id.'",
						"user_id": "'.$user_id.'",
						"source": "'.$source.'"
					}';
				}
			}
			if (!$obj) {echo 4;}
			else {echo $obj;}
#			var_dump($ini,$files);
		}
	}
}

?>