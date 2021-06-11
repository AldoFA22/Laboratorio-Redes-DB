<?php

class Database_pg extends PDO{
 
	//dbname
	private $dbname = "dba6";
	//host
	private $host 	= "10.144.1.208";
	//private $host 	= "proxy16.rt3.io";
	//user database
	private $user 	= "dba6";
	//password user qwerty
	private $pass 	= 'qwerty';
	//port
	private $port 	= 5432;
	//private $port 	= 30448;
    //instance
	private $dbh;
 
	//connect with postgresql and pdo
	public function __construct(){
	    try {
	        $this->dbh = parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->pass");
	    }
        catch(PDOException $e){
	        echo  $e->getMessage();
	    } 
	}
 
	//función para cerrar una conexión pdo
	public function close(){
    	$this->dbh = null;
	} 
}

?>