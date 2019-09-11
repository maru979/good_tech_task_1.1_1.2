<?php
class Database{
    private $host;
    private $user;
    private $pass;
    private $dbname;
    public $conn;


    public function __construct($host, $user, $pass, $dbname){
    	$this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;

        $this->conn = mysqli_connect($this->host, $this->user, $this->pass,  $this->dbname)  or die('Connection error');
    }

	public function insert($table, $fields_data){  
		$qry = "INSERT INTO ".$table." (";            
		$qry .= implode(",", array_keys($fields_data)) . ') VALUES (';            
		$qry .= "'" . implode("','", array_values($fields_data)) . "')";  
		if(mysqli_query($this->conn, $qry)){  
			return true;  
		}  
		else{  
			echo mysqli_error($this->conn);  
		}  
	}

	public function update($table, $fields_data, $condition){  
		$qry = '';  
		$cond = '';  
		foreach($fields_data as $key => $value){  
			$qry .= $key . "='".$value."', ";  
		}  
		$qry = substr($qry, 0, -2);  
		foreach($condition as $key => $value){  
			$cond .= $key . "='".$value."' AND ";  
		}  
		$cond= substr($cond, 0, -5);  

		$qry = "UPDATE ".$table." SET ".$qry." WHERE ".$cond."";  
		if(mysqli_query($this->conn, $qry)){  
			return true;  
		}
		else{  
			echo mysqli_error($this->conn);  
		}  
	}  

	public function delete($table, $condition) {  
		$cond = '';  
		foreach($condition as $key => $value)  
		{  
			$cond .= $key . " = '".$value."' AND ";   
			$cond = substr($cond, 0, -5);  
			$query = "DELETE FROM ".$table." WHERE ".$cond."";  
			if(mysqli_query($this->conn, $query)){  
		    	return true;  
			} 
			else{  
				echo mysqli_error($this->conn);  
		}   
		}  
	}  
}
?>