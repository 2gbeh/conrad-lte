<?PHP
function _transName ($args) 
{
	$buf = strtolower($args);
	return ucwords($buf);
}
function _transSex ($args) 
{
	return $args == 1? 'M':'F';
}
function _transGender ($args) 
{
	return $args == 1? 'Male':'Female';
}
function _transCourse ($course_id) 
{
	$bean = $GLOBALS['BEAN'];
	$table = 'courses';
	$sql = 'SELECT title from '.$table.' WHERE id="'.$course_id.'"';
	$resultSet = $bean->Execute($sql);
	return $resultSet[0]->title;
}
function _transDate ($ts) 
{
	// Thu, Feb 27, 2020
	$micro = strtotime($ts);
	return date('D, M j, Y',$micro);
}
function _transTimePlus ($ts, $add = 1) 
{
	// +1 hour
	$flag = '+'.$add.' hour';
	$micro = strtotime($ts.' '.$flag);
	return date('H:i',$micro);
}
function _transMonthPlus ($ts, $add = 6) 
{			
	// +6 months
	$flag = '+'.$add.' months';
	$micro = strtotime($ts.' '.$flag);
	return date('D, M j, Y',$micro);
}
function _transJDate ($ts)
{
	// 1970-01-01
	$micro = strtotime($ts);
	return date('Y-m-d',$micro);
}
function _transJTime ($ts)
{
	// 16:01
	$micro = strtotime($ts);
	return date('H:i',$micro);
}
?>