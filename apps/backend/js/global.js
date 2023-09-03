// JavaScript Document
function $_logout ()
{
	if (confirm("Log out of Account?") == true)
	{
		$_clearSession();
		$_goto("../../index.html");
	}
}
function _focusThis ($this, $target, $n) 
{
	var $table = document.getElementById($target);
	var $tr = $table.getElementsByTagName('tr')[$n];
	if ($this.checked == true) $tr.setAttribute('class','focus');
	else $tr.removeAttribute('class');
}
