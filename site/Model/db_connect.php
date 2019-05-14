<?php

 $GLOBALS['connection'] = connect();
 
 function connect(){
	 $servername = "localhost";
	 $username = "root";
	 $password = "";
	 $dbName = "commandes_njv";
	 $engine = "mysql";
	try{
		if($engine == "mysql"){
			 $conn = new PDO("mysql:server=$servername;dbname=$dbName", $username, $password);
			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 }else if ($engine == "pgsql"){
			 $conn = new PDO("pgsql:$servername;port=5432;dbname=$dbName;user=$username;password=$password");
			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 }else{
			 throw new PDOException("Unknown engine, please use MySql or PGSql");
		 }
		 return $conn;
	}catch(PDOException $e){
		echo "Connection failed : " . $e->getMessage();
	}
 }

?>