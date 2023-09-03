<?PHP
class Model
{
	private $bean, $id;
	public $studentObject, $registerObject, $courseObject, $attendanceObject;
	function __construct() 
	{
		$this->bean = new Bean();
	}
	function setId ($id) 
	{
		$this->id = $id;
		$this->setStudentObject();
		$this->setRegisterObject();
		$this->setCourseObject();		
		$this->setAttendanceObject();		
	}
	// STUDENT ENTITY
	private function setStudentObject()
	{
		$table = 'students';		
		$sql = 'SELECT * FROM '.$table.' WHERE id="'.$this->id.'"';
		$resultSet = $this->bean->Execute($sql);
		$this->studentObject = $resultSet[0];
	}
	function getName() 
	{
		$name = $this->studentObject->name;
		$lower = strtolower($name);
		return ucwords($lower);
	}
	function getGender()
	{
		$gender = $this->studentObject->gender;
		return $gender == 1? 'Male':'Female';
	}
	function getSex()
	{
		$gender = $this->studentObject->gender;
		return $gender == 1? 'M':'F';
	}
	function getEmail() {return $this->studentObject->email;}
	function getPhone() {return $this->studentObject->phone;}
	function getStatus() {return $this->studentObject->status;}	
	function getDate ($date_f = 'D, M j, Y') 
	{
		$date = $this->studentObject->date;
		$micro = strtotime($date);
		return date($date_f,$micro);
	}
	function getId() {return $this->id;}

	// REGISTER ENTITY	
	private function setRegisterObject()
	{
		$table = 'register';
		$sql = 'SELECT * FROM '.$table.' WHERE student_id="'.$this->id.'"';
		$resultSet = $this->bean->Execute($sql);
		$this->registerObject = $resultSet;
	}
	function getRegisterObject() {return $this->registerObject[0];}

	// COURSE ENTITY
	private function setCourseObject()
	{
		$course_id = $this->getRegisterObject()->course_id;
		$table = 'courses';
		$sql = 'SELECT * FROM '.$table.' WHERE id="'.$course_id.'"';
		$resultSet = $this->bean->Execute($sql);
		$this->courseObject = $resultSet;
	}
	function getCourseObject() {return $this->courseObject[0];}		
	
	// ATTENDANCE ENTITY
	private function setAttendanceObject()
	{
		$table = 'attendance';
		$sql = 'SELECT * FROM '.$table.' WHERE student_id="'.$this->id.'"';
		$resultSet = $this->bean->Execute($sql);
		$this->attendanceObject = $resultSet;
	}
	function getAttendanceObject() {return $this->attendanceObject;}
//	function filterAttendance ($yyyy_mm) 
//	{
//		$attendanceObject = $this->attendanceObject;
//		if ($yyyy_mm == '*') 
//			return count($attendanceObject);
//		if (!$yyyy_mm) 
//			$yyyy_mm = date('Y-m'); 			
//		foreach ($attendanceObject as $assoc)
//		{
//			if (substr($assoc->date,0,7) == $yyyy_mm) 
//				$array[] = $assoc;
//		}
//		return $array;
//	}		
}
$MODEL = new Model();
?>
