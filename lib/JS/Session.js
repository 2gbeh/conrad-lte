// JavaScript Document
function $_setSession ($obj)
{
	for (var $key in $obj)
	{
		if (typeof(Storage) !== "undefined")
			sessionStorage.setItem($key,$obj[$key]);
		else
			$_setCookie($key,$obj[$key]);
	}
}
function $_getSession ($key)
{
	if (typeof(Storage) !== "undefined")
		return sessionStorage.getItem($key);	
	else
		return $_getCookie($key);
}
function $_delSession ($key)
{
	if (typeof(Storage) !== "undefined")	
		return sessionStorage.removeItem($key);	
	else
		return $_delCookie($key);
}
function $_clearSession ()
{
	return sessionStorage.clear();
}



