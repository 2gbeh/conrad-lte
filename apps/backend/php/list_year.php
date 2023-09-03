<?PHP
header('Content-Type:application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');


$table = 'attendance';
$sql = 'SELECT DISTINCT YEAR(date) FROM '.$table.' ORDER BY date';
$resultSet = $BEAN->Execute($sql);

$this_y = date('Y');
$buffer = '<option></option>';
foreach ($resultSet as $obj)
{
	$e = $obj->{'YEAR(date)'};
	if ($this_y == $e)
	    $buffer .= '<option selected>'.$e.'</option>';
	else
	    $buffer .= '<option>'.$e.'</option>';
}
echo $buffer
?>


