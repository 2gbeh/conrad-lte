<?PHP
class Database
{
	private $SCHEMA, $CONN, $DB, $TIMESTAMP;	
	public $PRIKEY, $SIZE;	
	function __construct ()
	{
		$this->SCHEMA = $GLOBALS['SCHEMA'];
		$this->CONN = $GLOBALS['CONNECTION'];	
		$this->DB = $this->SCHEMA->database;
		$this->PATTERN = $this->SCHEMA->pattern;		
		$this->TIMESTAMP = $this->SCHEMA->timestamp;
		
		$this->PRIKEY = $this->SCHEMA->prikey;					
		$this->SIZE = $this->getSize();
	}
	function Tables ()
	{
		$sql = 'SHOW TABLES FROM '.$this->DB.' LIKE "%'.$this->PATTERN.'%"';
		$result = $this->CONN->query($sql);
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
				$array[] = current($row);
		}
		return $array;
	}
	function Schema ($table)
	{		
		$tableArray = $this->Tables();
		foreach ($tableArray as $each)
		{
			$sql = 'SELECT COLUMN_NAME,COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS 
			WHERE TABLE_SCHEMA="'.$this->DB.'" AND TABLE_NAME="'.$each.'"';
			$result = $this->CONN->query($sql);
			if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc()) 
					$array[$each][] = current($row).' '.strtoupper(end($row));
			}
		}
		if ($table) {return $array[$table];}
		return $array;
	}
	function Columns ($table)
	{
		$sql = 'SHOW COLUMNS FROM '.$table;
		$result = $this->CONN->query($sql);
		if ($result->num_rows > 0)
		{ 
			while($row = $result->fetch_assoc())
				$array[] = current($row);
		}
		return $array;
	}
	function Meta ($table)
	{
		$sql = 'SELECT * FROM '.$table;
		$result = $this->CONN->query($sql);
		if ($result->num_rows > 0) 
		{
			$today = 0;
			$object->total = $result->num_rows;
			while ($row = $result->fetch_assoc()) 
			{	
				$date_t = $this->getEntryToday($row);
				if ($date_t) $today++;
				$array[] = $row;
			}
			$date_k = $this->getDateKey($table);
			$row_1 = current($array);
			$row_nth = end($array);
			$object->today = $today;
			$object->first_row = $row_1;
			$object->first_date = $row_1[$date_k];
			$object->first_id = $row_1[$this->PRIKEY];
			$object->last_row = $row_nth;
			$object->last_date = $row_nth[$date_k];
			$object->last_id = $row_nth[$this->PRIKEY];
			$object->next_id = $object->last_id + 1;
			return $object;
		}
		else {return 0;}
	}	
	function Display ($table, $id)
	{		
		if (is_numeric($id) && $id > 0)
		{
			$sql = 'SELECT * FROM '.$table.' WHERE '.$this->PRIKEY.'="'.$id.'"';
			$result = $this->CONN->query($sql);
			if ($result->num_rows > 0) {return $result->fetch_object();}			
		}
		else
		{
			$sql = 'SELECT * FROM '.$table;
			$result = $this->CONN->query($sql);
			if ($result->num_rows > 0)
			{ 
				while($row = $result->fetch_assoc())
					$array[] = $row;
			}
			return $array;
		}
	}
	private function getSize ()
	{				
		foreach ($this->Tables() as $table)
		{
			$sql = 'SELECT '.$this->PRIKEY.' FROM '.$table;
			$result = $this->CONN->query($sql);
			$sum += $result->num_rows;			
		}
		return $sum;
	}		
	private function getDateKey ($table)
	{
		foreach ($this->TIMESTAMP as $name => $format)
		{
			if (in_array($name,$this->Columns($table)))
				return $name;
		}
	}	
	private function getEntryToday ($array)
	{
		if (is_object($array)) {$array = (array)$array;}
		foreach ($this->TIMESTAMP as $name => $format)
		{
			if (array_key_exists($name,$array))
			{
				$value = $array[$name];				
				$mktime = date($format);
				if (is_numeric(strpos($value,$mktime))) return $name;
			}
		}
	}	
}
$DATABASE = new Database();
?>
