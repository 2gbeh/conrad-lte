<?PHP
header('Content-Type:application/json; charset=UTF-8');
include_once('../../../config/@config.php');

$ptr = date('m') - 1;
$values = array('January','February','March','April','May','June','July','August','September','October','November','December');
$keys = range(1,12);

$buffer = '<option></option>';
foreach ($values as $i => $e)
{
	if ($ptr == $i)
		$buffer .= '<option value="'.$keys[$i].'" selected>'.$e.'</option>';
	else
		$buffer .= '<option value="'.$keys[$i].'">'.$e.'</option>';
}
echo $buffer;
?>


