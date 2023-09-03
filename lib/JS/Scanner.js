// JavaScript Document
function $_keycode ($event, $code, $callback)
{
	var $key = $event.which || $event.keyCode;
	if ($key == $code) $callback();
	else return false;
}
function $_emptyForm ($attrib)
{
	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	for (var i = 0; i < $formControl.length; i++)
		document.querySelectorAll($attrib)[i].value = '';
}
function $_autofill ($attrib)
{
	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	for (var i = 0; i < $formControl.length; i++)
		$formControl[i].value = 'autofill@placeholder.com';
}
function $_checkAll ($this, $attrib)
{
	var $status = $this.checked, $set;	
	$set = $status == true ? true : false;

	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	for (var i = 0; i < $formControl.length; i++)
		$formControl[i].checked = $set;
}
function $_focusAll ($this, $target) 
{
	var $table = document.getElementById($target);
	var $tr = $table.getElementsByTagName('tr');
	if ($this.checked == true) 
	{
		for (var i = 0; i < $tr.length; i++)
			$tr[i].setAttribute('class','focus');
	}
	else
	{
		for (var i = 0; i < $tr.length; i++)
			$tr[i].removeAttribute('class');
	}
}
function $_focusThis ($this, $target, $n) 
{
	var $table = document.getElementById($target);
	var $tr = $table.getElementsByTagName('tr')[$n];
	if ($this.checked == true) $tr.setAttribute('class','focus');
	else $tr.removeAttribute('class');
}
function $_formctrl ($attrib)
{
	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	var $each, $name, $value, $buffer = "";
	for (var i = 0; i < $formControl.length; i++)
	{
		$each = $formControl[i];
		$name = $each.name;
		$value = $_trim($each.value);
		$buffer += $name +"="+ $value +"&";
	}
	return $buffer = $buffer.slice(0,-1);
}
function $_itemctrl ($attrib)
{
	if (!$attrib) var $attrib = '[data-ajax]';
	var $formControl = document.querySelectorAll($attrib);
	var $each, $name, $value, $buffer = "";
	for (var i = 0; i < $formControl.length; i++)
	{
		$each = $formControl[i];
		if ($each.checked)
		{
			$name = $each.name;
			$value = $_trim($each.value);
			$buffer += $name +"="+ $value +"&";
		}
	}
	return $buffer = $buffer.slice(0,-1);
}
function $_post ($directory, $query, $_callback) 
{
	//JSON.stringify();
	var xhttp;
	if (window.XMLHttpRequest) 
		xhttp = new XMLHttpRequest();
	else
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");		
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
			$_callback(this.responseText);
	};
	xhttp.open("POST",$directory,true);
	xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhttp.send($query);
}
function $_get ($directory, $query, $_callback) 
{
	//JSON.stringify();
	var xhttp;
	if (window.XMLHttpRequest) 
		xhttp = new XMLHttpRequest();
	else
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");		
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
			$_callback(this.responseText);
	};
	xhttp.open("GET",$directory+"?"+$query,true);
	xhttp.send();
}
function $_stream ($directory, $_callback) 
{
	var xhttp;
	if (window.XMLHttpRequest) 
		xhttp = new XMLHttpRequest();
	else
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");		
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200)
			$_callback(this.responseText);
	};
	xhttp.open("GET",$directory,true);
	xhttp.send();
}
