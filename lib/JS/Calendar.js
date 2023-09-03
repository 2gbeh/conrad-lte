// JavaScript Document
function $_datetime ($attrib)
{
	if (!$attrib) var $attrib = 'datetime';
	var $target = document.getElementById($attrib);
	$target.value = $_getDate()+" "+$_getTime('full');
}
function $_getTime ($rtype)
{
	// 15:09
	var d = new Date();
	var $hour = $_digi(d.getHours());
	var $min = $_digi(d.getMinutes());
	var $sec = $_digi(d.getSeconds());
	var $msec = $_digi(d.getMilliseconds());
	var $buffer;
	if ($rtype == "full") $buffer = $hour+":"+$min+":"+$sec;
	else if ($rtype == "hr") $buffer = $hour;
	else if ($rtype == "sec") $buffer = $sec;
	else if ($rtype == "msec") $buffer = $msec;	
	else $buffer = $hour+":"+$min;
	return $buffer;
}
function $_setTime ($time)
{
	// 03:09 PM
	var d, $hour, $min, $merid, $buffer;
	if ($time)
	{
		d = $time.split(":");		
		$hour = d[0];
		$min = d[1];
	}
	else
	{
		d = new Date();		
		$hour = d.getHours();
		$min = d.getMinutes();
	}
	$merid = $hour >= 12 ? 'PM':'AM';
	$hour = $hour % 12;
	$hour = $hour ? $hour:12;
	$min = ($min < 10 && $min.length < 2) ? '0'+$min:$min;
	$buffer = $_digi($hour)+':'+$min+' '+$merid;
	return $buffer;
}
function $_getDate ()
{
	var d = new Date();
	var $year = d.getFullYear();
	var $month = $_digi(d.getMonth()+1);
	var $day = $_digi(d.getDate());	
	var $buffer = $year+"-"+$month+"-"+$day;
	return $buffer;
}
function $_setDate ($date)
{
	// Thu, Dec 6, 2018
	var d = $date ? new Date($date) : new Date();
	var $dow = $_scanDate(d.getDay(),"day",3);
	var $month = $_scanDate(d.getMonth(),"month",3);
	var $day = d.getDate();
	var $year = d.getFullYear();
	var $buffer = $dow+", "+$month+" "+$day+", "+$year;	
	return $buffer;
}
function $_scanDate ($int, $type, $format)
{
	var $output;
	var $day = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
	var $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

	if ($type == "day" && $int < 7)
		$output = $day[$int];
	else if ($type == "month" && $int <= 12)
		$output = $month[$int];
	else 
		$output = $_digi($int)
	// September ~ Sep
	if ($format) return $output.slice(0,3);
	return $output;
}

