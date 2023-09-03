// JavaScript Document
function $_setAppstate ($key, $value)
{
	if (!$key) $key = "appstate"
	if (!$value) $value = "true";
	sessionStorage.setItem($key,$value);
}
function $_checkAppstate ($goto, $key, $value)
{
	if (!$key) $key = "appstate"
	if (!$value) $value = "true";
	if (sessionStorage.getItem($key) != $value) 
		$_goto($goto);
}
