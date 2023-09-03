<?PHP
header('Content-Type:application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');
include_once('../../../web/php/Model.php');

$table = 'batches';
$sql = 'SELECT * FROM '.$table.' ORDER BY id';
$resultSet = $BEAN->Execute($sql);
$total = count($resultSet);
$i = 1;
$buffer = '<option></option>';
foreach ($resultSet as $obj)
{
	$title = strtoupper($obj->title);
	if ($i == $total)
	    $buffer .= '<option selected>'.$title.'</option>';
	else
	    $buffer .= '<option>'.$title.'</option>';
	$i++;
}
echo $buffer;
?>


