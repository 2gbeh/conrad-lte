<?PHP
function con_exist ($needle, $haystack)
{
	if (strpos($haystack,$needle)) return true;
	else return false;
}
function con_replace ($from, $to, $in)
{
	return str_replace($from,$to,$in);
}
function con_build ($str, $delmt = ",")
{
	return explode($delmt,$str);
}
function con_drop ($array, $delmt = "")
{
	return implode($delmt,$array);
}
function con_indexof ($array, $key = "end")
{
	if ($key == "cur")
		return current($array);
	else if ($key == "end")
		return end($array);
	else
	{
		if (array_key_exists($key,$array))
			return $array[$key];		
	}
}
function con_stream ($dir, $rtype = "*")
{
	$tmp = $_SERVER['DOCUMENT_ROOT'].'/'.$dir;
	$GLOB = glob($tmp.'*');
	if ($rtype == 1)
		return con_subtream($GLOB);
	else
		return $GLOB;
}
function con_subtream ($var, $key = "end")
{
	$delmt = "/";
	if (!is_array($var))
	{
		if ($key == "cur")
			return array_shift(explode($delmt,$var));
		else if ($key == "end")
			return array_pop(explode($delmt,$var));
	}
	else
	{
		foreach ($var as $i => $each)
			$var[$i] = con_subtream($each);
		return $var;
	}
}
function con_togglmt ($var)
{
	if (con_exist("-",$var))
		return con_replace("-","/",$var);
	else if (con_exist("/",$var))
		return con_replace("/","-",$var);
	else
		return $var;
}

?>