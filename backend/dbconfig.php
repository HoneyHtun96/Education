<?php 

$hostname = 'localhost';
$database = 'education';
$username = 'root';
$password = '';
$options  = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);

try{
	$connection = new PDO("mysql:host=$hostname;dbname=$database",$username,$password,$options);
	/*echo "Database connected successfully.";*/
}catch(PDOException $e){
	echo $e->getMessage();
}

?>