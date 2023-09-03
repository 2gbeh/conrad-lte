// JavaScript Document
function $_togglePassword (self)
{
	var type = self.getAttribute('type');
	if (type === "password")
		self.setAttribute('type','text');
	else
		self.setAttribute('type','password');	
}
function $_login ()
{
	$query = $_formctrl();
	$_post('web/php/landing.php',$query,$_ctrl);
}
function $_ctrl ($output)
{
	if (isNaN($output))
	{
		var $obj = JSON.parse($output);
		var $cookie = {
			exam_no:$obj.exam_no,
			course_id:$obj.course_id,
			user_id:$obj.user_id,
			time_in:$_getTime('full'),
			source:$obj.source}; 
		$_setSession($cookie);
		$_setAppstate();
		$_goto("apps/frontend/index.html");
	}
	else
	{		
		if ($output == 1) 
		{
			$_setAppstate();
			$_goto("apps/backend/dashboard.html");
		}
		else if ($output == 2) 
		{
			var $cookie = {
				exam_no:"niit/apex/jdoe",
				course_id:"apex",
				user_id:"jdoe",
				time_in:$_getTime('full'),				
				source:"niit-apex.json"}; 
			$_setSession($cookie);			
			$_setAppstate();
			$_goto("apps/frontend/index.html");
		}
		else if ($output == 3) alert("Invalid Examination Number");
		else if ($output == 4) alert("Invalid Course ID");		
		else alert("Server Error. Contact Admin");		
	}
}







