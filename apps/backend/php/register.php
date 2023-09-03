<?PHP
header('Content-Type: application/json; charset=UTF-8');
include_once('../../../config/@config.php');
include_once('../../../lib/php/@php.php');
include_once('../../../web/php/util.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$_POST = con_validate($_POST);
	if (con_required($_POST,'fname,lname,gender,phone,course_id,batch'))
	{	
		$table = 'students';
//		$_POST['name'] = $_POST['lname'].' '.$_POST['fname'].' '.$_POST['mname'];	
		$_POST['name'] = $_POST['lname'].' '.$_POST['fname'];	
		$sql = 'INSERT INTO '.$table.' (name,gender,email,phone) VALUES ("'.$_POST['name'].'","'.$_POST['gender'].'","'.$_POST['email'].'","'.$_POST['phone'].'")';
		$result_1 = $BEAN->Execute($sql);
		
		$table = 'register';
		$_POST['student_id'] = $result_1;	
		$sql = 'INSERT INTO '.$table.' (course_id,student_id,batch) VALUES ("'.$_POST['course_id'].'","'.$_POST['student_id'].'","'.strtoupper($_POST['batch']).'")';
		$result_2 = $BEAN->Execute($sql);
		
		if ($result_1 > 0 && $result_2 > 0) {$errno = 200; $error = 'Student registration successful.';}
		else {$errno = 404; $error = 'ERROR: Student registration failed.';}		
	}
	else {$errno = 404; $error = 'ERROR: Required fields are empty.';}

	echo '{"errno": "'.$errno.'", "error": "'.$error.'"}';
}


?>