<?PHP
header('Content-Type:application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');
include_once('../../../web/php/Model.php');

$table = 'courses';
$sql = 'SELECT * FROM '.$table.' ORDER BY id';
$resultSet = $BEAN->Execute($sql);
$buffer = '<option></option>';
foreach ($resultSet as $obj)
{
	$id = $obj->id;
	$title = $obj->title;
	if ($id < 2)
	    $buffer .= '<option value="'.$id.'" selected>'.$title.'</option>';
	else
	    $buffer .= '<option value="'.$id.'">'.$title.'</option>';
}
echo $buffer;
?>


