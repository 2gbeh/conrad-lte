// JavaScript Document
function $_setCookie ($key, $value)
{
	document.cookie = $key+"="+$value;
}
function $_getCookie ($key)
{
	var $each;	
	var c = document.cookie;
	var $array = c.split("; ");	
	for (var i = 0; i < $array.length; i++)
	{
		$each = $array[i].split("=");
		if ($each[0] == $key) return $each[1];
	}
}
function $_delCookie ($key)
{
	var $exp = "Mon, 14 Nov 2011 00:00:00 UTC";
	return document.cookie = $key+"=; expires="+$exp;
}
function $_clearCookie ()
{
	var $each;
	var c = document.cookie;
	var $array = c.split("; ");	
	for (var i = 0; i < $array.length; i++)
	{
		$each = $array[i].split("=");
		$_delCookie($each[0]);
	}
}




