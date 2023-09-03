// JavaScript Document
function $_dummy ($obj) {return true;}
function $_console ($obj) {console.log($obj);}
function $_setter ($key, $value) {document.getElementById($key).innerHTML = $value;}
function $_getter ($key) {return document.getElementById($key).innerHTML;}
function $_turbo ($obj) 
{
	var $turbo = document.getElementById('turbo');
	if ($obj)
		$turbo.innerHTML += $obj;
	else
		alert($turbo)
}
function $_display ($key, $value) 
{
	document.getElementById($key).innerHTML = $value;
}
function $_style ($key, $value) 
{
	document.getElementById($key).style = $value;
}
function $_head ($obj)
{
	var $append = document.head.innerHTML;
	if ($obj)
		document.head.innerHTML = $obj + $append;
	else
		return document.head.innerHTML;
}
function $_goto ($url)
{
	if ($url[0] == "?") window.location.href += $url;
	else window.location.href = $url;	
}
