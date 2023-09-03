<?PHP
function con_validate ($post)
{
	foreach ($post as $name => $value)
	{
		if (substr($name,0,7) != 'submit-')
		{
			$value = trim($value);
			$value = stripslashes($value);
			$value = htmlspecialchars($value);
			$array[$name] = $value;
		}		
	}
	return $array;
}

function con_required ($array, $key_csv)
{
	$key_arr = explode(',',$key_csv);
	$counter = 0;
	foreach ($key_arr as $key)
	{
		if (strlen($array[$key]) > 0)
			$counter++;
	}
	if (count($key_arr) == $counter)
		return true;
}
?>