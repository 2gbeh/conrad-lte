// JavaScript Document
function $_embed ($key, $value) 
{
	$target = document.getElementById($key);
	if ($target) $target.innerHTML = $value;
}
function $_template ()
{
	var $header = '<table>\
	<tr>\
		<td>\
			<div class="logo" style="background-image:url(../../web/media/images/logo.png);">&nbsp;</div>\
		</td>\
		<td align="right">\
			<a class="btn btn-pri" href="dashboard.html">Dashboard</a>\
			<a class="btn btn-alt" onClick="$_logout()" title="Exit">Logout</a>\
		</td>\
	</tr>\
	</table>';
	$_embed('tmp-header',$header);

	var $heading = '<b>NIIT</b> BENIN CENTER';
	$_embed('tmp-heading',$heading);

	var $footer = '<div class="theme-color bundle">\
		ConRAD LTE (Build 5.6.3.20)\
	</div>\
    <address>\
		Copyright &copy; 2011 \
		<a href="http://www.hwplabs.com/" target="_blank">HWP Labs</a>. \
		CRBN 658815\
	</address>';
	$_embed('tmp-footer',$footer);
}

