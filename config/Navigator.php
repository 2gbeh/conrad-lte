<?PHP
class Navigator
{
	private $ROOT, $WEB, $SUPER, $ADMIN, $USER;
	function __construct ()
	{
		$this->ROOT = ($_SERVER['SERVER_NAME'] == 'localhost') ? 'super/' : '/';
		$this->WEB = '../../';		
		$this->SUPER = '';
		$this->ADMIN = '../admin/';
		$this->USER = '../user/';
	}
	private function getBase ()
	{
		$server = $_SERVER['DOCUMENT_ROOT'].$this->ROOT;
		return $server;
	}
	private function getFile ($dir)
	{
		$array = explode('/',$dir);
		$dir = array_pop($array);
		$dir = explode('?',$dir);		
		$dir = current($dir);
		return $dir;		
	}
	private function getPage ($dir)
	{
		$array = explode('/',$dir);
		$dir = array_pop($array);
		$dir = explode('.',$dir);
		$dir = current($dir);
		return $dir;
	}	
	private function filter ($dir)
	{
		if (strpos($dir,'.') && !strpos($dir,'@'))
			return true;
	}	
	private function read ($args)
	{
		$base = $this->getBase().$args;
		$glob = glob($base.'*');
		if (count($glob) > 0)
		{
			foreach ($glob as $dir)
			{
				if ($this->filter($dir)) 
				{
					$page = $this->getPage($dir);
					$file = $this->getFile($dir);				
					$object->$page = $args.$file;
				}
			}
			return $object;
		}
	}
	function Super () {return $this->read($this->SUPER);}
	function Admin () {return $this->read($this->ADMIN);}
	function User () {return $this->read($this->USER);}
	function Web () {return $this->read($this->WEB);}
}
$NAV = new Navigator();
?>
