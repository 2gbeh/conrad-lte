<?PHP
class Manifest
{
	function __construct ()
	{
		$this->root =				'conrad';		
		$this->appname = 		'ConRAD LTE';
		$this->typeface = 	'<b>ConRAD</b> LTE';
		$this->favicon = 		'web/media/icons/favicon.ico';		
		$this->logo = 			'web/media/images/logo.png';
		$this->theme = 			'#0E3997';
		$this->theme2 = 		'#0A2E7D';
		$this->theme3 = 		'';			

		$this->contractor = 'HWP Labs';
		$this->client = 		'NIIT Benin Center';
		$this->copyright = 	'Copyright &copy; 2018 <a href="http://www.hwplabs.com/">HWP Labs</a>. CRBN 658815';

		$this->super = 			'r00t()';
		$this->admin = 			'@dm1n';
		$this->demo = 			'd3m0';
		$this->pattern = 		'niit/course-id/user-id';
		
		$this->build = 			'5.6.3.20';
		$this->initial = 		'2018/12/06';
		$this->stable = 		'2020/02/27';
		$this->expires = 		'*';
	}
}
$MANIFEST = new Manifest();
?>