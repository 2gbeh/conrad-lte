// JavaScript Document
function $_digi ($int)
{
	return ($int < 10) ? "0"+$int : $int;
}
function $_trim ($str)
{
	$str = $str.trim();
	$str = $_whitespace($str);
	return $str;
}
function $_whitespace ($str)
{
	return $str.replace(/^\s+|\s+$/gm,'');
}
function $_exist ($needle, $haystack)
{
	if ($haystack.search($needle) != -1)
		return true;
	else
		return false;
}
function $_escape ($var)
{
	$var = $var.replace(/</g,"&lt;");
	$var = $var.replace(/>/g,"&gt;");
	return $var;
}
