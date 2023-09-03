<?PHP
class Schema
{
	function __construct ()
	{
		$this->pseudo = 	'niitbenin';		
		$this->server = 	'localhost';
		$this->username = 	'root';
		$this->password = 	'';
#		$this->username = 	'hwplabsc_root';
#		$this->password = 	'_Strongp@ssw0rd';
		$this->database = 	'conrad_db';
		$this->pattern = 	'';
		$this->prikey = 	'id';
		$this->timestamp = 	array('date'=>'Y-m-d');
		$this->auto = 		array('status','date','id');
		$this->forkey = 	array('course_id','student_id');
		$this->main =	 	'students';	
	}
}
$SCHEMA = new Schema();
?>