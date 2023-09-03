<?PHP
$CONNECTION = new mysqli 
(
	$SCHEMA->server,
	$SCHEMA->username,
	$SCHEMA->password,
	$SCHEMA->database
);
if ($CONNECTION->connect_error) 
{
	die('Connection failed: '.$CONNECTION->connect_error);
}
?>